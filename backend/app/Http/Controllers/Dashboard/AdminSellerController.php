<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminSellerRequest;
use App\Models\Seller;
use Illuminate\Http\Request;

class AdminSellerController extends Controller
{
    /**
     * Display a listing of sellers.
     */
    public function index(Request $request)
    {
        $query = Seller::query();

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

        $sellers = $query->withCount('products')->latest()->paginate(10);

        return view('dashboard.sellers.index', compact('sellers'));
    }

    /**
     * Show the form for creating a new seller.
     */
    public function create()
    {
        return view('dashboard.sellers.create');
    }

    /**
     * Store a newly created seller in storage.
     */
    public function store(AdminSellerRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);
        Seller::create($validated);

        return redirect()->route('admin.sellers.index')
            ->with('success', 'Seller created successfully.');
    }

    /**
     * Display the specified seller.
     */
    public function show(Seller $seller)
    {
        $seller->load([
            'products' => function ($q) {
                $q->orderByDesc('is_featured')->orderBy('name');
            }
        ]);

        $featuredCount = $seller->products->where('is_featured', true)->count();

        return view('dashboard.sellers.show', compact('seller', 'featuredCount'));
    }

    /**
     * Show the form for editing the specified seller.
     */
    public function edit(Seller $seller)
    {
        return view('dashboard.sellers.edit', compact('seller'));
    }

    /**
     * Update the specified seller in storage.
     */
    public function update(AdminSellerRequest $request, Seller $seller)
    {
        $seller->update($request->validated());

        return redirect()->route('admin.sellers.show', $seller)
            ->with('success', 'Seller updated successfully.');
    }

    /**
     * Remove the specified seller from storage.
     */
    public function destroy(Seller $seller)
    {
        $seller->delete();

        return redirect()->route('admin.sellers.index')
            ->with('success', 'Seller deleted successfully.');
    }
}
