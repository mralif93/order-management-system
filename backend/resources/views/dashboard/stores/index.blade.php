@extends('layouts.dashboard')

@section('title', 'Stores')

@section('content')
    <div class="max-w-[1600px] mx-auto space-y-8 pb-12 transition-colors duration-300">

        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black text-secondary-900 dark:text-white tracking-tight">Stores</h1>
                <p class="text-secondary-400 dark:text-slate-500 text-sm font-medium mt-1">All active seller storefronts</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.stores.create') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary-600 text-white text-sm font-black rounded-2xl hover:bg-primary-700 transition shadow-lg shadow-primary-600/20">
                    <i class="hgi-stroke hgi-store-add-01"></i> New Store
                </a>
                <form method="GET" action="{{ route('admin.stores.index') }}" class="flex items-center gap-2">
                    <div class="relative">
                        <i
                            class="hgi-stroke hgi-search-01 absolute left-3 top-1/2 -translate-y-1/2 text-secondary-400 dark:text-slate-500 text-sm pointer-events-none"></i>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search stores…"
                            class="pl-9 pr-4 py-2.5 text-sm rounded-2xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-secondary-900 dark:text-white placeholder-secondary-300 dark:placeholder-slate-600 focus:ring-2 focus:ring-primary-500 outline-none w-64 transition">
                    </div>
                    <button type="submit"
                        class="px-4 py-2.5 bg-primary-600 text-white text-sm font-black rounded-2xl hover:bg-primary-700 transition shadow-lg shadow-primary-600/20">Search</button>
                    @if(request('search'))
                        <a href="{{ route('admin.stores.index') }}"
                            class="px-4 py-2.5 bg-gray-100 dark:bg-slate-800 text-secondary-600 dark:text-slate-400 text-sm font-black rounded-2xl hover:bg-gray-200 dark:hover:bg-slate-700 transition">Clear</a>
                    @endif
                </form>
            </div>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div
                class="flex items-center gap-3 px-5 py-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-2xl text-emerald-700 dark:text-emerald-400 text-sm font-bold animate__animated animate__fadeIn">
                <i class="hgi-stroke hgi-checkmark-circle-01 text-lg"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Stats Row -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="p-6 bg-white dark:bg-slate-900 rounded-3xl border border-gray-100 dark:border-slate-800 shadow-sm">
                <div
                    class="w-12 h-12 rounded-2xl bg-primary-100 dark:bg-primary-900/20 text-primary-600 flex items-center justify-center mb-4">
                    <i class="hgi-stroke hgi-store-01 text-2xl"></i>
                </div>
                <p class="text-3xl font-black text-secondary-900 dark:text-white tracking-tight">{{ $stores->total() }}</p>
                <p class="text-[10px] text-secondary-400 dark:text-slate-500 font-black uppercase tracking-widest mt-1">
                    Active Stores</p>
            </div>
            <div class="p-6 bg-white dark:bg-slate-900 rounded-3xl border border-gray-100 dark:border-slate-800 shadow-sm">
                <div
                    class="w-12 h-12 rounded-2xl bg-violet-100 dark:bg-violet-900/20 text-violet-600 flex items-center justify-center mb-4">
                    <i class="hgi-stroke hgi-package text-2xl"></i>
                </div>
                <p class="text-3xl font-black text-secondary-900 dark:text-white tracking-tight">
                    {{ $stores->sum('products_count') }}</p>
                <p class="text-[10px] text-secondary-400 dark:text-slate-500 font-black uppercase tracking-widest mt-1">
                    Total Products</p>
            </div>
            <div class="p-6 bg-white dark:bg-slate-900 rounded-3xl border border-gray-100 dark:border-slate-800 shadow-sm">
                <div
                    class="w-12 h-12 rounded-2xl bg-amber-100 dark:bg-amber-900/20 text-amber-600 flex items-center justify-center mb-4">
                    <i class="hgi-stroke hgi-star text-2xl"></i>
                </div>
                <p class="text-3xl font-black text-secondary-900 dark:text-white tracking-tight">
                    {{ $stores->sum('featured_count') }}</p>
                <p class="text-[10px] text-secondary-400 dark:text-slate-500 font-black uppercase tracking-widest mt-1">
                    Featured Products</p>
            </div>
        </div>

        <!-- Table -->
        <div
            class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr
                            class="bg-gray-50/50 dark:bg-slate-800/30 text-secondary-400 dark:text-slate-500 text-[10px] uppercase font-black tracking-widest">
                            <th class="py-4 px-6">Store</th>
                            <th class="py-4 px-6">Seller</th>
                            <th class="py-4 px-6">Store URL</th>
                            <th class="py-4 px-6">Products</th>
                            <th class="py-4 px-6">Featured</th>
                            <th class="py-4 px-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-slate-800 text-sm">
                        @forelse($stores as $store)
                            <tr class="hover:bg-primary-50/20 dark:hover:bg-primary-900/5 transition-colors">
                                <td class="py-5 px-6">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-2xl bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center text-white font-black text-sm flex-shrink-0">
                                            {{ strtoupper(substr($store->store_name ?? $store->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="font-black text-secondary-900 dark:text-white leading-none">
                                                {{ $store->store_name ?? $store->name }}</p>
                                            @if($store->store_bio)
                                                <p
                                                    class="text-[11px] text-secondary-400 dark:text-slate-500 mt-0.5 truncate max-w-[180px]">
                                                    {{ $store->store_bio }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="py-5 px-6">
                                    <p class="font-bold text-secondary-900 dark:text-white">{{ $store->name }}</p>
                                    <p class="text-[11px] text-secondary-400 dark:text-slate-500">{{ $store->email }}</p>
                                </td>
                                <td class="py-5 px-6">
                                    <a href="{{ route('public.store', $store->store_slug) }}" target="_blank"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-400 text-[10px] font-black uppercase tracking-wider hover:bg-primary-100 dark:hover:bg-primary-900/30 transition">
                                        <i class="hgi-stroke hgi-link-01 text-sm"></i>
                                        /shop/{{ $store->store_slug }}
                                    </a>
                                </td>
                                <td class="py-5 px-6">
                                    <span
                                        class="text-lg font-black text-secondary-900 dark:text-white">{{ $store->products_count }}</span>
                                </td>
                                <td class="py-5 px-6">
                                    <div class="flex items-center gap-2">
                                        <div class="h-1.5 w-24 bg-gray-100 dark:bg-slate-800 rounded-full overflow-hidden">
                                            <div class="h-full bg-amber-400 rounded-full transition-all"
                                                style="width: {{ $store->featured_count > 0 ? ($store->featured_count / 10 * 100) : 0 }}%">
                                            </div>
                                        </div>
                                        <span
                                            class="text-xs font-black text-secondary-600 dark:text-slate-400">{{ $store->featured_count }}
                                            / 10</span>
                                    </div>
                                </td>
                                <td class="py-5 px-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.stores.show', $store) }}"
                                            class="p-2 text-gray-400 dark:text-slate-500 hover:text-primary-600 dark:hover:text-primary-400 transition"
                                            title="View">
                                            <i class="hgi-stroke hgi-eye text-xl"></i>
                                        </a>
                                        <a href="{{ route('admin.stores.edit', $store) }}"
                                            class="p-2 text-gray-400 dark:text-slate-500 hover:text-primary-600 dark:hover:text-primary-400 transition"
                                            title="Edit">
                                            <i class="hgi-stroke hgi-pencil-edit-01 text-xl"></i>
                                        </a>
                                        <form action="{{ route('admin.stores.destroy', $store) }}" method="POST"
                                            onsubmit="return confirm('Delete this store? All featured products will be unfeatured.')" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-gray-400 dark:text-slate-500 hover:text-red-600 transition"
                                                title="Delete">
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
                                        <div
                                            class="w-16 h-16 rounded-full bg-gray-50 dark:bg-slate-800 flex items-center justify-center text-gray-300 dark:text-slate-600">
                                            <i class="hgi-stroke hgi-store-01 text-3xl"></i>
                                        </div>
                                        <p class="text-secondary-400 dark:text-slate-500 font-bold">No stores found.</p>
                                        <p class="text-secondary-300 dark:text-slate-600 text-sm">Sellers need to claim a store
                                            URL first.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($stores->hasPages())
                <div class="px-6 py-4 border-t border-gray-50 dark:border-slate-800">
                    {{ $stores->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection