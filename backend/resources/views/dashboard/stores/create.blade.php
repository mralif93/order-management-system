@extends('layouts.dashboard')

@section('title', 'Create Store')

@section('content')
<div class="max-w-[1600px] mx-auto space-y-8 pb-12 transition-colors duration-300">

    <!-- Page Header -->
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.stores.index') }}"
            class="w-10 h-10 rounded-2xl bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 flex items-center justify-center text-secondary-400 hover:text-primary-600 transition shadow-sm">
            <i class="hgi-stroke hgi-arrow-left-01 text-xl"></i>
        </a>
        <div>
            <h1 class="text-3xl font-black text-secondary-900 dark:text-white tracking-tight">Create Store</h1>
            <p class="text-secondary-400 dark:text-slate-500 text-sm font-medium mt-1">Set up a storefront for a seller</p>
        </div>
    </div>

    <form action="{{ route('admin.stores.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Left: Seller Selection -->
            <div class="space-y-6">
                <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 p-6 space-y-5">
                    <h2 class="font-black text-secondary-900 dark:text-white text-lg">Select Seller</h2>
                    <div>
                        <label class="block text-[10px] font-black text-secondary-500 dark:text-slate-400 uppercase tracking-widest mb-2">Seller <span class="text-red-500">*</span></label>
                        @if($sellers->isEmpty())
                            <p class="text-sm text-amber-600 dark:text-amber-400 font-bold bg-amber-50 dark:bg-amber-900/20 rounded-2xl px-4 py-3">
                                All sellers already have a store. <a href="{{ route('admin.stores.index') }}" class="underline">View all stores</a>.
                            </p>
                        @else
                            <select name="seller_id" required
                                class="w-full px-4 py-3 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 text-secondary-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 outline-none">
                                <option value="">— Choose a seller —</option>
                                @foreach($sellers as $seller)
                                    <option value="{{ $seller->id }}" {{ old('seller_id') == $seller->id ? 'selected' : '' }}>
                                        {{ $seller->name }} ({{ $seller->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('seller_id') <p class="text-xs text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right: Store Details -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 p-6 space-y-5">
                    <h2 class="font-black text-secondary-900 dark:text-white text-lg">Store Details</h2>

                    <div>
                        <label class="block text-[10px] font-black text-secondary-500 dark:text-slate-400 uppercase tracking-widest mb-2">
                            Store Slug <span class="text-red-500">*</span>
                            <span class="normal-case font-medium text-secondary-300 dark:text-slate-600 ml-1">— public URL: /shop/<em>your-slug</em></span>
                        </label>
                        <div class="flex items-center rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 overflow-hidden focus-within:ring-2 focus-within:ring-primary-500">
                            <span class="px-4 py-3 text-sm text-secondary-400 dark:text-slate-500 font-mono border-r border-gray-200 dark:border-slate-700 whitespace-nowrap">/shop/</span>
                            <input type="text" name="store_slug" value="{{ old('store_slug') }}" required
                                placeholder="my-shop"
                                class="flex-1 px-4 py-3 bg-transparent font-mono text-secondary-900 dark:text-white text-sm outline-none"
                                oninput="this.value=this.value.toLowerCase().replace(/[^a-z0-9\-]/g,'')">
                        </div>
                        @error('store_slug') <p class="text-xs text-red-500 font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-secondary-500 dark:text-slate-400 uppercase tracking-widest mb-2">Display Name</label>
                        <input type="text" name="store_name" value="{{ old('store_name') }}"
                            placeholder="e.g. Alif's Gadget Shop"
                            class="w-full px-4 py-3 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 font-bold text-secondary-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 outline-none">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-secondary-500 dark:text-slate-400 uppercase tracking-widest mb-2">Bio / Tagline</label>
                        <textarea name="store_bio" rows="3"
                            placeholder="Short description shown on the store landing page…"
                            class="w-full px-4 py-3 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 font-medium text-secondary-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 outline-none resize-none">{{ old('store_bio') }}</textarea>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2">
                        <a href="{{ route('admin.stores.index') }}"
                            class="px-6 py-3 bg-gray-100 dark:bg-slate-800 text-secondary-600 dark:text-slate-400 rounded-2xl font-black text-sm hover:bg-gray-200 dark:hover:bg-slate-700 transition">
                            Cancel
                        </a>
                        <button type="submit" {{ $sellers->isEmpty() ? 'disabled' : '' }}
                            class="px-6 py-3 bg-primary-600 text-white rounded-2xl font-black text-sm hover:bg-primary-700 transition shadow-lg shadow-primary-600/20 flex items-center gap-2 disabled:opacity-40 disabled:cursor-not-allowed">
                            <i class="hgi-stroke hgi-store-add-01"></i> Create Store
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

