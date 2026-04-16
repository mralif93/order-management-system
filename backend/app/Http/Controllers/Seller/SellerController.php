<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\SellerProfileRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class SellerController extends Controller
{
    public function index(): View
    {
        $sellerId = auth('seller')->id();

        $stats = [
            'total_products'  => Product::where('seller_id', $sellerId)->count(),
            'active_products' => Product::where('seller_id', $sellerId)->where('is_active', true)->count(),
            'total_orders'    => Order::whereHas('items.product', fn($q) => $q->where('seller_id', $sellerId))->count(),
            'pending_orders'  => Order::whereHas('items.product', fn($q) => $q->where('seller_id', $sellerId))->where('order_status', 'pending')->count(),
        ];

        $recentOrders = Order::whereHas('items.product', fn($q) => $q->where('seller_id', $sellerId))
            ->with(['customer', 'items.product'])
            ->latest()
            ->limit(5)
            ->get();

        return view('seller.index', compact('stats', 'recentOrders'));
    }

    public function profile(): View
    {
        $seller = Auth::guard('seller')->user();
        return view('seller.profile', compact('seller'));
    }

    public function profileUpdate(SellerProfileRequest $request)
    {
        $seller = Auth::guard('seller')->user();
        $seller->update($request->validated());

        return redirect()->route('seller.profile')
            ->with('success', 'Profile updated successfully.');
    }

    public function passwordUpdate(SellerProfileRequest $request)
    {
        $seller = Auth::guard('seller')->user();
        $seller->update(['password' => Hash::make($request->validated()['new_password'])]);

        return redirect()->route('seller.profile')
            ->with('success', 'Password changed successfully.');
    }
}
