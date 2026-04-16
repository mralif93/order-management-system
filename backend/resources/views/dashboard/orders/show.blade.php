@extends('layouts.dashboard')

@section('title', 'Order Details | #' . $order->order_number . ' | OMS Admin')

@section('content')
<div class="max-w-[1600px] mx-auto space-y-8 pb-12 transition-colors duration-300">
    <!-- Breadcrumbs/Back -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-secondary-500 dark:text-slate-400 hover:text-primary-600 transition group">
            <i class="hgi-stroke hgi-arrow-left-01 group-hover:-translate-x-1 transition-transform"></i>
            <span>Back to Orders</span>
        </a>
        <div class="flex items-center gap-3">
            <button class="px-4 py-2 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 text-secondary-700 dark:text-slate-300 rounded-xl text-xs font-bold hover:bg-gray-50 transition shadow-sm flex items-center gap-2">
                <i class="hgi-stroke hgi-printer-01 text-lg"></i> Print Invoice
            </button>
        </div>
    </div>

    <!-- Header & Status -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 animate__animated animate__fadeInDown">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <span class="px-3 py-1 bg-primary-600 text-white rounded-lg text-[10px] font-black uppercase tracking-widest">Order Receipt</span>
                <span class="text-secondary-400 dark:text-slate-500 font-bold text-sm tracking-tight">{{ $order->created_at->format('M d, Y • h:i A') }}</span>
            </div>
            <h1 class="text-4xl font-black text-secondary-900 dark:text-white tracking-tight leading-none uppercase">Order #{{ $order->order_number }}</h1>
        </div>
        
        <!-- Status Update Block -->
        <div class="bg-white dark:bg-slate-900 p-4 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 flex items-center gap-4">
            <div>
                <p class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest mb-1">Current Status</p>
                @php
                    $statusColors = [
                        'pending' => 'text-amber-600 dark:text-amber-400',
                        'processing' => 'text-blue-600 dark:text-blue-400',
                        'shipped' => 'text-indigo-600 dark:text-indigo-400',
                        'delivered' => 'text-emerald-600 dark:text-emerald-400',
                        'cancelled' => 'text-red-600 dark:text-red-400',
                    ];
                    $statusColor = $statusColors[strtolower($order->order_status)] ?? 'text-gray-600';
                @endphp
                <p class="text-lg font-black {{ $statusColor }} uppercase tracking-tighter">{{ $order->order_status }}</p>
            </div>
            <div class="w-px h-10 bg-gray-100 dark:bg-slate-800"></div>
            <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="flex items-center gap-2">
                @csrf @method('PUT')
                <select name="order_status" class="bg-gray-50 dark:bg-slate-800 text-xs font-bold border-none rounded-xl focus:ring-2 focus:ring-primary-600/50 outline-none pr-8 py-2.5 dark:text-slate-200">
                    <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="p-2.5 bg-secondary-900 dark:bg-primary-600 text-white rounded-xl hover:shadow-lg transition active:scale-95">
                    <i class="hgi-stroke hgi-tick-01 text-xl"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate__animated animate__fadeInUp">
        <!-- Order Items -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden">
                <div class="p-6 border-b border-gray-50 dark:border-slate-800">
                    <h2 class="text-xl font-black text-secondary-900 dark:text-white uppercase tracking-tighter">Ordered Items</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50/50 dark:bg-slate-800/30 text-secondary-400 dark:text-slate-500 text-[10px] uppercase font-black tracking-widest">
                                <th class="py-4 px-6">Product</th>
                                <th class="py-4 px-6 text-center">Qty</th>
                                <th class="py-4 px-6 text-right">Price</th>
                                <th class="py-4 px-6 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-slate-800 text-sm">
                            @foreach($order->items as $item)
                            <tr class="group">
                                <td class="py-5 px-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-gray-100 dark:bg-slate-800 flex items-center justify-center text-primary-600">
                                            <i class="hgi-stroke hgi-package text-2xl"></i>
                                        </div>
                                        <div>
                                            <p class="font-bold text-secondary-900 dark:text-white">{{ $item->product->name ?? 'Product Unavailable' }}</p>
                                            <p class="text-xs text-secondary-400 dark:text-slate-500 mt-1 uppercase tracking-wider font-bold">{{ $item->product->sku ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-5 px-6 text-center font-bold text-secondary-700 dark:text-slate-300">
                                    {{ $item->quantity }}
                                </td>
                                <td class="py-5 px-6 text-right font-medium text-secondary-500 dark:text-slate-400">
                                    {{ $order->currency }} {{ number_format($item->unit_price, 2) }}
                                </td>
                                <td class="py-5 px-6 text-right font-black text-secondary-900 dark:text-white">
                                    {{ $order->currency }} {{ number_format($item->total_price, 2) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Notes Section -->
            @if($order->notes)
            <div class="bg-amber-50 dark:bg-amber-900/10 rounded-3xl p-6 border border-amber-100 dark:border-amber-800">
                <div class="flex items-center gap-3 mb-4 text-amber-700 dark:text-amber-400">
                    <i class="hgi-stroke hgi-note text-2xl font-black"></i>
                    <h3 class="text-sm font-black uppercase tracking-widest">Admin/Customer Notes</h3>
                </div>
                <p class="text-sm text-amber-800 dark:text-amber-300/80 font-medium leading-relaxed">{{ $order->notes }}</p>
            </div>
            @endif
        </div>

        <!-- Sidebar Summary -->
        <div class="space-y-8">
            <!-- Price Breakdown -->
            <div class="bg-secondary-900 dark:bg-slate-900 rounded-3xl p-8 text-white shadow-xl border dark:border-slate-800">
                <h3 class="text-lg font-black uppercase tracking-tighter mb-6 border-b border-white/10 pb-4">Payment Summary</h3>
                <div class="space-y-4">
                    <div class="flex justify-between text-secondary-400 font-bold text-xs uppercase tracking-widest">
                        <span>Subtotal</span>
                        <span class="text-white">{{ $order->currency }} {{ number_format($order->subtotal_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-secondary-400 font-bold text-xs uppercase tracking-widest">
                        <span>Tax</span>
                        <span class="text-white">{{ $order->currency }} {{ number_format($order->tax_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-secondary-400 font-bold text-xs uppercase tracking-widest">
                        <span>Shipping</span>
                        <span class="text-white">{{ $order->currency }} {{ number_format($order->shipping_amount, 2) }}</span>
                    </div>
                    @if($order->discount_amount > 0)
                    <div class="flex justify-between text-emerald-400 font-bold text-xs uppercase tracking-widest">
                        <span>Discount</span>
                        <span>- {{ $order->currency }} {{ number_format($order->discount_amount, 2) }}</span>
                    </div>
                    @endif
                    <div class="pt-4 border-t border-white/10 flex justify-between items-end">
                        <span class="text-xs font-black uppercase tracking-[0.2em]">Total Amount</span>
                        <span class="text-3xl font-black text-primary-500">{{ $order->currency }} {{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Customer Profile -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-gray-100 dark:border-slate-800">
                <h3 class="text-xs font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest mb-6">Customer Profile</h3>
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-primary-100 dark:bg-primary-900/30 text-primary-600 flex items-center justify-center font-black text-2xl shadow-inner uppercase">
                        {{ substr($order->customer->name, 0, 1) }}
                    </div>
                    <div>
                        <h4 class="text-lg font-black text-secondary-900 dark:text-white leading-none mb-1">{{ $order->customer->name }}</h4>
                        <p class="text-[10px] text-primary-600 dark:text-primary-400 font-black uppercase tracking-widest">Verified Customer</p>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center gap-3 text-sm text-secondary-600 dark:text-slate-400 font-medium">
                        <i class="hgi-stroke hgi-mail-01 text-secondary-400 dark:text-slate-500 text-lg"></i>
                        <span class="truncate">{{ $order->customer->email }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-secondary-600 dark:text-slate-400 font-medium">
                        <i class="hgi-stroke hgi-call text-secondary-400 dark:text-slate-500 text-lg"></i>
                        <span>{{ $order->customer->phone ?? '+60 12-XXXXXXX' }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-secondary-600 dark:text-slate-400 font-medium pb-2 border-b dark:border-slate-800">
                        <i class="hgi-stroke hgi-location-01 text-secondary-400 dark:text-slate-500 text-lg"></i>
                        <span>{{ $order->customer->city }}, {{ $order->customer->state }}</span>
                    </div>
                    <a href="#" class="w-full inline-flex items-center justify-center py-3 bg-gray-50 dark:bg-slate-800 text-secondary-700 dark:text-slate-300 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-secondary-900 hover:text-white transition group">
                        View Full History <i class="hgi-stroke hgi-arrow-right-01 ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
