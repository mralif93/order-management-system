@extends('layouts.seller')

@section('title', 'Seller Dashboard | OMS')

@section('content')
    <div class="max-w-[1600px] mx-auto space-y-8 pb-12 transition-colors duration-300">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="animate__animated animate__fadeInLeft">
                <h1 class="text-3xl font-extrabold text-secondary-900 dark:text-white tracking-tight">Seller Dashboard</h1>
                <p class="text-secondary-500 dark:text-slate-400 mt-2 font-medium">
                    Welcome back, <span
                        class="text-primary-600 dark:text-primary-400 font-bold">{{ Auth::guard('seller')->user()->name }}</span>.
                    Here's your store at a glance.
                </p>
            </div>
            <div class="flex items-center gap-3 animate__animated animate__fadeInRight">
                <a href="{{ route('seller.products.create') }}"
                    class="px-4 py-2.5 bg-primary-600 text-white rounded-xl font-bold hover:bg-primary-700 hover:shadow-lg transition shadow-md flex items-center gap-2 text-sm">
                    <i class="hgi-stroke hgi-plus text-lg"></i> Add Product
                </a>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Products -->
            <div
                class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 hover:shadow-xl hover:-translate-y-1 transition duration-300 group overflow-hidden relative animate__animated animate__fadeInUp">
                <div
                    class="absolute -right-4 -top-4 w-24 h-24 bg-primary-50 dark:bg-primary-900/10 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500">
                </div>
                <div class="flex flex-col gap-4 relative z-10">
                    <div
                        class="w-12 h-12 rounded-xl bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 flex items-center justify-center text-2xl">
                        <i class="hgi-stroke hgi-package"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-secondary-400 dark:text-slate-500 uppercase tracking-wider">Total
                            Products</p>
                        <div class="flex items-end gap-2 mt-1">
                            <h3 class="text-3xl font-black text-secondary-900 dark:text-white">
                                {{ $stats['total_products'] ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Products -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 hover:shadow-xl hover:-translate-y-1 transition duration-300 group overflow-hidden relative animate__animated animate__fadeInUp"
                style="animation-delay:100ms">
                <div
                    class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-50 dark:bg-emerald-900/10 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500">
                </div>
                <div class="flex flex-col gap-4 relative z-10">
                    <div
                        class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-2xl">
                        <i class="hgi-stroke hgi-checkmark-circle-01"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-secondary-400 dark:text-slate-500 uppercase tracking-wider">Active
                            Products</p>
                        <div class="flex items-end gap-2 mt-1">
                            <h3 class="text-3xl font-black text-secondary-900 dark:text-white">
                                {{ $stats['active_products'] ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 hover:shadow-xl hover:-translate-y-1 transition duration-300 group overflow-hidden relative animate__animated animate__fadeInUp"
                style="animation-delay:200ms">
                <div
                    class="absolute -right-4 -top-4 w-24 h-24 bg-blue-50 dark:bg-blue-900/10 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500">
                </div>
                <div class="flex flex-col gap-4 relative z-10">
                    <div
                        class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center text-2xl">
                        <i class="hgi-stroke hgi-shopping-cart-01"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-secondary-400 dark:text-slate-500 uppercase tracking-wider">Total
                            Orders</p>
                        <div class="flex items-end gap-2 mt-1">
                            <h3 class="text-3xl font-black text-secondary-900 dark:text-white">
                                {{ $stats['total_orders'] ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Orders -->
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 hover:shadow-xl hover:-translate-y-1 transition duration-300 group overflow-hidden relative animate__animated animate__fadeInUp"
                style="animation-delay:300ms">
                <div
                    class="absolute -right-4 -top-4 w-24 h-24 bg-amber-50 dark:bg-amber-900/10 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500">
                </div>
                <div class="flex flex-col gap-4 relative z-10">
                    <div
                        class="w-12 h-12 rounded-xl bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 flex items-center justify-center text-2xl">
                        <i class="hgi-stroke hgi-time-02"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-secondary-400 dark:text-slate-500 uppercase tracking-wider">Pending
                            Orders</p>
                        <div class="flex items-end gap-2 mt-1">
                            <h3 class="text-3xl font-black text-secondary-900 dark:text-white">
                                {{ $stats['pending_orders'] ?? 0 }}</h3>
                            <span class="text-xs font-bold text-amber-600 mb-1">Action Needed</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Grid: Recent Orders + Quick Links -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Recent Orders Table -->
            <div
                class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden flex flex-col animate__animated animate__fadeInLeft">
                <div class="p-6 border-b border-gray-50 dark:border-slate-800 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-black text-secondary-900 dark:text-white">Recent Orders</h2>
                        <p class="text-xs text-secondary-400 dark:text-slate-500 font-bold mt-1 uppercase tracking-tight">
                            Latest Transactions</p>
                    </div>
                    <a href="{{ route('seller.orders.index') }}"
                        class="px-3 py-1.5 bg-gray-50 dark:bg-slate-800 text-secondary-600 dark:text-slate-400 rounded-lg text-xs font-bold hover:bg-gray-100 dark:hover:bg-slate-700 transition">View
                        All</a>
                </div>
                <div class="flex-1 overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="bg-gray-50/50 dark:bg-slate-800/50 text-secondary-400 dark:text-slate-500 text-[11px] uppercase font-black tracking-widest">
                                <th class="py-4 px-6">Order #</th>
                                <th class="py-4 px-6">Customer</th>
                                <th class="py-4 px-6">Status</th>
                                <th class="py-4 px-6 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody
                            class="divide-y divide-gray-50 dark:divide-slate-800 text-sm text-secondary-700 dark:text-slate-300 font-medium">
                            @forelse($recentOrders ?? [] as $order)
                                <tr class="hover:bg-primary-50/30 dark:hover:bg-primary-900/10 transition-colors">
                                    <td class="py-4 px-6 font-bold text-secondary-900 dark:text-white">
                                        {{ $order->order_number }}</td>
                                    <td class="py-4 px-6">
                                        @php $dName = $order->customer?->name ?? $order->guest_name ?? 'Guest'; @endphp
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 rounded-full bg-gray-100 dark:bg-slate-800 flex items-center justify-center text-[10px] font-bold dark:text-slate-400">
                                                {{ strtoupper(substr($dName, 0, 2)) }}
                                            </div>
                                            <span>{{ $dName }}</span>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        @php
                                            $statusColors = ['pending' => 'amber', 'processing' => 'blue', 'completed' => 'emerald', 'cancelled' => 'red'];
                                            $color = $statusColors[$order->order_status] ?? 'gray';
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider bg-{{ $color }}-100 dark:bg-{{ $color }}-900/20 text-{{ $color }}-700 dark:text-{{ $color }}-400">
                                            <span
                                                class="w-1.5 h-1.5 rounded-full mr-1.5 bg-{{ $color }}-500 {{ $order->order_status === 'pending' ? 'animate-pulse' : '' }}"></span>
                                            {{ ucfirst($order->order_status) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-right">
                                        <a href="{{ route('seller.orders.show', $order) }}"
                                            class="w-8 h-8 rounded-lg bg-white dark:bg-slate-800 border border-gray-100 dark:border-slate-700 text-gray-400 dark:text-slate-500 inline-flex items-center justify-center hover:bg-primary-600 hover:text-white hover:border-primary-600 transition shadow-sm">
                                            <i class="hgi-stroke hgi-eye text-lg"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-16 text-center">
                                        <div class="flex flex-col items-center gap-3">
                                            <i
                                                class="hgi-stroke hgi-shopping-cart-01 text-5xl text-gray-200 dark:text-slate-800"></i>
                                            <p
                                                class="text-secondary-400 dark:text-slate-600 font-bold text-sm uppercase tracking-widest">
                                                No orders yet</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Quick Links + Store Info -->
            <div class="space-y-6 animate__animated animate__fadeInRight">
                <!-- Store Info Card -->
                <div
                    class="bg-secondary-900 dark:bg-slate-900/50 rounded-3xl p-6 text-white overflow-hidden relative group shadow-xl border dark:border-slate-800">
                    <div
                        class="absolute -right-8 -bottom-8 w-40 h-40 bg-primary-600 rounded-full opacity-20 group-hover:scale-125 transition-transform duration-700">
                    </div>
                    <div class="relative z-10">
                        <div
                            class="w-14 h-14 rounded-2xl bg-primary-600 flex items-center justify-center text-2xl mb-4 shadow-lg">
                            <i class="hgi-stroke hgi-store-01"></i>
                        </div>
                        <h3 class="text-lg font-bold mb-1">{{ Auth::guard('seller')->user()->name }}</h3>
                        <p class="text-secondary-400 text-sm font-medium mb-4">{{ Auth::guard('seller')->user()->email }}
                        </p>
                        <a href="{{ route('seller.profile') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 hover:bg-white/20 rounded-xl font-bold text-sm transition">
                            <i class="hgi-stroke hgi-edit-01"></i> Edit Profile
                        </a>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div
                    class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-gray-100 dark:border-slate-800">
                    <h3 class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter mb-5">Quick
                        Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('seller.products.create') }}"
                            class="flex items-center gap-3 p-3 rounded-xl hover:bg-primary-50 dark:hover:bg-primary-900/10 group transition">
                            <div
                                class="w-9 h-9 rounded-lg bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 flex items-center justify-center group-hover:bg-primary-600 group-hover:text-white transition">
                                <i class="hgi-stroke hgi-plus-sign"></i>
                            </div>
                            <span class="text-sm font-bold text-secondary-700 dark:text-slate-300">Add New Product</span>
                            <i
                                class="hgi-stroke hgi-arrow-right-01 ml-auto text-gray-400 text-sm group-hover:text-primary-600 transition"></i>
                        </a>
                        <a href="{{ route('seller.orders.index') }}"
                            class="flex items-center gap-3 p-3 rounded-xl hover:bg-blue-50 dark:hover:bg-blue-900/10 group transition">
                            <div
                                class="w-9 h-9 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition">
                                <i class="hgi-stroke hgi-shopping-cart-01"></i>
                            </div>
                            <span class="text-sm font-bold text-secondary-700 dark:text-slate-300">Manage Orders</span>
                            <i
                                class="hgi-stroke hgi-arrow-right-01 ml-auto text-gray-400 text-sm group-hover:text-blue-600 transition"></i>
                        </a>
                        <a href="{{ route('seller.products.index') }}"
                            class="flex items-center gap-3 p-3 rounded-xl hover:bg-emerald-50 dark:hover:bg-emerald-900/10 group transition">
                            <div
                                class="w-9 h-9 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition">
                                <i class="hgi-stroke hgi-package"></i>
                            </div>
                            <span class="text-sm font-bold text-secondary-700 dark:text-slate-300">View All Products</span>
                            <i
                                class="hgi-stroke hgi-arrow-right-01 ml-auto text-gray-400 text-sm group-hover:text-emerald-600 transition"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection