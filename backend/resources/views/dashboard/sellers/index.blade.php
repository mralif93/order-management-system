@extends('layouts.dashboard')

@section('title', 'Sellers Management | OMS Admin')

@section('content')
    <div class="max-w-[1600px] mx-auto space-y-8 pb-12 transition-colors duration-300">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="animate__animated animate__fadeInLeft">
                <h1 class="text-3xl font-extrabold text-secondary-900 dark:text-white tracking-tight leading-none">Sellers
                </h1>
                <p class="text-secondary-500 dark:text-slate-400 mt-2 font-medium">Manage your registered sellers and their
                    store activity.</p>
            </div>
            <div class="animate__animated animate__fadeInRight">
                <a href="{{ route('admin.sellers.create') }}"
                    class="px-6 py-3 bg-primary-600 text-white rounded-2xl font-black hover:bg-primary-700 transition flex items-center gap-2 shadow-lg shadow-primary-600/20">
                    <i class="hgi-stroke hgi-user-add-01 text-xl"></i> Add Seller
                </a>
            </div>
        </div>

        @if(session('success'))
            <div
                class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-100 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400 px-6 py-4 rounded-2xl font-bold animate__animated animate__fadeIn">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filters & Table Card -->
        <div
            class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden flex flex-col">
            <!-- Table Search/Filters -->
            <div
                class="p-6 border-b border-gray-50 dark:border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <form action="{{ route('admin.sellers.index') }}" method="GET" class="relative group w-full sm:w-96"
                    id="search-form">
                    <i
                        class="hgi-stroke hgi-search-01 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-slate-500 group-focus-within:text-primary-600 transition-colors"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by Name, Email or Phone..."
                        class="w-full pl-11 pr-4 py-2.5 bg-gray-50 dark:bg-slate-800 border-none rounded-xl text-sm focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200">
                </form>
                <div class="flex items-center gap-3">
                    <select name="status" onchange="document.getElementById('search-form').submit()" form="search-form"
                        class="px-4 py-2.5 bg-gray-50 dark:bg-slate-800 text-secondary-600 dark:text-slate-400 rounded-xl text-xs font-bold border-none focus:ring-2 focus:ring-primary-600 transition outline-none">
                        <option value="">All Statuses</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="locked" {{ request('status') == 'locked' ? 'selected' : '' }}>Locked</option>
                    </select>
                </div>
            </div>

            <!-- Table Content -->
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr
                            class="bg-gray-50/50 dark:bg-slate-800/30 text-secondary-400 dark:text-slate-500 text-[10px] uppercase font-black tracking-widest">
                            <th class="py-4 px-6">Seller</th>
                            <th class="py-4 px-6">Contact Info</th>
                            <th class="py-4 px-6">Location</th>
                            <th class="py-4 px-6">Products</th>
                            <th class="py-4 px-6">Store</th>
                            <th class="py-4 px-6">Status</th>
                            <th class="py-4 px-6">Joined Date</th>
                            <th class="py-4 px-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-slate-800 text-sm">
                        @forelse($sellers as $seller)
                            <tr class="hover:bg-primary-50/20 dark:hover:bg-primary-900/5 transition-colors group">
                                <td class="py-5 px-6">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-10 h-10 rounded-2xl bg-violet-100 dark:bg-violet-900/30 text-violet-600 flex items-center justify-center font-bold text-sm shadow-sm">
                                            {{ substr($seller->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-secondary-900 dark:text-white leading-none">
                                                {{ $seller->name }}
                                            </p>
                                            <p
                                                class="text-[10px] text-secondary-400 dark:text-slate-500 mt-1 uppercase tracking-wider">
                                                #ID-{{ str_pad($seller->id, 5, '0', STR_PAD_LEFT) }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-5 px-6">
                                    <div class="flex flex-col gap-1">
                                        <span
                                            class="text-secondary-700 dark:text-slate-300 font-medium">{{ $seller->email }}</span>
                                        <span
                                            class="text-xs text-secondary-400 dark:text-slate-500 font-bold tracking-tight">{{ $seller->phone ?? 'No Phone' }}</span>
                                    </div>
                                </td>
                                <td class="py-5 px-6">
                                    <div class="flex flex-col">
                                        <span class="text-secondary-600 dark:text-slate-400">{{ $seller->city ?? 'N/A' }},
                                            {{ $seller->state ?? 'N/A' }}</span>
                                        <span
                                            class="text-[10px] text-secondary-400 dark:text-slate-500 uppercase tracking-widest">{{ $seller->country }}</span>
                                    </div>
                                </td>
                                <td class="py-5 px-6">
                                    <span
                                        class="text-lg font-black text-secondary-900 dark:text-white">{{ $seller->products_count ?? $seller->products->count() }}</span>
                                </td>
                                <td class="py-5 px-6">
                                    @if($seller->store_slug)
                                        <a href="{{ route('public.store', $seller->store_slug) }}" target="_blank"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-400 text-[10px] font-black uppercase tracking-wider hover:bg-primary-100 dark:hover:bg-primary-900/30 transition">
                                            <i class="hgi-stroke hgi-store-01 text-sm"></i>
                                            {{ $seller->store_slug }}
                                        </a>
                                    @else
                                        <span
                                            class="text-[10px] font-black text-secondary-300 dark:text-slate-600 uppercase tracking-wider">No
                                            Store</span>
                                    @endif
                                </td>
                                <td class="py-5 px-6">
                                    <div class="flex flex-wrap gap-2">
                                        @if($seller->is_locked)
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-400">Locked</span>
                                        @elseif($seller->is_active)
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-100 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400">Active</span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-100 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400">Inactive</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-5 px-6">
                                    <p class="text-secondary-600 dark:text-slate-400 font-medium">
                                        {{ $seller->created_at->format('M d, Y') }}
                                    </p>
                                    <p
                                        class="text-[10px] text-secondary-400 dark:text-slate-500 uppercase mt-0.5 tracking-widest">
                                        {{ $seller->created_at->diffForHumans() }}
                                    </p>
                                </td>
                                <td class="py-5 px-6 text-right">
                                    <a href="{{ route('admin.sellers.show', $seller) }}"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 dark:bg-slate-800 text-secondary-700 dark:text-slate-300 rounded-xl text-xs font-black hover:bg-primary-600 hover:text-white transition shadow-sm">
                                        <i class="hgi-stroke hgi-eye text-lg"></i> Details
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-20 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div
                                            class="w-16 h-16 rounded-full bg-gray-50 dark:bg-slate-800 flex items-center justify-center text-gray-300 dark:text-slate-600">
                                            <i class="hgi-stroke hgi-store-01 text-3xl"></i>
                                        </div>
                                        <p class="text-secondary-500 dark:text-slate-400 font-bold tracking-tight">No sellers
                                            found.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($sellers->count() > 0 && $sellers->hasPages())
                <div class="p-6 bg-gray-50/50 dark:bg-slate-800/20 border-t border-gray-50 dark:border-slate-800">
                    {{ $sellers->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection