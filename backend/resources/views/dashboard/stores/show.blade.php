@extends('layouts.dashboard')

@section('title', $seller->store_name ?? $seller->name . '\'s Store')

@section('content')
<div class="max-w-[1600px] mx-auto space-y-8 pb-12 transition-colors duration-300">

    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-center gap-4">
            <a href="javascript:history.back()"
                class="w-10 h-10 rounded-2xl bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 flex items-center justify-center text-secondary-400 hover:text-primary-600 transition shadow-sm">
                <i class="hgi-stroke hgi-arrow-left-01 text-xl"></i>
            </a>
            <div>
                <h1 class="text-3xl font-black text-secondary-900 dark:text-white tracking-tight">{{ $seller->store_name ?? $seller->name }}</h1>
                <a href="{{ route('public.store', $seller->store_slug) }}" target="_blank"
                    class="text-primary-600 text-sm font-black hover:underline">/shop/{{ $seller->store_slug }}</a>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('public.store', $seller->store_slug) }}" target="_blank"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-700 text-secondary-700 dark:text-slate-300 text-sm font-black rounded-2xl hover:border-primary-400 hover:text-primary-600 transition shadow-sm">
                <i class="hgi-stroke hgi-link-01"></i> View Live
            </a>
            <a href="{{ route('admin.stores.edit', $seller) }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-600 text-white text-sm font-black rounded-2xl hover:bg-primary-700 transition shadow-lg shadow-primary-600/20">
                <i class="hgi-stroke hgi-pencil-edit-01"></i> Edit Store
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="flex items-center gap-3 px-5 py-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-2xl text-emerald-700 dark:text-emerald-400 text-sm font-bold animate__animated animate__fadeIn">
            <i class="hgi-stroke hgi-checkmark-circle-01 text-lg"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="flex items-center gap-3 px-5 py-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-2xl text-red-700 dark:text-red-400 text-sm font-bold animate__animated animate__fadeIn">
            <i class="hgi-stroke hgi-alert-circle text-lg"></i> {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Left: Store Info Card -->
        <div class="space-y-6">
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 p-6 space-y-5">
                <div class="w-16 h-16 rounded-3xl bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center text-white font-black text-2xl mx-auto">
                    {{ strtoupper(substr($seller->store_name ?? $seller->name, 0, 2)) }}
                </div>
                @if($seller->store_bio)
                    <p class="text-sm text-secondary-500 dark:text-slate-400 text-center font-medium leading-relaxed">{{ $seller->store_bio }}</p>
                @endif
                <div class="divide-y divide-gray-50 dark:divide-slate-800 text-sm space-y-0">
                    <div class="flex justify-between py-3">
                        <span class="text-secondary-400 dark:text-slate-500 font-bold">Seller</span>
                        <a href="{{ route('admin.sellers.show', $seller) }}" class="font-black text-primary-600 hover:underline">{{ $seller->name }}</a>
                    </div>
                    <div class="flex justify-between py-3">
                        <span class="text-secondary-400 dark:text-slate-500 font-bold">Products</span>
                        <span class="font-black text-secondary-900 dark:text-white">{{ $seller->products->count() }}</span>
                    </div>
                    <div class="flex justify-between py-3">
                        <span class="text-secondary-400 dark:text-slate-500 font-bold">Featured</span>
                        <span class="font-black text-secondary-900 dark:text-white">{{ $featuredCount }} / 10</span>
                    </div>
                </div>
                <form action="{{ route('admin.stores.destroy', $seller) }}" method="POST"
                    onsubmit="return confirm('Delete this store? All featured products will be unfeatured.')">
                    @csrf @method('DELETE')
                    <button type="submit"
                        class="w-full px-4 py-2.5 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-2xl text-sm font-black hover:bg-red-100 dark:hover:bg-red-900/30 transition flex items-center justify-center gap-2">
                        <i class="hgi-stroke hgi-delete-01"></i> Delete Store
                    </button>
                </form>
            </div>
        </div>

        <!-- Right: Featured Products Management -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden">
                <div class="p-6 border-b border-gray-50 dark:border-slate-800 flex items-center justify-between">
                    <h3 class="font-black text-secondary-900 dark:text-white">Products
                        <span class="ml-2 text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">{{ $featuredCount }} / 10 Featured</span>
                    </h3>
                    <div class="h-1.5 w-32 bg-gray-100 dark:bg-slate-800 rounded-full overflow-hidden">
                        <div class="h-full bg-amber-400 rounded-full transition-all" style="width: {{ $featuredCount > 0 ? ($featuredCount / 10 * 100) : 0 }}%"></div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50/50 dark:bg-slate-800/30 text-secondary-400 dark:text-slate-500 text-[10px] uppercase font-black tracking-widest">
                                <th class="py-4 px-6">Product</th>
                                <th class="py-4 px-6">Price</th>
                                <th class="py-4 px-6">Stock</th>
                                <th class="py-4 px-6">Status</th>
                                <th class="py-4 px-6">Featured</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-slate-800 text-sm">
                            @forelse($seller->products as $product)
                                <tr class="hover:bg-primary-50/20 dark:hover:bg-primary-900/5 transition-colors">
                                    <td class="py-4 px-6 font-bold text-secondary-900 dark:text-white">{{ $product->name }}</td>
                                    <td class="py-4 px-6 font-black text-secondary-900 dark:text-white">MYR {{ number_format($product->price, 2) }}</td>
                                    <td class="py-4 px-6 text-secondary-500 dark:text-slate-400">{{ $product->quantity }} units</td>
                                    <td class="py-4 px-6">
                                        @if($product->is_active)
                                            <span class="inline-flex px-2 py-0.5 bg-emerald-100 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 text-[10px] font-black uppercase rounded-lg">Active</span>
                                        @else
                                            <span class="inline-flex px-2 py-0.5 bg-amber-100 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400 text-[10px] font-black uppercase rounded-lg">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6">
                                        <form action="{{ route('admin.stores.featured.toggle', [$seller, $product]) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="px-3 py-1.5 rounded-xl text-[10px] font-black transition
                                                    {{ $product->is_featured
                                                        ? 'bg-amber-100 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400 hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600'
                                                        : 'bg-gray-100 dark:bg-slate-800 text-secondary-500 hover:bg-amber-50 dark:hover:bg-amber-900/20 hover:text-amber-600' }}
                                                    {{ !$product->is_featured && $featuredCount >= 10 ? 'opacity-40 cursor-not-allowed' : '' }}"
                                                {{ !$product->is_featured && $featuredCount >= 10 ? 'disabled' : '' }}>
                                                <i class="hgi-stroke hgi-star text-sm"></i>
                                                {{ $product->is_featured ? 'Featured' : 'Add' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center text-secondary-400 dark:text-slate-500 font-bold italic">No products from this seller yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

