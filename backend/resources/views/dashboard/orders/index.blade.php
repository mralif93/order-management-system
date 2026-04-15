@extends('layouts.dashboard')

@section('title', 'Orders Management | OMS Admin')

@section('content')
<div class="max-w-[1600px] mx-auto space-y-8 pb-12 transition-colors duration-300">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="animate__animated animate__fadeInLeft">
            <h1 class="text-3xl font-extrabold text-secondary-900 dark:text-white tracking-tight leading-none">Orders</h1>
            <p class="text-secondary-500 dark:text-slate-400 mt-2 font-medium">Track and fulfillment customer orders and manage statuses.</p>
        </div>
        <div class="animate__animated animate__fadeInRight">
            <button class="px-6 py-3 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 text-secondary-700 dark:text-slate-300 rounded-2xl font-black hover:bg-gray-50 dark:hover:bg-slate-800 transition flex items-center gap-2 shadow-sm">
                <i class="hgi-stroke hgi-download-04 text-xl"></i> Export Orders
            </button>
        </div>
    </div>

    <!-- Filters & Table Card -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden flex flex-col">
        <!-- Table Search/Filters -->
        <div class="p-6 border-b border-gray-50 dark:border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <form action="{{ route('orders.index') }}" method="GET" class="relative group w-full sm:w-96">
                <i class="hgi-stroke hgi-search-01 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 dark:text-slate-500 group-focus-within:text-primary-600 transition-colors"></i>
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Search by Order # or Customer..." 
                    class="w-full pl-11 pr-4 py-2.5 bg-gray-50 dark:bg-slate-800 border-none rounded-xl text-sm focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200"
                >
            </form>
            <div class="flex items-center gap-3">
                <select name="status" onchange="this.form.submit()" form="search-form"
                    class="px-4 py-2.5 bg-gray-50 dark:bg-slate-800 text-secondary-600 dark:text-slate-400 rounded-xl text-xs font-bold border-none focus:ring-2 focus:ring-primary-600 transition outline-none">
                    <option value="">All Statuses</option>
                    @foreach(['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/50 dark:bg-slate-800/30 text-secondary-400 dark:text-slate-500 text-[10px] uppercase font-black tracking-widest">
                        <th class="py-4 px-6">Order ID</th>
                        <th class="py-4 px-6">Customer</th>
                        <th class="py-4 px-6">Date</th>
                        <th class="py-4 px-6">Total Amount</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-slate-800 text-sm">
                    @forelse($orders as $order)
                    <tr class="hover:bg-primary-50/20 dark:hover:bg-primary-900/5 transition-colors group">
                        <td class="py-5 px-6">
                            <span class="font-black text-secondary-900 dark:text-white uppercase tracking-tight">#{{ $order->order_number }}</span>
                        </td>
                        <td class="py-5 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-primary-100 dark:bg-primary-900/30 text-primary-600 flex items-center justify-center font-bold text-xs">
                                    {{ substr($order->customer->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-secondary-900 dark:text-white leading-none">{{ $order->customer->name }}</p>
                                    <p class="text-[10px] text-secondary-400 dark:text-slate-500 mt-1 uppercase">{{ $order->customer->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-5 px-6">
                            <p class="text-secondary-600 dark:text-slate-400 font-medium">{{ $order->created_at->format('M d, Y') }}</p>
                            <p class="text-[10px] text-secondary-400 dark:text-slate-500 uppercase mt-0.5 tracking-widest">{{ $order->created_at->format('h:i A') }}</p>
                        </td>
                        <td class="py-5 px-6 font-black text-secondary-900 dark:text-white">
                            {{ $order->currency }} {{ number_format($order->total_amount, 2) }}
                        </td>
                        <td class="py-5 px-6">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-amber-100 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400',
                                    'processing' => 'bg-blue-100 dark:bg-blue-900/20 text-blue-700 dark:text-blue-400',
                                    'shipped' => 'bg-indigo-100 dark:bg-indigo-900/20 text-indigo-700 dark:text-indigo-400',
                                    'delivered' => 'bg-emerald-100 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400',
                                    'cancelled' => 'bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-400',
                                ];
                                $colorClass = $statusColors[strtolower($order->order_status)] ?? 'bg-gray-100 text-gray-700';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider {{ $colorClass }}">
                                {{ $order->order_status }}
                            </span>
                        </td>
                        <td class="py-5 px-6 text-right">
                            <a href="{{ route('orders.show', $order) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 dark:bg-slate-800 text-secondary-700 dark:text-slate-300 rounded-xl text-xs font-black hover:bg-primary-600 hover:text-white transition shadow-sm">
                                <i class="hgi-stroke hgi-eye text-lg"></i> Details
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-20 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-16 h-16 rounded-full bg-gray-50 dark:bg-slate-800 flex items-center justify-center text-gray-300 dark:text-slate-600">
                                    <i class="hgi-stroke hgi-shopping-cart-01 text-3xl"></i>
                                </div>
                                <p class="text-secondary-500 dark:text-slate-400 font-bold tracking-tight">No orders listed yet.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($orders->count() > 0 && $orders->hasPages())
        <div class="p-6 bg-gray-50/50 dark:bg-slate-800/20 border-t border-gray-50 dark:border-slate-800">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
