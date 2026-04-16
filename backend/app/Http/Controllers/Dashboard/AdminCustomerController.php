<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
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

    public function create()
    {
        return view('dashboard.customers.create');
    }

    public function store(AdminCustomerRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        Customer::create($validated);

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified customer.
     */
    public function show(Customer $customer)
    {
        $customer->load([
            'orders' => function ($q) {
                $q->latest()->limit(5);
            }
        ]);

        return view('dashboard.customers.show', compact('customer'));
    }

    /**
     * Update the specified customer status in storage.
     */
    public function update(AdminCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());

        return redirect()->route('admin.customers.show', $customer)
            ->with('success', 'Customer status updated successfully.');
    }

    /**
     * Show the form for editing the specified customer.
     */
    public function edit(Customer $customer)
    {
        return view('dashboard.customers.edit', compact('customer'));
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer deleted successfully.');
    }
}
