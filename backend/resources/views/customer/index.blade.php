@extends('layouts.customer')

@section('title', 'My Dashboard | OMS Portal')

@section('content')
    @php $customer = Auth::guard('customer')->user(); @endphp
    <div class="max-w-[1600px] mx-auto space-y-8 pb-12 transition-colors duration-300">

        <!-- Welcome Hero -->
        <div
            class="relative bg-primary-600 dark:bg-primary-900/40 rounded-3xl p-8 overflow-hidden shadow-2xl animate__animated animate__fadeIn border dark:border-primary-800/50">
            <div class="absolute right-0 top-0 w-64 h-64 bg-white/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
            <div class="absolute left-0 bottom-0 w-40 h-40 bg-black/10 rounded-full -ml-10 -mb-10 blur-2xl"></div>
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="text-white">
                    <h1 class="text-3xl font-black tracking-tight">Welcome back,
                        {{ explode(' ', $customer->name ?? 'Customer')[0] }}!</h1>
                    <p class="text-primary-100 dark:text-primary-300 mt-2 font-medium">You have <span
                            class="font-bold underline">{{ $activeOrders }} active
                            {{ Str::plural('order', $activeOrders) }}</span> being processed right now.</p>
                </div>
                <div>
                    <a href="{{ route('customer.catalog.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-white dark:bg-slate-900 text-primary-600 dark:text-primary-400 rounded-2xl font-black hover:bg-primary-50 dark:hover:bg-slate-800 transition shadow-lg">
                        <i class="hgi-stroke hgi-store-01 text-xl"></i> Browse Store
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Row -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 animate__animated animate__fadeInUp">
            <!-- Active Orders -->
            <div
                class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex items-center gap-5 group hover:shadow-md transition">
                <div
                    class="w-14 h-14 rounded-2xl bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 flex items-center justify-center text-3xl shadow-inner group-hover:scale-110 transition duration-300">
                    <i class="hgi-stroke hgi-delivery-truck-02"></i>
                </div>
                <div>
                    <p class="text-xs font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">Active
                        Orders</p>
                    <h3 class="text-2xl font-black text-secondary-900 dark:text-white mt-1">{{ $activeOrders }}</h3>
                </div>
            </div>

            <!-- Total Spent -->
            <div
                class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex items-center gap-5 group hover:shadow-md transition">
                <div
                    class="w-14 h-14 rounded-2xl bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-3xl shadow-inner group-hover:scale-110 transition duration-300">
                    <i class="hgi-stroke hgi-money-send-01"></i>
                </div>
                <div>
                    <p class="text-xs font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">Total
                        Spent</p>
                    <h3 class="text-2xl font-black text-secondary-900 dark:text-white mt-1">
                        ${{ number_format($totalSpent, 2) }}</h3>
                </div>
            </div>

            <!-- Total Orders -->
            <div
                class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex items-center gap-5 group hover:shadow-md transition">
                <div
                    class="w-14 h-14 rounded-2xl bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center text-3xl shadow-inner group-hover:scale-110 transition duration-300">
                    <i class="hgi-stroke hgi-shopping-bag-01"></i>
                </div>
                <div>
                    <p class="text-xs font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">All
                        Orders</p>
                    <h3 class="text-2xl font-black text-secondary-900 dark:text-white mt-1">{{ $totalOrders }}</h3>
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Recent Orders Table -->
            <div
                class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden animate__animated animate__fadeInLeft">
                <div class="p-6 border-b border-gray-50 dark:border-slate-800 flex items-center justify-between">
                    <h2 class="text-lg font-black text-secondary-900 dark:text-white tracking-tighter uppercase">Recent
                        Orders</h2>
                    <a href="{{ route('customer.orders.index') }}"
                        class="text-sm font-bold text-primary-600 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 flex items-center gap-1">
                        View All <i class="hgi-stroke hgi-arrow-right-01 text-sm"></i>
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr
                                class="bg-gray-50/50 dark:bg-slate-800/50 text-secondary-400 dark:text-slate-500 text-[10px] uppercase font-black tracking-widest">
                                <th class="py-4 px-6">Order</th>
                                <th class="py-4 px-6">Date</th>
                                <th class="py-4 px-6">Status</th>
                                <th class="py-4 px-6 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody
                            class="divide-y divide-gray-50 dark:divide-slate-800 text-sm text-secondary-700 dark:text-slate-300 font-medium">
                            @forelse($recentOrders as $order)
                                @php
                                    $sc = ['pending' => 'bg-amber-100 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400', 'processing' => 'bg-blue-100 dark:bg-blue-900/20 text-blue-700 dark:text-blue-400', 'shipped' => 'bg-indigo-100 dark:bg-indigo-900/20 text-indigo-700 dark:text-indigo-400', 'delivered' => 'bg-emerald-100 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400', 'cancelled' => 'bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-400'];
                                    $cls = $sc[strtolower($order->order_status)] ?? 'bg-gray-100 text-gray-700';
                                @endphp
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-slate-800/50 transition duration-200">
                                    <td class="py-4 px-6">
                                        <a href="{{ route('customer.orders.show', $order) }}"
                                            class="font-bold text-secondary-900 dark:text-white hover:text-primary-600 dark:hover:text-primary-400">#{{ $order->order_number }}</a>
                                    </td>
                                    <td class="py-4 px-6 text-secondary-500 dark:text-slate-400">
                                        {{ $order->created_at->format('M d, Y') }}</td>
                                    <td class="py-4 px-6">
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider {{ $cls }}">
                                            <span class="w-1.5 h-1.5 rounded-full bg-current mr-1.5 opacity-60"></span>
                                            {{ $order->order_status }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-right font-black text-secondary-900 dark:text-white">
                                        {{ $order->currency }} {{ number_format($order->total_amount, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-12 text-center text-secondary-400 dark:text-slate-500 font-bold">
                                        No orders yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Profile Sidebar -->
            <div class="space-y-6 animate__animated animate__fadeInRight">
                <!-- Profile Card -->
                <div
                    class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-gray-100 dark:border-slate-800">
                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="w-14 h-14 rounded-full bg-primary-600 text-white flex items-center justify-center font-black text-2xl shadow-lg">
                            {{ substr($customer->name ?? 'C', 0, 1) }}
                        </div>
                        <div>
                            <h4 class="text-sm font-black text-secondary-900 dark:text-white">{{ $customer->name }}</h4>
                            <p
                                class="text-[10px] text-primary-600 dark:text-primary-400 font-bold uppercase tracking-widest">
                                Customer Account</p>
                        </div>
                    </div>
                    <div class="space-y-3 text-sm">
                        <div class="flex items-center gap-3 text-secondary-600 dark:text-slate-400 font-medium">
                            <i class="hgi-stroke hgi-mail-01 text-secondary-400 dark:text-slate-500 text-base"></i>
                            <span class="truncate">{{ $customer->email }}</span>
                        </div>
                        @if($customer->phone)
                            <div class="flex items-center gap-3 text-secondary-600 dark:text-slate-400 font-medium">
                                <i class="hgi-stroke hgi-call text-secondary-400 dark:text-slate-500 text-base"></i>
                                {{ $customer->phone }}
                            </div>
                        @endif
                        @if($customer->city)
                            <div class="flex items-center gap-3 text-secondary-600 dark:text-slate-400 font-medium">
                                <i class="hgi-stroke hgi-location-01 text-secondary-400 dark:text-slate-500 text-base"></i>
                                {{ $customer->city }}@if($customer->state), {{ $customer->state }}@endif
                            </div>
                        @endif
                    </div>
                    <a href="{{ route('customer.profile') }}"
                        class="mt-6 w-full py-3 bg-secondary-900 dark:bg-slate-800 text-white dark:text-slate-300 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-primary-600 dark:hover:bg-primary-600 transition duration-300 flex items-center justify-center gap-2">
                        <i class="hgi-stroke hgi-settings-01"></i> Account Settings
                    </a>
                </div>

                <!-- Quick Links -->
                <div
                    class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-gray-100 dark:border-slate-800">
                    <h3 class="text-xs font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest mb-4">
                        Quick Actions</h3>
                    <div class="space-y-2">
                        <a href="{{ route('customer.orders.index') }}"
                            class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-slate-800 transition group">
                            <div
                                class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center group-hover:scale-110 transition">
                                <i class="hgi-stroke hgi-shopping-bag-01 text-sm"></i>
                            </div>
                            <span class="text-sm font-bold text-secondary-700 dark:text-slate-300">All My Orders</span>
                            <i
                                class="hgi-stroke hgi-arrow-right-01 text-secondary-300 dark:text-slate-600 ml-auto text-xs"></i>
                        </a>
                        <a href="{{ route('customer.catalog.index') }}"
                            class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-slate-800 transition group">
                            <div
                                class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center group-hover:scale-110 transition">
                                <i class="hgi-stroke hgi-store-01 text-sm"></i>
                            </div>
                            <span class="text-sm font-bold text-secondary-700 dark:text-slate-300">Browse Products</span>
                            <i
                                class="hgi-stroke hgi-arrow-right-01 text-secondary-300 dark:text-slate-600 ml-auto text-xs"></i>
                        </a>
                        <a href="{{ route('customer.profile') }}"
                            class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-slate-800 transition group">
                            <div
                                class="w-8 h-8 rounded-lg bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 flex items-center justify-center group-hover:scale-110 transition">
                                <i class="hgi-stroke hgi-user-circle text-sm"></i>
                            </div>
                            <span class="text-sm font-bold text-secondary-700 dark:text-slate-300">Edit Profile</span>
                            <i
                                class="hgi-stroke hgi-arrow-right-01 text-secondary-300 dark:text-slate-600 ml-auto text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection