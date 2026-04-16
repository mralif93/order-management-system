@extends('layouts.seller')

@section('title', 'My Store | Seller Portal')

@section('content')
    <div class="max-w-[1600px] mx-auto space-y-8 pb-12 transition-colors duration-300">

        <!-- Page Header -->
        <div
            class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate__animated animate__fadeInDown">
            <div>
                <h1 class="text-3xl font-black text-secondary-900 dark:text-white tracking-tight leading-none uppercase">My
                    Store</h1>
                <p class="text-secondary-500 dark:text-slate-400 mt-2 font-medium">
                    {{ $seller->store_slug ? 'Manage your public store page and featured products.' : 'Claim your unique store URL to get started.' }}
                </p>
            </div>
            @if($seller->store_slug)
                <a href="{{ route('public.store', $seller->store_slug) }}" target="_blank"
                    class="inline-flex items-center gap-2 px-5 py-3 bg-primary-600 text-white rounded-2xl font-black text-sm hover:bg-primary-700 transition shadow-lg shadow-primary-600/20">
                    <i class="hgi-stroke hgi-link-01 text-lg"></i> View Live Store
                </a>
            @endif
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div
                class="animate__animated animate__fadeInDown flex items-center gap-3 p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-2xl text-emerald-700 dark:text-emerald-400 font-bold text-sm">
                <i class="hgi-stroke hgi-checkmark-circle-02 text-xl"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div
                class="animate__animated animate__fadeInDown flex items-center gap-3 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-2xl text-red-700 dark:text-red-400 font-bold text-sm">
                <i class="hgi-stroke hgi-alert-circle text-xl"></i> {{ session('error') }}
            </div>
        @endif

        @if(!$seller->store_slug)
            {{-- ===== SETUP PAGE ===== --}}
            <div
                class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden animate__animated animate__fadeInUp">
                <div class="p-8 border-b border-gray-50 dark:border-slate-800">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-14 h-14 rounded-2xl bg-primary-100 dark:bg-primary-900/20 flex items-center justify-center flex-shrink-0">
                            <i class="hgi-stroke hgi-store-01 text-2xl text-primary-600 dark:text-primary-400"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-black text-secondary-900 dark:text-white tracking-tighter uppercase">Claim
                                Your Store URL</h2>
                            <p class="text-secondary-400 dark:text-slate-500 text-sm font-medium mt-0.5">Choose a unique name —
                                it can't be changed later.</p>
                        </div>
                    </div>
                </div>
                <form action="{{ route('seller.store.setup') }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    <div>
                        <label
                            class="block text-xs font-black text-secondary-600 dark:text-slate-400 uppercase tracking-widest mb-2">Store
                            URL *</label>
                        <div
                            class="flex items-center rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 overflow-hidden focus-within:ring-2 focus-within:ring-primary-500">
                            <span
                                class="px-4 py-3.5 text-sm font-bold text-secondary-400 dark:text-slate-500 bg-gray-100 dark:bg-slate-700 border-r border-gray-200 dark:border-slate-700 whitespace-nowrap select-none">
                                {{ request()->getSchemeAndHttpHost() }}/shop/
                            </span>
                            <input type="text" name="store_slug" value="{{ old('store_slug') }}" placeholder="your-store-name"
                                class="flex-1 px-4 py-3.5 bg-transparent border-none focus:ring-0 font-black text-secondary-900 dark:text-white text-sm outline-none"
                                pattern="[a-z0-9\-]+" oninput="this.value=this.value.toLowerCase().replace(/[^a-z0-9\-]/g,'')">
                        </div>
                        @error('store_slug') <p class="text-xs text-red-500 font-bold mt-2 pl-1">{{ $message }}</p> @enderror
                        <p class="text-xs text-secondary-400 dark:text-slate-500 mt-2 pl-1">Lowercase letters, numbers, and
                            hyphens only. Min 3 characters.</p>
                    </div>
                    <div>
                        <label
                            class="block text-xs font-black text-secondary-600 dark:text-slate-400 uppercase tracking-widest mb-2">Display
                            Name</label>
                        <input type="text" name="store_name" value="{{ old('store_name', $seller->name) }}"
                            placeholder="e.g. Alif's Shop"
                            class="w-full px-4 py-3.5 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 font-bold text-secondary-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none">
                        @error('store_name') <p class="text-xs text-red-500 font-bold mt-2 pl-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label
                            class="block text-xs font-black text-secondary-600 dark:text-slate-400 uppercase tracking-widest mb-2">Bio
                            / Tagline</label>
                        <textarea name="store_bio" rows="3" placeholder="Tell customers what you sell..."
                            class="w-full px-4 py-3.5 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 font-medium text-secondary-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 focus:border-transparent outline-none resize-none">{{ old('store_bio') }}</textarea>
                        @error('store_bio') <p class="text-xs text-red-500 font-bold mt-2 pl-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label
                            class="block text-xs font-black text-secondary-600 dark:text-slate-400 uppercase tracking-widest mb-2">Delivery
                            Fee (MYR)</label>
                        <div
                            class="flex items-center rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 overflow-hidden focus-within:ring-2 focus-within:ring-primary-500">
                            <span
                                class="px-4 py-3.5 text-sm font-bold text-secondary-400 dark:text-slate-500 bg-gray-100 dark:bg-slate-700 border-r border-gray-200 dark:border-slate-700 select-none">MYR</span>
                            <input type="number" name="delivery_fee" value="{{ old('delivery_fee', '0.00') }}" min="0"
                                max="9999.99" step="0.01" placeholder="0.00"
                                class="flex-1 px-4 py-3.5 bg-transparent border-none focus:ring-0 font-black text-secondary-900 dark:text-white text-sm outline-none">
                        </div>
                        @error('delivery_fee') <p class="text-xs text-red-500 font-bold mt-2 pl-1">{{ $message }}</p> @enderror
                        <p class="text-xs text-secondary-400 dark:text-slate-500 mt-2 pl-1">Set to 0 for free delivery.</p>
                    </div>
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-8 py-3.5 bg-primary-600 text-white rounded-2xl font-black text-sm hover:bg-primary-700 transition shadow-lg shadow-primary-600/20">
                        <i class="hgi-stroke hgi-store-01"></i> Claim Store URL
                    </button>
                </form>
            </div>

        @else
            {{-- ===== MANAGEMENT PAGE ===== --}}
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

                {{-- Store Info Card --}}
                <div class="xl:col-span-1 space-y-6 animate__animated animate__fadeInLeft">
                    <div
                        class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden">
                        <div class="p-6 border-b border-gray-50 dark:border-slate-800">
                            <h2 class="text-base font-black text-secondary-900 dark:text-white tracking-tighter uppercase">Store
                                Info</h2>
                        </div>
                        <div class="p-6 space-y-4">
                            {{-- Live URL --}}
                            <div
                                class="p-4 rounded-2xl bg-primary-50 dark:bg-primary-900/10 border border-primary-100 dark:border-primary-800">
                                <p
                                    class="text-[10px] font-black uppercase tracking-widest text-primary-600 dark:text-primary-400 mb-1">
                                    Your Store URL</p>
                                <a href="{{ route('public.store', $seller->store_slug) }}" target="_blank"
                                    class="text-sm font-black text-primary-700 dark:text-primary-300 hover:underline break-all flex items-center gap-1">
                                    /shop/{{ $seller->store_slug }}
                                    <i class="hgi-stroke hgi-link-01 text-xs flex-shrink-0"></i>
                                </a>
                            </div>
                            {{-- Featured count --}}
                            <div class="flex items-center justify-between p-4 rounded-2xl bg-gray-50 dark:bg-slate-800">
                                <span class="text-sm font-black text-secondary-600 dark:text-slate-400">Featured Products</span>
                                <span
                                    class="text-sm font-black {{ $featuredCount >= 10 ? 'text-red-600 dark:text-red-400' : 'text-secondary-900 dark:text-white' }}">
                                    {{ $featuredCount }} / 10
                                </span>
                            </div>
                        </div>
                        {{-- Edit store info --}}
                        <form action="{{ route('seller.store.update') }}" method="POST" class="p-6 pt-0 space-y-4">
                            @csrf @method('PATCH')
                            <div>
                                <label
                                    class="block text-xs font-black text-secondary-600 dark:text-slate-400 uppercase tracking-widest mb-2">Display
                                    Name</label>
                                <input type="text" name="store_name" value="{{ old('store_name', $seller->store_name) }}"
                                    class="w-full px-4 py-3 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 font-bold text-secondary-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 outline-none">
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-black text-secondary-600 dark:text-slate-400 uppercase tracking-widest mb-2">Bio
                                    / Tagline</label>
                                <textarea name="store_bio" rows="3"
                                    class="w-full px-4 py-3 rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 font-medium text-secondary-900 dark:text-white text-sm focus:ring-2 focus:ring-primary-500 outline-none resize-none">{{ old('store_bio', $seller->store_bio) }}</textarea>
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-black text-secondary-600 dark:text-slate-400 uppercase tracking-widest mb-2">Delivery
                                    Fee (MYR)</label>
                                <div
                                    class="flex items-center rounded-2xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 overflow-hidden focus-within:ring-2 focus-within:ring-primary-500">
                                    <span
                                        class="px-4 py-3 text-sm font-bold text-secondary-400 dark:text-slate-500 bg-gray-100 dark:bg-slate-700 border-r border-gray-200 dark:border-slate-700 select-none">MYR</span>
                                    <input type="number" name="delivery_fee"
                                        value="{{ old('delivery_fee', number_format($seller->delivery_fee ?? 0, 2)) }}" min="0"
                                        max="9999.99" step="0.01" placeholder="0.00"
                                        class="flex-1 px-4 py-3 bg-transparent border-none focus:ring-0 font-black text-secondary-900 dark:text-white text-sm outline-none">
                                </div>
                                @error('delivery_fee') <p class="text-xs text-red-500 font-bold mt-1 pl-1">{{ $message }}</p>
                                @enderror
                                <p class="text-xs text-secondary-400 dark:text-slate-500 mt-2 pl-1">Set to 0 for free
                                    delivery.</p>
                            </div>
                            <button type="submit"
                                class="w-full py-3 bg-secondary-900 dark:bg-slate-700 text-white rounded-2xl font-black text-sm hover:bg-primary-600 transition">
                                Save Changes
                            </button>
                        </form>
                    </div>
                </div>



                {{-- Products Picker --}}
                <div class="xl:col-span-2 animate__animated animate__fadeInRight">
                    <div
                        class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden">
                        <div class="p-6 border-b border-gray-50 dark:border-slate-800 flex items-center justify-between">
                            <div>
                                <h2 class="text-base font-black text-secondary-900 dark:text-white tracking-tighter uppercase">
                                    Featured Products</h2>
                                <p class="text-secondary-400 dark:text-slate-500 text-xs font-medium mt-0.5">Toggle products to
                                    show on your public store. Max 10.</p>
                            </div>
                        </div>
                        <div class="divide-y divide-gray-50 dark:divide-slate-800">
                            @forelse($products as $product)
                                <div
                                    class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50/50 dark:hover:bg-slate-800/50 transition">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-9 h-9 rounded-xl {{ $product->is_featured ? 'bg-primary-600' : 'bg-gray-100 dark:bg-slate-800' }} flex items-center justify-center transition">
                                            <i
                                                class="hgi-stroke hgi-package text-base {{ $product->is_featured ? 'text-white' : 'text-gray-300 dark:text-slate-600' }}"></i>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-black text-secondary-900 dark:text-white text-sm truncate">
                                            {{ $product->name }}
                                        </p>
                                        <p class="text-xs text-secondary-400 dark:text-slate-500 font-medium">
                                            <span class="font-mono">{{ $product->sku }}</span>
                                            &nbsp;·&nbsp; MYR {{ number_format($product->price, 2) }}
                                            &nbsp;·&nbsp; {{ $product->quantity }} in stock
                                        </p>
                                    </div>
                                    @if($product->is_featured)
                                        <span
                                            class="hidden sm:inline-flex items-center gap-1 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-primary-100 dark:bg-primary-900/20 text-primary-700 dark:text-primary-400">
                                            <i class="hgi-stroke hgi-star text-xs"></i> Featured
                                        </span>
                                    @endif
                                    <form action="{{ route('seller.store.featured.toggle', $product) }}" method="POST"
                                        class="flex-shrink-0">
                                        @csrf
                                        <button type="submit"
                                            class="px-4 py-2 rounded-xl text-xs font-black transition
                                                                                    {{ $product->is_featured ? 'bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 hover:bg-red-100' : 'bg-secondary-900 dark:bg-slate-700 text-white hover:bg-primary-600' }}
                                                                                    {{ !$product->is_featured && $featuredCount >= 10 ? 'opacity-40 cursor-not-allowed' : '' }}"
                                            {{ !$product->is_featured && $featuredCount >= 10 ? 'disabled' : '' }}>
                                            {{ $product->is_featured ? 'Remove' : 'Add' }}
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div class="py-20 text-center">
                                    <div class="flex flex-col items-center gap-4">
                                        <div
                                            class="w-20 h-20 rounded-full bg-gray-50 dark:bg-slate-800 flex items-center justify-center">
                                            <i class="hgi-stroke hgi-package text-4xl text-gray-200 dark:text-slate-700"></i>
                                        </div>
                                        <div>
                                            <h3
                                                class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter">
                                                No products yet</h3>
                                            <p class="text-secondary-400 dark:text-slate-500 text-sm font-medium mt-1">Add products
                                                first, then feature them here.</p>
                                        </div>
                                        <a href="{{ route('seller.products.create') }}"
                                            class="px-6 py-3 bg-primary-600 text-white rounded-2xl font-black text-sm hover:bg-primary-700 transition shadow-lg shadow-primary-600/20 inline-flex items-center gap-2">
                                            <i class="hgi-stroke hgi-add-01"></i> Add Product
                                        </a>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>{{-- end grid --}}
        @endif

    </div>
@endsection