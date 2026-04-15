@extends('layouts.customer')

@section('title', 'My Order History | OMS Portal')

@section('content')
<div class="max-w-6xl mx-auto space-y-8 pb-12 transition-colors duration-300">
    <!-- Header -->
    <div class="animate__animated animate__fadeInLeft">
        <h1 class="text-3xl font-black text-secondary-900 dark:text-white tracking-tight leading-none uppercase">Order History</h1>
        <p class="text-secondary-500 dark:text-slate-400 mt-2 font-medium">Track your previous purchases and view detailed receipts.</p>
    </div>

    <!-- Orders Filter/List Card -->
    <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden flex flex-col pt-4">
        
        <!-- List Header (Desktop Only) -->
        <div class="hidden md:grid grid-cols-5 px-8 py-4 bg-gray-50/50 dark:bg-slate-800/30 text-secondary-400 dark:text-slate-500 text-[10px] uppercase font-black tracking-widest border-b dark:border-slate-800">
            <span>Order Reference</span>
            <span>Date Placed</span>
            <span>Status</span>
            <span>Total Amount</span>
            <span class="text-right">Action</span>
        </div>

        <!-- Orders List -->
        <div class="divide-y divide-gray-50 dark:divide-slate-800">
            @forelse($orders as $order)
            <div class="group px-8 py-6 hover:bg-primary-50/20 dark:hover:bg-primary-900/5 transition-colors">
                <div class="grid grid-cols-1 md:grid-cols-5 items-center gap-4">
                    <!-- Order ID -->
                    <div class="flex flex-col">
                        <span class="text-xs font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest mb-1">Receipt #</span>
                        <span class="text-base font-black text-secondary-900 dark:text-white uppercase tracking-tight">ORD-{{ $order->order_number }}</span>
                    </div>

                    <!-- Date -->
                    <div class="flex flex-col">
                        <span class="text-xs font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest mb-1 hidden md:block">Date</span>
                        <span class="text-sm font-bold text-secondary-700 dark:text-slate-300">{{ $order->created_at->format('M d, Y') }}</span>
                    </div>

                    <!-- Status -->
                    <div>
                        <span class="text-xs font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest mb-1 md:hidden">Status</span>
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
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider {{ $colorClass }}">
                            <span class="w-1.5 h-1.5 rounded-full bg-current mr-2 opacity-50"></span>
                            {{ $order->order_status }}
                        </span>
                    </div>

                    <!-- Total -->
                    <div class="flex flex-col">
                        <span class="text-xs font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest mb-1 md:hidden">Total</span>
                        <span class="text-lg font-black text-secondary-900 dark:text-white">{{ $order->currency }} {{ number_format($order->total_amount, 2) }}</span>
                    </div>

                    <!-- Action -->
                    <div class="md:text-right">
                        <a href="{{ route('customer.orders.show', $order) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-secondary-900 dark:bg-slate-800 text-white dark:text-slate-300 rounded-xl text-xs font-black hover:bg-primary-600 transition shadow-sm group">
                            Details <i class="hgi-stroke hgi-arrow-right-01 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="py-20 text-center">
                <div class="flex flex-col items-center gap-4">
                    <div class="w-20 h-20 rounded-full bg-gray-50 dark:bg-slate-800 flex items-center justify-center text-gray-200 dark:text-slate-700">
                        <i class="hgi-stroke hgi-shopping-bag-02 text-4xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter">No orders found</h3>
                        <p class="text-secondary-400 dark:text-slate-500 font-medium text-sm mt-1">Start your shopping journey today!</p>
                    </div>
                    <a href="{{ route('customer.products.index') }}" class="mt-4 px-8 py-3 bg-primary-600 text-white rounded-2xl font-black hover:bg-primary-700 transition shadow-lg shadow-primary-600/20">
                        Browse Catalog
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($orders->count() > 0 && $orders->hasPages())
        <div class="p-8 bg-gray-50/50 dark:bg-slate-800/20 border-t border-gray-100 dark:border-slate-800">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
