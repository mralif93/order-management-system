@extends('layouts.customer')

@section('title', 'My Orders | OMS Portal')

@section('content')
    <div class="max-w-[1600px] mx-auto space-y-8 pb-12 transition-colors duration-300">

        <!-- Page Header -->
        <div
            class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate__animated animate__fadeInDown">
            <div>
                <h1 class="text-3xl font-black text-secondary-900 dark:text-white tracking-tight leading-none uppercase">My
                    Orders</h1>
                <p class="text-secondary-500 dark:text-slate-400 mt-2 font-medium">Track your purchases and view detailed
                    receipts.</p>
            </div>
            <a href="{{ route('customer.catalog.index') }}"
                class="inline-flex items-center gap-2 px-5 py-3 bg-primary-600 text-white rounded-2xl font-black text-sm hover:bg-primary-700 transition shadow-lg shadow-primary-600/20">
                <i class="hgi-stroke hgi-store-01 text-lg"></i> Browse Store
            </a>
        </div>

        <!-- Orders Table Card -->
        <div
            class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden animate__animated animate__fadeInUp">

            <!-- Table Header -->
            <div
                class="p-6 border-b border-gray-50 dark:border-slate-800 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <h2 class="text-lg font-black text-secondary-900 dark:text-white tracking-tighter uppercase">Order History
                </h2>
                <div class="flex items-center bg-gray-100 dark:bg-slate-800 rounded-lg px-3 py-1.5 w-full sm:w-64">
                    <i class="hgi-stroke hgi-search-01 text-gray-400 dark:text-slate-500 mr-2 text-sm"></i>
                    <input type="text" placeholder="Search orders..."
                        class="bg-transparent border-none focus:ring-0 text-sm w-full outline-none dark:text-slate-200">
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr
                            class="bg-gray-50/50 dark:bg-slate-800/50 text-secondary-400 dark:text-slate-500 text-[10px] uppercase font-black tracking-widest">
                            <th class="py-4 px-6">Order Reference</th>
                            <th class="py-4 px-6">Date Placed</th>
                            <th class="py-4 px-6">Status</th>
                            <th class="py-4 px-6 text-right">Total Amount</th>
                            <th class="py-4 px-6 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody
                        class="divide-y divide-gray-50 dark:divide-slate-800 text-sm text-secondary-700 dark:text-slate-300">
                        @forelse($orders as $order)
                            @php
                                $sc = ['pending' => 'bg-amber-100 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400', 'processing' => 'bg-blue-100 dark:bg-blue-900/20 text-blue-700 dark:text-blue-400', 'shipped' => 'bg-indigo-100 dark:bg-indigo-900/20 text-indigo-700 dark:text-indigo-400', 'delivered' => 'bg-emerald-100 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400', 'cancelled' => 'bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-400'];
                                $cls = $sc[strtolower($order->order_status)] ?? 'bg-gray-100 text-gray-700';
                            @endphp
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-slate-800/50 transition duration-200">
                                <td class="py-5 px-6 font-black text-secondary-900 dark:text-white">#{{ $order->order_number }}
                                </td>
                                <td class="py-5 px-6 text-secondary-500 dark:text-slate-400">
                                    {{ $order->created_at->format('M d, Y') }}
                                </td>
                                <td class="py-5 px-6">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider {{ $cls }}">
                                        <span class="w-1.5 h-1.5 rounded-full bg-current mr-2 opacity-50"></span>
                                        {{ $order->order_status }}
                                    </span>
                                </td>
                                <td class="py-5 px-6 text-right font-black text-secondary-900 dark:text-white">
                                    {{ $order->currency }} {{ number_format($order->total_amount, 2) }}
                                </td>
                                <td class="py-5 px-6 text-right">
                                    <a href="{{ route('customer.orders.show', $order) }}"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-secondary-900 dark:bg-slate-800 text-white dark:text-slate-300 rounded-xl text-xs font-black hover:bg-primary-600 dark:hover:bg-primary-600 transition shadow-sm group">
                                        Details <i
                                            class="hgi-stroke hgi-arrow-right-01 group-hover:translate-x-1 transition-transform text-xs"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-20 text-center">
                                    <div class="flex flex-col items-center gap-4">
                                        <div
                                            class="w-20 h-20 rounded-full bg-gray-50 dark:bg-slate-800 flex items-center justify-center">
                                            <i
                                                class="hgi-stroke hgi-shopping-bag-01 text-4xl text-gray-200 dark:text-slate-700"></i>
                                        </div>
                                        <div>
                                            <h3
                                                class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter">
                                                No orders found</h3>
                                            <p class="text-secondary-400 dark:text-slate-500 font-medium text-sm mt-1">Start
                                                your shopping journey today!</p>
                                        </div>
                                        <a href="{{ route('customer.catalog.index') }}"
                                            class="mt-2 px-8 py-3 bg-primary-600 text-white rounded-2xl font-black hover:bg-primary-700 transition shadow-lg shadow-primary-600/20 inline-flex items-center gap-2">
                                            <i class="hgi-stroke hgi-store-01"></i> Browse Catalog
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($orders->hasPages())
                <div class="p-6 border-t border-gray-100 dark:border-slate-800">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection