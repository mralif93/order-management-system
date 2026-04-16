<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CustomerOrderController extends Controller
{
    /**
     * Display the customer's order history.
     */
    public function index()
    {
        $orders = Order::where('customer_id', Auth::guard('customer')->id())
            ->latest()
            ->paginate(10);

        return view('customer.orders.index', compact('orders'));
    }

    /**
     * Display a specific order detail.
     */
    public function show(Order $order)
    {
        if ($order->customer_id !== Auth::guard('customer')->id()) {
            abort(403);
        }

        $order->load(['items.product', 'payments']);

        return view('customer.orders.show', compact('order'));
    }
}

