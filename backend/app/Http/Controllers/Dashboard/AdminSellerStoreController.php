<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminSellerStoreController extends Controller
{
    /** List all seller stores. */
    public function index(Request $request)
    {
        $query = Seller::withCount(['products', 'products as featured_count' => fn($q) => $q->where('is_featured', true)])
            ->whereNotNull('store_slug');

        if ($search = $request->search) {
            $query->where(fn($q) => $q->where('name', 'like', "%{$search}%")
                ->orWhere('store_slug', 'like', "%{$search}%")
                ->orWhere('store_name', 'like', "%{$search}%"));
        }

        $stores = $query->latest()->paginate(20)->withQueryString();

        return view('dashboard.stores.index', compact('stores'));
    }

    /** Show form to create a store for a seller that has none yet. */
    public function create()
    {
        $sellers = Seller::whereNull('store_slug')->orderBy('name')->get();

        return view('dashboard.stores.create', compact('sellers'));
    }

    /** Persist a new store for the chosen seller. */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'seller_id' => 'required|exists:sellers,id',
            'store_slug' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/^[a-z0-9\-]+$/',
                Rule::unique('sellers', 'store_slug'),
            ],
            'store_name' => 'nullable|string|max:100',
            'store_bio' => 'nullable|string|max:500',
        ], [
            'store_slug.regex' => 'Slug may only contain lowercase letters, numbers, and hyphens.',
            'store_slug.unique' => 'This store slug is already taken.',
        ]);

        $seller = Seller::findOrFail($request->seller_id);
        $seller->update([
            'store_slug' => strtolower(trim($request->store_slug)),
            'store_name' => $request->store_name,
            'store_bio' => $request->store_bio,
        ]);

        return redirect()->route('admin.stores.show', $seller)
            ->with('success', 'Store created for ' . $seller->name . '.');
    }

    /** Show a single store with its featured product management. */
    public function show(Seller $seller)
    {
        abort_if(!$seller->store_slug, 404, 'This seller has no store yet.');

        $seller->load(['products' => fn($q) => $q->orderByDesc('is_featured')->orderBy('name')]);
        $featuredCount = $seller->products->where('is_featured', true)->count();

        return view('dashboard.stores.show', compact('seller', 'featuredCount'));
    }

    /** Show the edit form for a store. */
    public function edit(Seller $seller)
    {
        abort_if(!$seller->store_slug, 404, 'This seller has no store yet.');

        return view('dashboard.stores.edit', compact('seller'));
    }

    /** Update store info — used by both stores.update and sellers.store.update routes. */
    public function update(Request $request, Seller $seller): RedirectResponse
    {
        $request->validate([
            'store_slug' => [
                'nullable',
                'string',
                'min:3',
                'max:50',
                'regex:/^[a-z0-9\-]+$/',
                Rule::unique('sellers', 'store_slug')->ignore($seller->id),
            ],
            'store_name' => 'nullable|string|max:100',
            'store_bio' => 'nullable|string|max:500',
        ], [
            'store_slug.regex' => 'Slug may only contain lowercase letters, numbers, and hyphens.',
            'store_slug.unique' => 'This store slug is already taken by another seller.',
        ]);

        $seller->update([
            'store_slug' => $request->store_slug ? strtolower(trim($request->store_slug)) : $seller->store_slug,
            'store_name' => $request->store_name,
            'store_bio' => $request->store_bio,
        ]);

        // Redirect back to seller detail when called from the embedded seller panel
        if (request()->routeIs('admin.sellers.store.update')) {
            return redirect()->route('admin.sellers.show', $seller)
                ->with('success', 'Store info updated for ' . $seller->name . '.');
        }

        return redirect()->route('admin.stores.show', $seller)
            ->with('success', 'Store updated for ' . $seller->name . '.');
    }

    /** Delete (destroy) a store — clears all store fields and unfeatures all products. */
    public function destroy(Seller $seller): RedirectResponse
    {
        $seller->products()->update(['is_featured' => false]);
        $seller->update(['store_slug' => null, 'store_name' => null, 'store_bio' => null]);

        // If called from seller detail page, redirect back there
        if (request()->routeIs('admin.sellers.store.reset')) {
            return redirect()->route('admin.sellers.show', $seller)
                ->with('success', 'Store deleted. Seller must set up a new store.');
        }

        return redirect()->route('admin.stores.index')
            ->with('success', 'Store for ' . $seller->name . ' has been deleted.');
    }

    /** Toggle is_featured on one of the seller's products (max 10). */
    public function toggleFeatured(Seller $seller, Product $product): RedirectResponse
    {
        abort_if($product->seller_id !== $seller->id, 403);

        if ($product->is_featured) {
            $product->update(['is_featured' => false]);
            return back()->with('success', '"' . $product->name . '" removed from store.');
        }

        $featuredCount = Product::where('seller_id', $seller->id)->where('is_featured', true)->count();

        if ($featuredCount >= 10) {
            return back()->with('error', 'Max 10 featured products. Remove one first.');
        }

        $product->update(['is_featured' => true]);
        return back()->with('success', '"' . $product->name . '" added to store.');
    }
}

