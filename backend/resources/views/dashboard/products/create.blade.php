@extends('layouts.dashboard')

@section('title', 'Add New Product | OMS Admin')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 pb-12 transition-colors duration-300">
    <!-- Breadcrumbs/Back -->
    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-secondary-500 dark:text-slate-400 hover:text-primary-600 transition group">
        <i class="hgi-stroke hgi-arrow-left-01 group-hover:-translate-x-1 transition-transform"></i>
        <span>Back to Products</span>
    </a>

    <!-- Header -->
    <div class="animate__animated animate__fadeInDown">
        <h1 class="text-3xl font-extrabold text-secondary-900 dark:text-white tracking-tight">Create Product</h1>
        <p class="text-secondary-500 dark:text-slate-400 mt-2 font-medium">Add a new item to your catalog with pricing and stock details.</p>
    </div>

    <!-- Form Card -->
    <form action="{{ route('products.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 p-8 space-y-8 animate__animated animate__fadeInUp">
            
            <!-- Basic Information -->
            <section class="space-y-6">
                <div class="flex items-center gap-3 border-b border-gray-50 dark:border-slate-800 pb-4">
                    <div class="w-8 h-8 rounded-lg bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 flex items-center justify-center">
                        <i class="hgi-stroke hgi-information-circle"></i>
                    </div>
                    <h3 class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter">Basic Info</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-black text-secondary-700 dark:text-slate-300 uppercase tracking-widest pl-1">Product Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm focus:ring-2 focus:ring-primary-600 dark:text-white outline-none"
                            placeholder="e.g. Premium Coffee Beans">
                        @error('name') <p class="text-xs text-red-500 font-bold mt-1 pl-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-black text-secondary-700 dark:text-slate-300 uppercase tracking-widest pl-1">SKU</label>
                        <input type="text" name="sku" value="{{ old('sku') }}" required
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm focus:ring-2 focus:ring-primary-600 dark:text-white outline-none"
                            placeholder="e.g. COF-001">
                        @error('sku') <p class="text-xs text-red-500 font-bold mt-1 pl-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-black text-secondary-700 dark:text-slate-300 uppercase tracking-widest pl-1">Description</label>
                    <textarea name="description" rows="4"
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm focus:ring-2 focus:ring-primary-600 dark:text-white outline-none resize-none"
                        placeholder="Tell more about the product...">{{ old('description') }}</textarea>
                    @error('description') <p class="text-xs text-red-500 font-bold mt-1 pl-1">{{ $message }}</p> @enderror
                </div>
            </section>

            <!-- Inventory & Pricing -->
            <section class="space-y-6">
                <div class="flex items-center gap-3 border-b border-gray-50 dark:border-slate-800 pb-4">
                    <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                        <i class="hgi-stroke hgi-money-send-01"></i>
                    </div>
                    <h3 class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter">Inventory & Pricing</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-black text-secondary-700 dark:text-slate-300 uppercase tracking-widest pl-1">Price</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold text-sm">USD</span>
                            <input type="number" name="price" step="0.01" value="{{ old('price') }}" required
                                class="w-full pl-14 pr-4 py-3 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm focus:ring-2 focus:ring-primary-600 dark:text-white outline-none"
                                placeholder="0.00">
                        </div>
                        @error('price') <p class="text-xs text-red-500 font-bold mt-1 pl-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-black text-secondary-700 dark:text-slate-300 uppercase tracking-widest pl-1">Currency</label>
                        <select name="currency" required
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm focus:ring-2 focus:ring-primary-600 dark:text-white outline-none">
                            <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD - Dollar</option>
                            <option value="MYR" {{ old('currency') == 'MYR' || !old('currency') ? 'selected' : '' }}>MYR - Ringgit</option>
                            <option value="SGD" {{ old('currency') == 'SGD' ? 'selected' : '' }}>SGD - Dollar</option>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-black text-secondary-700 dark:text-slate-300 uppercase tracking-widest pl-1">Stock Quantity</label>
                        <input type="number" name="stock_quantity" value="{{ old('stock_quantity', 0) }}" required
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm focus:ring-2 focus:ring-primary-600 dark:text-white outline-none"
                            placeholder="0">
                        @error('stock_quantity') <p class="text-xs text-red-500 font-bold mt-1 pl-1">{{ $message }}</p> @enderror
                    </div>
                </div>
            </section>

            <!-- Settings -->
            <section class="space-y-6">
                <div class="flex items-center gap-3 border-b border-gray-50 dark:border-slate-800 pb-4">
                    <div class="w-8 h-8 rounded-lg bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 flex items-center justify-center">
                        <i class="hgi-stroke hgi-setting-01"></i>
                    </div>
                    <h3 class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter">Settings</h3>
                </div>

                <div class="flex items-center gap-3">
                    <input type="hidden" name="is_active" value="0">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 dark:bg-slate-800 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary-600"></div>
                        <span class="ml-3 text-sm font-bold text-secondary-700 dark:text-slate-300">Active and Visible in Store</span>
                    </label>
                </div>
            </section>
        </div>

        <div class="flex items-center justify-end gap-4">
            <a href="{{ route('products.index') }}" class="px-6 py-3 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 text-secondary-700 dark:text-slate-300 rounded-2xl font-bold hover:bg-gray-50 dark:hover:bg-slate-700 transition">
                Cancel
            </a>
            <button type="submit" class="px-8 py-3 bg-secondary-900 dark:bg-primary-600 text-white rounded-2xl font-black hover:shadow-xl transition-all shadow-lg active:scale-95">
                Save Product
            </button>
        </div>
    </form>
</div>
@endsection
