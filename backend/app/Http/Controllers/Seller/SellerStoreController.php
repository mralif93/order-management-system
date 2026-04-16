<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class SellerStoreController extends Controller
{
    /**
     * Show the store management page (or setup page if no slug yet).
     */
    public function index(): View
    {
        $seller = auth('seller')->user();
        $products = Product::where('seller_id', $seller->id)
            ->where('is_active', true)
            ->orderByDesc('is_featured')
            ->orderBy('name')
            ->get();

        $featuredCount = $products->where('is_featured', true)->count();

        return view('seller.store.index', compact('seller', 'products', 'featuredCount'));
    }

    /**
     * Claim / create the store slug.
     */
    public function setup(Request $request): RedirectResponse
    {
        $seller = auth('seller')->user();

        $request->validate([
            'store_slug' => [
                'required',
                'string',
                'min:3',
                'max:50',
                'regex:/^[a-z0-9\-]+$/',
                Rule::unique('sellers', 'store_slug')->ignore($seller->id),
            ],
            'store_name' => 'nullable|string|max:100',
            'store_bio'  => 'nullable|string|max:500',
        ], [
            'store_slug.regex' => 'Slug may only contain lowercase letters, numbers, and hyphens.',
            'store_slug.unique' => 'This store name is already taken. Please choose another.',
        ]);

        $seller->update([
            'store_slug' => strtolower(trim($request->store_slug)),
            'store_name' => $request->store_name,
            'store_bio'  => $request->store_bio,
        ]);

        return redirect()->route('seller.store.index')
            ->with('success', 'Your store has been set up successfully!');
    }

    /**
     * Update store info (name, bio) — slug is locked after creation.
     */
    public function update(Request $request): RedirectResponse
    {
        $seller = auth('seller')->user();

        $request->validate([
            'store_name' => 'nullable|string|max:100',
            'store_bio'  => 'nullable|string|max:500',
        ]);

        $seller->update($request->only('store_name', 'store_bio'));

        return redirect()->route('seller.store.index')
            ->with('success', 'Store info updated.');
    }

    /**
     * Toggle is_featured on a product (max 10 featured at a time).
     */
    public function toggleFeatured(Product $product): RedirectResponse
    {
        $seller = auth('seller')->user();
        abort_if($product->seller_id !== $seller->id, 403);

        if ($product->is_featured) {
            $product->update(['is_featured' => false]);
            return back()->with('success', '"' . $product->name . '" removed from your store.');
        }

        $featuredCount = Product::where('seller_id', $seller->id)
            ->where('is_featured', true)
            ->count();

        if ($featuredCount >= 10) {
            return back()->with('error', 'You can only feature up to 10 products. Remove one first.');
        }

        $product->update(['is_featured' => true]);
        return back()->with('success', '"' . $product->name . '" added to your store.');
    }
}

