<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;

class CustomerProductController extends Controller
{
    /**
     * Browse active products.
     */
    public function index()
    {
        $products = Product::where('is_active', true)->latest()->paginate(12);

        return view('customer.products.index', compact('products'));
    }
}

