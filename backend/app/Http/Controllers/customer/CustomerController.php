<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer.index');
    }

    /**
     * Display the customer's order history.
     */
    public function orders()
    {
        $orders = Order::where('customer_id', Auth::guard('customer')->id())
            ->latest()
            ->paginate(10);
            
        return view('customer.orders.index', compact('orders'));
    }

    /**
     * Display a specific order detail.
     */
    public function orderShow(Order $order)
    {
        // Access control: Ensure order belongs to this customer
        if ($order->customer_id !== Auth::guard('customer')->id()) {
            abort(403);
        }

        $order->load(['items.product', 'payments']);

        return view('customer.orders.show', compact('order'));
    }

    /**
     * Browse active products.
     */
    public function products()
    {
        $products = Product::where('is_active', true)->latest()->paginate(12);
        
        return view('customer.products.index', compact('products'));
    }

    /**
     * Display and update customer profile.
     */
    public function profile()
    {
        $customer = Auth::guard('customer')->user();
        return view('customer.profile', compact('customer'));
    }
}