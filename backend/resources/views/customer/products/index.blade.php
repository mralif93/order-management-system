@extends('layouts.customer')

@section('title', 'Browse Catalog | OMS Portal')

@section('content')
<div class="max-w-7xl mx-auto space-y-12 pb-12 transition-colors duration-300">
    <!-- Catalog Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 animate__animated animate__fadeIn">
        <div class="max-w-2xl">
            <h1 class="text-4xl font-black text-secondary-900 dark:text-white tracking-tighter uppercase leading-none mb-4">The Catalog</h1>
            <p class="text-secondary-500 dark:text-slate-400 font-medium leading-relaxed">Discover our premium range of products. Every item is curated for quality and excellence, delivered straight to your doorstep.</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="relative group">
                <i class="hgi-stroke hgi-search-01 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-slate-500 group-focus-within:text-primary-600 transition-colors"></i>
                <input type="text" placeholder="Search catalog..." class="pl-11 pr-6 py-3 bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-2xl text-sm focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200 w-full sm:w-64 shadow-sm transition-all">
            </div>
            <button class="p-3 bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-2xl text-secondary-400 hover:text-primary-600 transition shadow-sm">
                <i class="hgi-stroke hgi-filter text-xl"></i>
            </button>
        </div>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @forelse($products as $product)
        <div class="group bg-white dark:bg-slate-900 rounded-[32px] overflow-hidden border border-gray-100 dark:border-slate-800 hover:shadow-2xl hover:shadow-primary-600/10 transition-all duration-500 hover:-translate-y-2 animate__animated animate__fadeInUp" style="animation-delay: {{ $loop->index * 100 }}ms">
            <!-- Product Image Placeholder -->
            <div class="aspect-square bg-gray-50 dark:bg-slate-800 flex items-center justify-center relative overflow-hidden">
                <i class="hgi-stroke hgi-package text-6xl text-gray-200 dark:text-slate-700 group-hover:scale-110 group-hover:rotate-12 transition-transform duration-700"></i>
                <div class="absolute top-4 right-4 translate-x-12 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 transition-all duration-500">
                    <button class="w-10 h-10 rounded-full bg-white/90 dark:bg-slate-800/90 text-primary-600 dark:text-primary-400 shadow-xl backdrop-blur-sm flex items-center justify-center hover:bg-primary-600 hover:text-white transition">
                        <i class="hgi-stroke hgi-favourite text-lg font-black"></i>
                    </button>
                </div>
                <!-- Badge -->
                @if($product->stock_quantity < 5)
                <span class="absolute bottom-4 left-4 px-3 py-1 bg-amber-100/90 dark:bg-amber-900/40 text-amber-700 dark:text-amber-400 text-[10px] font-black uppercase tracking-widest rounded-lg backdrop-blur-sm">Low Stock</span>
                @endif
            </div>

            <!-- Content -->
            <div class="p-6">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="text-lg font-black text-secondary-900 dark:text-white tracking-tight leading-tight line-clamp-1 truncate grow mr-2">{{ $product->name }}</h3>
                    <span class="text-sm font-black text-primary-600 dark:text-primary-400">{{ $product->currency }} {{ number_format($product->price, 2) }}</span>
                </div>
                <p class="text-xs text-secondary-400 dark:text-slate-500 font-medium mb-6 line-clamp-1 uppercase tracking-widest">{{ $product->sku }}</p>
                
                <button class="w-full py-4 bg-gray-50 dark:bg-slate-800/50 text-secondary-900 dark:text-slate-300 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] group-hover:bg-primary-600 group-hover:text-white group-hover:shadow-lg group-hover:shadow-primary-600/30 transition-all duration-300 flex items-center justify-center gap-2">
                    <i class="hgi-stroke hgi-shopping-cart-01 text-lg"></i> Add to Cart
                </button>
            </div>
        </div>
        @empty
        <div class="col-span-full py-20 text-center">
            <div class="flex flex-col items-center gap-4">
                <i class="hgi-stroke hgi-package text-6xl text-gray-200 dark:text-slate-800"></i>
                <p class="text-secondary-500 dark:text-slate-500 font-bold uppercase tracking-widest text-sm">Our shelves are empty at the moment.</p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
    <div class="p-8 border-t dark:border-slate-800">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection
