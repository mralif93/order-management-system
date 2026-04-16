<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = Auth::guard('customer')->user();
        $totalOrders = $customer->orders()->count();
        $totalSpent = $customer->orders()->sum('total_amount');
        $activeOrders = $customer->orders()->whereIn('order_status', ['pending', 'processing', 'shipped'])->count();
        $recentOrders = $customer->orders()->latest()->limit(5)->get();

        return view('customer.index', compact('totalOrders', 'totalSpent', 'activeOrders', 'recentOrders'));
    }

    /**
     * Display customer profile.
     */
    public function profile()
    {
        $customer = Auth::guard('customer')->user();
        return view('customer.profile', compact('customer'));
    }

    /**
     * Update customer profile info & address.
     */
    public function profileUpdate(CustomerProfileRequest $request)
    {
        $customer = Auth::guard('customer')->user();
        $customer->update($request->validated());

        return redirect()->route('customer.profile')
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * Change customer password.
     */
    public function passwordUpdate(CustomerProfileRequest $request)
    {
        $customer = Auth::guard('customer')->user();
        $customer->update(['password' => Hash::make($request->validated()['new_password'])]);

        return redirect()->route('customer.profile')
            ->with('success', 'Password changed successfully.');
    }
}