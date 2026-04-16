<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\SellerOrderRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Order;

class SellerOrderController extends Controller
{
    private function checkOwnership(Order $order)
    {
        $hasSellerProduct = $order->items()->whereHas('product', function ($query) {
            $query->where('seller_id', auth('seller')->id());
        })->exists();

        abort_if(!$hasSellerProduct, 403, 'Unauthorized action.');
    }

    public function index()
    {
        $orders = Order::whereHas('items.product', function ($query) {
            $query->where('seller_id', auth('seller')->id());
        })->latest()->paginate(10);

        return view('seller.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $this->checkOwnership($order);
        $order->load(['items.product', 'customer', 'payments']);

        return view('seller.order.show', compact('order'));
    }

    public function update(SellerOrderRequest $request, Order $order)
    {
        $this->checkOwnership($order);

        $order->update($request->validated());
        return redirect()->route('seller.orders.index')->with('success', 'Successfully updated order.');
    }

    public function destroy(Order $order)
    {
        $this->checkOwnership($order);

        $order->delete();
        return back()->with('success', 'Successfully deleted order.');
    }
}