<?php

namespace App\Http\Controllers\Seller;

use App\Http\Requests\Seller\SellerProductRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\Product;

class SellerProductController extends Controller
{
    public function index(): View
    {
        $products = Product::where('seller_id', auth('seller')->id())->latest()->paginate(10);
        return view('seller.product.index', compact('products'));
    }

    public function create(): View
    {
        return view('seller.product.create');
    }

    public function store(SellerProductRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['seller_id'] = auth('seller')->id();
        Product::create($validated);
        return redirect()->route('seller.products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product): View
    {
        abort_if($product->seller_id !== auth('seller')->id(), 403, 'Unauthorized action.');
        return view('seller.product.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        abort_if($product->seller_id !== auth('seller')->id(), 403, 'Unauthorized action.');
        return view('seller.product.edit', compact('product'));
    }

    public function update(SellerProductRequest $request, Product $product): RedirectResponse
    {
        abort_if($product->seller_id !== auth('seller')->id(), 403, 'Unauthorized action.');
        $product->update($request->validated());
        return redirect()->route('seller.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        abort_if($product->seller_id !== auth('seller')->id(), 403, 'Unauthorized action.');
        $product->delete();
        return redirect()->route('seller.products.index')->with('success', 'Product deleted successfully.');
    }
}