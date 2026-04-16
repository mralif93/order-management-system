@extends('layouts.dashboard')

@section('title', 'Seller Details | OMS Admin')

@section('content')
    <div class="max-w-[1600px] mx-auto space-y-8 pb-12 transition-colors duration-300">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="animate__animated animate__fadeInLeft">
                <div class="flex items-center gap-3 mb-2">
                    <a href="javascript:history.back()"
                        class="text-secondary-400 hover:text-primary-600 transition-colors">
                        <i class="hgi-stroke hgi-arrow-left-01 text-2xl"></i>
                    </a>
                    <span class="text-secondary-400 font-black text-xs uppercase tracking-widest">Seller Details</span>
                </div>
                <h1 class="text-3xl font-extrabold text-secondary-900 dark:text-white tracking-tight leading-none">
                    {{ $seller->name }}</h1>
            </div>
            <div class="flex items-center gap-3 animate__animated animate__fadeInRight">
                <a href="{{ route('admin.sellers.edit', $seller) }}"
                    class="px-6 py-3 bg-primary-600 text-white rounded-2xl font-black hover:bg-primary-700 transition flex items-center gap-2 shadow-lg shadow-primary-600/20">
                    <i class="hgi-stroke hgi-edit-01 text-xl"></i> Edit Seller
                </a>
                <form action="{{ route('admin.sellers.destroy', $seller) }}" method="POST"
                    onsubmit="return confirm('Delete this seller?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-6 py-3 bg-red-600 text-white rounded-2xl font-black hover:bg-red-700 transition flex items-center gap-2">
                        <i class="hgi-stroke hgi-delete-01 text-xl"></i> Delete
                    </button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div
                class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-100 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400 px-6 py-4 rounded-2xl font-bold animate__animated animate__fadeIn">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column -->
            <div class="lg:col-span-1 space-y-8">
                <!-- Profile Card -->
                <div
                    class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden">
                    <div class="h-24 bg-gradient-to-r from-violet-500 to-violet-700"></div>
                    <div class="px-8 pb-8">
                        <div class="relative -mt-12 mb-6">
                            <div class="w-24 h-24 rounded-3xl bg-white dark:bg-slate-800 p-2 shadow-xl">
                                <div
                                    class="w-full h-full rounded-2xl bg-violet-100 dark:bg-violet-900/30 text-violet-600 flex items-center justify-center font-black text-3xl">
                                    {{ substr($seller->name, 0, 1) }}
                                </div>
                            </div>
                        </div>
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-xl font-black text-secondary-900 dark:text-white leading-tight">
                                    {{ $seller->name }}</h3>
                                <p class="text-secondary-400 dark:text-slate-500 text-sm font-medium mt-1">
                                    {{ $seller->email }}</p>
                            </div>
                            <div class="grid grid-cols-1 gap-4">
                                <div
                                    class="p-4 bg-gray-50 dark:bg-slate-800 rounded-2xl border border-gray-100 dark:border-slate-700/50">
                                    <span
                                        class="text-[10px] text-secondary-400 dark:text-slate-500 uppercase font-black tracking-widest block mb-1">Phone
                                        Number</span>
                                    <span
                                        class="text-secondary-900 dark:text-white font-bold">{{ $seller->phone ?? 'Not provided' }}</span>
                                </div>
                                <div
                                    class="p-4 bg-gray-50 dark:bg-slate-800 rounded-2xl border border-gray-100 dark:border-slate-700/50">
                                    <span
                                        class="text-[10px] text-secondary-400 dark:text-slate-500 uppercase font-black tracking-widest block mb-1">Member
                                        Since</span>
                                    <span
                                        class="text-secondary-900 dark:text-white font-bold">{{ $seller->created_at->format('M d, Y') }}</span>
                                </div>
                                <div
                                    class="p-4 bg-gray-50 dark:bg-slate-800 rounded-2xl border border-gray-100 dark:border-slate-700/50">
                                    <span
                                        class="text-[10px] text-secondary-400 dark:text-slate-500 uppercase font-black tracking-widest block mb-1">Account
                                        Status</span>
                                    <div class="flex gap-2 mt-1">
                                        @if($seller->is_locked)
                                            <span
                                                class="inline-flex px-2 py-0.5 bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-400 text-[10px] font-black uppercase rounded-lg">Locked</span>
                                        @endif
                                        @if($seller->is_active)
                                            <span
                                                class="inline-flex px-2 py-0.5 bg-emerald-100 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 text-[10px] font-black uppercase rounded-lg">Active</span>
                                        @else
                                            <span
                                                class="inline-flex px-2 py-0.5 bg-amber-100 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400 text-[10px] font-black uppercase rounded-lg">Inactive</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Address Card -->
                <div
                    class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="w-10 h-10 rounded-xl bg-secondary-100 dark:bg-secondary-800 text-secondary-600 dark:text-slate-400 flex items-center justify-center">
                            <i class="hgi-stroke hgi-location-01 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-black text-secondary-900 dark:text-white leading-none">Business Address</h3>
                            <p class="text-[10px] text-secondary-400 dark:text-slate-500 uppercase tracking-widest mt-1">
                                Primary Location</p>
                        </div>
                    </div>
                    <div class="space-y-1 text-sm">
                        @if($seller->address_line1)
                            <p class="text-secondary-700 dark:text-slate-300 font-medium">{{ $seller->address_line1 }}</p>
                            @if($seller->address_line2)
                            <p class="text-secondary-700 dark:text-slate-300 font-medium">{{ $seller->address_line2 }}</p>@endif
                            @if($seller->address_line3)
                            <p class="text-secondary-700 dark:text-slate-300 font-medium">{{ $seller->address_line3 }}</p>@endif
                            <p class="text-secondary-700 dark:text-slate-300 font-medium">{{ $seller->postal_code }}
                                {{ $seller->city }}</p>
                            <p class="text-secondary-700 dark:text-slate-300 font-medium">{{ $seller->state }}</p>
                            <p class="text-secondary-900 dark:text-white font-black uppercase tracking-tight mt-2">
                                {{ $seller->country }}</p>
                        @else
                            <div
                                class="py-10 text-center bg-gray-50 dark:bg-slate-800 rounded-2xl border border-dashed border-gray-200 dark:border-slate-700">
                                <p class="text-secondary-400 dark:text-slate-500 font-bold italic">No address provided</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Stats -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div
                        class="p-6 bg-white dark:bg-slate-900 rounded-3xl border border-gray-100 dark:border-slate-800 shadow-sm">
                        <div
                            class="w-12 h-12 rounded-2xl bg-violet-100 dark:bg-violet-900/20 text-violet-600 flex items-center justify-center mb-4">
                            <i class="hgi-stroke hgi-package-01 text-2xl"></i>
                        </div>
                        <p class="text-3xl font-black text-secondary-900 dark:text-white tracking-tight">
                            {{ $seller->products->count() }}</p>
                        <p
                            class="text-[10px] text-secondary-400 dark:text-slate-500 font-black uppercase tracking-widest mt-1">
                            Total Products</p>
                    </div>
                    <div
                        class="p-6 bg-white dark:bg-slate-900 rounded-3xl border border-gray-100 dark:border-slate-800 shadow-sm">
                        <div
                            class="w-12 h-12 rounded-2xl bg-emerald-100 dark:bg-emerald-900/20 text-emerald-600 flex items-center justify-center mb-4">
                            <i class="hgi-stroke hgi-checkmark-circle-01 text-2xl"></i>
                        </div>
                        <p class="text-3xl font-black text-secondary-900 dark:text-white tracking-tight">
                            {{ $seller->products->where('is_active', true)->count() }}</p>
                        <p
                            class="text-[10px] text-secondary-400 dark:text-slate-500 font-black uppercase tracking-widest mt-1">
                            Active Products</p>
                    </div>
                    <div
                        class="p-6 bg-white dark:bg-slate-900 rounded-3xl border border-gray-100 dark:border-slate-800 shadow-sm">
                        <div
                            class="w-12 h-12 rounded-2xl bg-primary-100 dark:bg-primary-900/20 text-primary-600 flex items-center justify-center mb-4">
                            <i class="hgi-stroke hgi-store-01 text-2xl"></i>
                        </div>
                        <p class="text-3xl font-black text-secondary-900 dark:text-white tracking-tight">
                            {{ $featuredCount }}</p>
                        <p
                            class="text-[10px] text-secondary-400 dark:text-slate-500 font-black uppercase tracking-widest mt-1">
                            Featured in Store</p>
                    </div>
                </div>

                <!-- Store Management Panel -->
                <div
                    class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 dark:border-slate-800 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-xl bg-primary-100 dark:bg-primary-900/20 text-primary-600 flex items-center justify-center">
                                <i class="hgi-stroke hgi-store-01 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-black text-secondary-900 dark:text-white leading-none">Store Management</h3>
                                <p
                                    class="text-[10px] text-secondary-400 dark:text-slate-500 uppercase tracking-widest mt-0.5">
                                    @if($seller->store_slug)
                                        <a href="{{ route('public.store', $seller->store_slug) }}" target="_blank"
                                            class="text-primary-600 hover:underline font-black">/shop/{{ $seller->store_slug }}</a>
                                    @else
                                        No store URL claimed yet
                                    @endif
                                </p>
                            </div>
                        </div>
                        @if($seller->store_slug)
                            <form action="{{ route('admin.sellers.store.reset', $seller) }}" method="POST"
                                onsubmit="return confirm('Reset this seller\'s store URL? They will need to claim a new one.')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-xl text-xs font-black hover:bg-red-100 dark:hover:bg-red-900/30 transition flex items-center gap-1.5">
                                    <i class="hgi-stroke hgi-link-broken-01"></i> Reset URL
                                </button>
                            </form>
                        @endif
                    </div>
                    <form action="{{ route('admin.sellers.store.update', $seller) }}" method="POST"
                        class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        @csrf @method('PATCH')
                        <div>
                            <label
                                class="block text-[10px] font-black text-secondary-500 dark:text-slate-400 uppercase tracking-widest mb-2">Store
                                Slug</label>
                            <input type="text" name="store_slug" value="{{ old('store_slug', $seller->store_slug) }}"
                                placeholder="e.g. my-shop"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 font-mono text-secondary-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 outline-none"
                                oninput="this.value=this.value.toLowerCase().replace(/[^a-z0-9\-]/g,'')">
                            @error('store_slug') <p class="text-xs text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label
                                class="block text-[10px] font-black text-secondary-500 dark:text-slate-400 uppercase tracking-widest mb-2">Display
                                Name</label>
                            <input type="text" name="store_name" value="{{ old('store_name', $seller->store_name) }}"
                                placeholder="Store display name"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 font-bold text-secondary-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 outline-none">
                        </div>
                        <div>
                            <label
                                class="block text-[10px] font-black text-secondary-500 dark:text-slate-400 uppercase tracking-widest mb-2">Bio
                                / Tagline</label>
                            <input type="text" name="store_bio" value="{{ old('store_bio', $seller->store_bio) }}"
                                placeholder="Short bio"
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 font-medium text-secondary-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 outline-none">
                        </div>
                        <div class="sm:col-span-3 flex justify-end">
                            <button type="submit"
                                class="px-6 py-3 bg-primary-600 text-white rounded-2xl font-black text-sm hover:bg-primary-700 transition shadow-lg shadow-primary-600/20 flex items-center gap-2">
                                <i class="hgi-stroke hgi-checkmark-circle-01"></i> Save Store Info
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Products with featured toggle -->
                <div
                    class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 dark:border-slate-800 flex items-center justify-between">
                        <h3 class="font-black text-secondary-900 dark:text-white">Products
                            <span
                                class="ml-2 text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">{{ $featuredCount }}
                                / 10 Featured</span>
                        </h3>
                        <a href="{{ route('admin.products.index', ['search' => $seller->email]) }}"
                            class="text-primary-600 text-xs font-black uppercase tracking-widest hover:underline">View
                            All</a>
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
                                    <th class="py-4 px-6 text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 dark:divide-slate-800 text-sm">
                                @forelse($seller->products as $product)
                                    <tr class="hover:bg-primary-50/20 dark:hover:bg-primary-900/5 transition-colors">
                                        <td class="py-4 px-6 font-bold text-secondary-900 dark:text-white">{{ $product->name }}</td>
                                        <td class="py-4 px-6 font-black text-secondary-900 dark:text-white">MYR {{ number_format($product->price, 2) }}</td>
                                        <td class="py-4 px-6 text-secondary-600 dark:text-slate-400">{{ $product->quantity }} units</td>
                                        <td class="py-4 px-6">
                                            @if($product->is_active)
                                                <span class="inline-flex px-2 py-0.5 bg-emerald-100 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 text-[10px] font-black uppercase rounded-lg">Active</span>
                                            @else
                                                <span class="inline-flex px-2 py-0.5 bg-amber-100 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400 text-[10px] font-black uppercase rounded-lg">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6">
                                            <form action="{{ route('admin.sellers.store.featured.toggle', [$seller, $product]) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="px-3 py-1.5 rounded-xl text-[10px] font-black transition
                                                        {{ $product->is_featured
                                                            ? 'bg-primary-100 dark:bg-primary-900/20 text-primary-700 dark:text-primary-400 hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400'
                                                            : 'bg-gray-100 dark:bg-slate-800 text-secondary-500 dark:text-slate-400 hover:bg-primary-100 dark:hover:bg-primary-900/20 hover:text-primary-600' }}
                                                        {{ !$product->is_featured && $featuredCount >= 10 ? 'opacity-40 cursor-not-allowed' : '' }}"
                                                    title="{{ $product->is_featured ? 'Remove from store' : ($featuredCount >= 10 ? 'Max 10 reached' : 'Add to store') }}"
                                                    {{ !$product->is_featured && $featuredCount >= 10 ? 'disabled' : '' }}>
                                                    <i class="hgi-stroke {{ $product->is_featured ? 'hgi-star' : 'hgi-star' }} text-sm"></i>
                                                    {{ $product->is_featured ? 'Featured' : 'Add' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <a href="{{ route('admin.products.show', $product) }}" class="text-primary-600 hover:text-primary-700 transition-colors">
                                                <i class="hgi-stroke hgi-eye text-xl"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-12 text-center text-secondary-400 dark:text-slate-500 font-bold italic">No products listed by this seller.</td>
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