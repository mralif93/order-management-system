<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of customers.
     */
    public function index(Request $request)
    {
        $query = Customer::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status') && $request->status != '') {
            if ($request->status == 'active') {
                $query->where('is_active', true);
            } elseif ($request->status == 'inactive') {
                $query->where('is_active', false);
            } elseif ($request->status == 'locked') {
                $query->where('is_locked', true);
            }
        }

        $customers = $query->latest()->paginate(10);

        return view('dashboard.customers.index', compact('customers'));
    }

    /**
     * Display the specified customer.
     */
    public function show(Customer $customer)
    {
        $customer->load(['orders' => function($q) {
            $q->latest()->limit(5);
        }]);
        
        return view('dashboard.customers.show', compact('customer'));
    }

    /**
     * Update the specified customer status in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'is_active' => 'sometimes|boolean',
            'is_locked' => 'sometimes|boolean',
        ]);

        $customer->update($validated);

        return redirect()->route('customers.show', $customer)
            ->with('success', 'Customer status updated successfully.');
    }
}
