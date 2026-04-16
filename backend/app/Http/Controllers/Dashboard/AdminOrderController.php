<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminOrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index(Request $request)
    {
        $query = Order::with('customer');

        if ($request->has('search')) {
            $query->where('order_number', 'like', '%' . $request->search . '%')
                ->orWhereHas('customer', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%');
                });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('order_status', $request->status);
        }

        $orders = $query->latest()->paginate(10);

        return view('dashboard.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $order->load(['customer', 'items.product', 'payments']);

        return view('dashboard.orders.show', compact('order'));
    }

    /**
     * Update the specified order status in storage.
     */
    public function update(AdminOrderRequest $request, Order $order)
    {
        $order->update($request->validated());

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Order status updated successfully.');
    }
}
