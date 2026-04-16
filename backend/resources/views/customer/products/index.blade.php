@extends('layouts.customer')

@section('title', 'Browse Catalog | OMS Portal')

@section('content')
    <div class="max-w-[1600px] mx-auto space-y-8 pb-12 transition-colors duration-300">

        <!-- Page Header -->
        <div
            class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate__animated animate__fadeInDown">
            <div>
                <h1 class="text-3xl font-black text-secondary-900 dark:text-white tracking-tight leading-none uppercase">
                    Browse Catalog</h1>
                <p class="text-secondary-500 dark:text-slate-400 mt-2 font-medium">Explore available products and add them
                    to your orders.</p>
            </div>
            <a href="{{ route('customer.orders.index') }}"
                class="inline-flex items-center gap-2 px-5 py-3 bg-primary-600 text-white rounded-2xl font-black text-sm hover:bg-primary-700 transition shadow-lg shadow-primary-600/20">
                <i class="hgi-stroke hgi-shopping-bag-01 text-lg"></i> My Orders
            </a>
        </div>

        <!-- Products Table Card -->
        <div
            class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden animate__animated animate__fadeInUp">

            <!-- Table Header -->
            <div
                class="p-6 border-b border-gray-50 dark:border-slate-800 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <h2 class="text-lg font-black text-secondary-900 dark:text-white tracking-tighter uppercase">All Products
                </h2>
                <div class="flex items-center bg-gray-100 dark:bg-slate-800 rounded-lg px-3 py-1.5 w-full sm:w-64">
                    <i class="hgi-stroke hgi-search-01 text-gray-400 dark:text-slate-500 mr-2 text-sm"></i>
                    <input type="text" placeholder="Search products..."
                        class="bg-transparent border-none focus:ring-0 text-sm w-full outline-none dark:text-slate-200">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr
                            class="bg-gray-50/50 dark:bg-slate-800/50 text-secondary-400 dark:text-slate-500 text-[10px] uppercase font-black tracking-widest">
                            <th class="py-4 px-6">Product</th>
                            <th class="py-4 px-6">SKU</th>
                            <th class="py-4 px-6">Stock</th>
                            <th class="py-4 px-6 text-right">Price</th>
                        </tr>
                    </thead>
                    <tbody
                        class="divide-y divide-gray-50 dark:divide-slate-800 text-sm text-secondary-700 dark:text-slate-300">
                        @forelse($products as $product)
                            @php
                                if ($product->quantity <= 0) {
                                    $stockCls = 'bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-400';
                                    $stockLabel = 'Out of Stock';
                                } elseif ($product->quantity <= 10) {
                                    $stockCls = 'bg-amber-100 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400';
                                    $stockLabel = 'Low Stock';
                                } else {
                                    $stockCls = 'bg-emerald-100 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400';
                                    $stockLabel = 'In Stock';
                                }
                            @endphp
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-slate-800/50 transition duration-200">
                                <td class="py-5 px-6">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-9 h-9 rounded-xl bg-primary-100 dark:bg-primary-900/20 flex items-center justify-center">
                                            <i
                                                class="hgi-stroke hgi-package text-primary-600 dark:text-primary-400 text-base"></i>
                                        </div>
                                        <span
                                            class="font-black text-secondary-900 dark:text-white">{{ $product->name }}</span>
                                    </div>
                                </td>
                                <td class="py-5 px-6">
                                    <span
                                        class="font-mono text-xs bg-gray-100 dark:bg-slate-800 text-secondary-500 dark:text-slate-400 px-2 py-1 rounded-lg">{{ $product->sku ?? '—' }}</span>
                                </td>
                                <td class="py-5 px-6">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider {{ $stockCls }}">
                                        <span class="w-1.5 h-1.5 rounded-full bg-current mr-2 opacity-50"></span>
                                        {{ $stockLabel }}
                                    </span>
                                </td>
                                <td class="py-5 px-6 text-right font-black text-secondary-900 dark:text-white">
                                    {{ $product->currency ?? 'MYR' }} {{ number_format($product->price, 2) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-20 text-center">
                                    <div class="flex flex-col items-center gap-4">
                                        <div
                                            class="w-20 h-20 rounded-full bg-gray-50 dark:bg-slate-800 flex items-center justify-center">
                                            <i
                                                class="hgi-stroke hgi-store-01 text-4xl text-gray-200 dark:text-slate-700"></i>
                                        </div>
                                        <div>
                                            <h3
                                                class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter">
                                                No products available</h3>
                                            <p class="text-secondary-400 dark:text-slate-500 font-medium text-sm mt-1">Check
                                                back later for new arrivals.</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
                <div class="p-6 border-t border-gray-100 dark:border-slate-800">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

