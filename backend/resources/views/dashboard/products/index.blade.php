@extends('layouts.dashboard')

@section('title', 'Products Management | OMS Admin')

@section('content')
<div class="max-w-[1600px] mx-auto space-y-8 pb-12 transition-colors duration-300">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="animate__animated animate__fadeInLeft">
            <h1 class="text-3xl font-extrabold text-secondary-900 dark:text-white tracking-tight leading-none">Products</h1>
            <p class="text-secondary-500 dark:text-slate-400 mt-2 font-medium">Manage your inventory, SKU details, and pricing.</p>
        </div>
        <div class="animate__animated animate__fadeInRight">
            <a href="{{ route('products.create') }}" class="px-6 py-3 bg-primary-600 text-white rounded-2xl font-black hover:bg-primary-700 hover:shadow-lg hover:shadow-primary-600/20 transition-all flex items-center gap-2 shadow-md">
                <i class="hgi-stroke hgi-plus text-xl"></i> Add Product
            </a>
        </div>
    </div>

    <!-- Filters & Table Card -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden flex flex-col">
        <!-- Table Search/Filters -->
        <div class="p-6 border-b border-gray-50 dark:border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <form action="{{ route('products.index') }}" method="GET" class="relative group w-full sm:w-96">
                <i class="hgi-stroke hgi-search-01 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-slate-500 group-focus-within:text-primary-600 transition-colors"></i>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Search by name or SKU..." 
                    class="w-full pl-11 pr-4 py-2.5 bg-gray-50 dark:bg-slate-800 border-none rounded-xl text-sm focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200"
                >
            </form>
            <div class="flex items-center gap-3">
                <button class="px-4 py-2.5 bg-gray-50 dark:bg-slate-800 text-secondary-600 dark:text-slate-400 rounded-xl text-xs font-bold hover:bg-gray-100 dark:hover:bg-slate-700 transition flex items-center gap-2">
                    <i class="hgi-stroke hgi-filter text-lg"></i> Filters
                </button>
            </div>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-slate-800/30 text-secondary-400 dark:text-slate-500 text-[10px] uppercase font-black tracking-widest">
                        <th class="py-4 px-6">Product Details</th>
                        <th class="py-4 px-6">SKU</th>
                        <th class="py-4 px-6">Price</th>
                        <th class="py-4 px-6">Stock</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-slate-800 text-sm">
                    @forelse($products as $product)
                    <tr class="hover:bg-primary-50/20 dark:hover:bg-primary-900/5 transition-colors group">
                        <td class="py-5 px-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-gray-100 dark:bg-slate-800 flex items-center justify-center text-primary-600">
                                    <i class="hgi-stroke hgi-package text-2xl"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-secondary-900 dark:text-white">{{ $product->name }}</p>
                                    <p class="text-xs text-secondary-400 dark:text-slate-500 mt-0.5">{{ Str::limit($product->description, 30) ?: 'No description' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-5 px-6">
                            <span class="px-2 py-1 bg-gray-100 dark:bg-slate-800 text-secondary-600 dark:text-slate-400 rounded-lg text-xs font-bold uppercase tracking-wider">{{ $product->sku }}</span>
                        </td>
                        <td class="py-5 px-6 font-black text-secondary-900 dark:text-white">
                            {{ $product->currency }} {{ number_format($product->price, 2) }}
                        </td>
                        <td class="py-5 px-6">
                            <div class="flex items-center gap-2">
                                <div class="w-1.5 h-1.5 rounded-full {{ $product->stock_quantity > 10 ? 'bg-emerald-500' : 'bg-amber-500 animate-pulse' }}"></div>
                                <span class="font-bold text-secondary-700 dark:text-slate-300">{{ $product->stock_quantity }} units</span>
                            </div>
                        </td>
                        <td class="py-5 px-6">
                            @if($product->is_active)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-100 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400">Active</span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-400">Inactive</span>
                            @endif
                        </td>
                        <td class="py-5 px-6 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('products.edit', $product) }}" class="p-2 text-gray-400 dark:text-slate-500 hover:text-primary-600 dark:hover:text-primary-400 transition">
                                    <i class="hgi-stroke hgi-pencil-edit-01 text-xl"></i>
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this product?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button class="p-2 text-gray-400 dark:text-slate-500 hover:text-red-600 transition">
                                        <i class="hgi-stroke hgi-delete-02 text-xl"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-20 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-16 h-16 rounded-full bg-gray-50 dark:bg-slate-800 flex items-center justify-center text-gray-300 dark:text-slate-600">
                                    <i class="hgi-stroke hgi-package text-3xl"></i>
                                </div>
                                <p class="text-secondary-500 dark:text-slate-400 font-bold tracking-tight">No products found.</p>
                                <a href="{{ route('products.create') }}" class="text-sm font-bold text-primary-600 uppercase tracking-widest mt-2 hover:underline">Add your first product</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
        <div class="p-6 bg-gray-50/50 dark:bg-slate-800/20 border-t border-gray-50 dark:border-slate-800">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
