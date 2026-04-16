<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\View\View;

class PublicStoreController extends Controller
{
    /**
     * Show the public Linktree-style store landing page.
     */
    public function show(string $slug): View
    {
        $seller = Seller::where('store_slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $products = Product::where('seller_id', $seller->id)
            ->where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('name')
            ->take(10)
            ->get();

        return view('public.store', compact('seller', 'products'));
    }
}

