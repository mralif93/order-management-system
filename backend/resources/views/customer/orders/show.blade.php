@extends('layouts.customer')

@section('title', 'Order Details #ORD-' . $order->order_number . ' | OMS Portal')

@section('content')
<div class="max-w-5xl mx-auto space-y-8 pb-12 transition-colors duration-300">
    <!-- Back & Action -->
    <div class="flex items-center justify-between">
        <a href="{{ route('customer.orders.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-secondary-500 dark:text-slate-400 hover:text-primary-600 transition group">
            <i class="hgi-stroke hgi-arrow-left-01 group-hover:-translate-x-1 transition-transform"></i>
            <span>Back to My Orders</span>
        </a>
        <button class="px-5 py-2 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 text-secondary-700 dark:text-slate-300 rounded-xl text-xs font-black hover:bg-gray-50 transition shadow-sm flex items-center gap-2">
            <i class="hgi-stroke hgi-download-04 text-lg"></i> Download Receipt
        </button>
    </div>

    <!-- Main Receipt Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Receipt Content -->
        <div class="lg:col-span-2 space-y-8 animate__animated animate__fadeInUp">
            <!-- Order Status Banner -->
            <div class="bg-primary-600 dark:bg-primary-900/40 rounded-3xl p-8 text-white relative overflow-hidden shadow-xl">
                <div class="absolute right-0 top-0 w-48 h-48 bg-white/10 rounded-full -mr-16 -mt-16 blur-3xl"></div>
                <div class="relative z-10">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] opacity-80 mb-2">Order Tracking Information</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center text-2xl">
                            <i class="hgi-stroke hgi-delivery-truck-02 animate-pulse"></i>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black uppercase tracking-tight">Status: {{ $order->order_status }}</h2>
                            <p class="text-primary-100 dark:text-primary-400 text-sm font-medium">Estimated arrival: Oct 28, 2026</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden">
                <div class="p-6 border-b border-gray-50 dark:border-slate-800">
                    <h3 class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter">Order Summary</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50/50 dark:bg-slate-800/50 text-secondary-400 dark:text-slate-500 text-[10px] uppercase font-black tracking-widest">
                                <th class="py-4 px-6">Product Item</th>
                                <th class="py-4 px-6 text-center">Qty</th>
                                <th class="py-4 px-6 text-right">Unit Price</th>
                                <th class="py-4 px-6 text-right">Amount</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-slate-800 text-sm">
                            @foreach($order->items as $item)
                            <tr>
                                <td class="py-5 px-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-lg bg-gray-50 dark:bg-slate-800 flex items-center justify-center text-primary-600">
                                            <i class="hgi-stroke hgi-package text-xl"></i>
                                        </div>
                                        <div class="font-bold text-secondary-900 dark:text-white">{{ $item->product->name ?? 'Unavailable Product' }}</div>
                                    </div>
                                </td>
                                <td class="py-5 px-6 text-center font-bold text-secondary-600 dark:text-slate-400">× {{ $item->quantity }}</td>
                                <td class="py-5 px-6 text-right text-secondary-500 dark:text-slate-500">{{ $order->currency }} {{ number_format($item->unit_price, 2) }}</td>
                                <td class="py-5 px-6 text-right font-black text-secondary-900 dark:text-white">{{ $order->currency }} {{ number_format($item->total_price, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Billing Sidebar -->
        <div class="space-y-8 animate__animated animate__fadeInRight">
            <!-- Totals -->
            <div class="bg-secondary-900 dark:bg-slate-900 rounded-3xl p-8 text-white shadow-2xl border dark:border-slate-800">
                <div class="flex flex-col gap-6 mb-8">
                    <div class="flex items-center justify-between opacity-60 text-xs font-black uppercase tracking-widest">
                        <span>Items Subtotal</span>
                        <span>{{ $order->currency }} {{ number_format($order->subtotal_amount, 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between opacity-60 text-xs font-black uppercase tracking-widest">
                        <span>Delivery Fee</span>
                        <span>{{ $order->currency }} {{ number_format($order->shipping_amount, 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between text-emerald-400 text-xs font-black uppercase tracking-widest">
                        <span>Member Discount</span>
                        <span>- {{ $order->currency }} {{ number_format($order->discount_amount, 2) }}</span>
                    </div>
                </div>
                <div class="pt-6 border-t border-white/10 flex flex-col gap-2">
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] opacity-40">Total Charged</span>
                    <h3 class="text-4xl font-black text-primary-500 tracking-tighter">{{ $order->currency }} {{ number_format($order->total_amount, 2) }}</h3>
                </div>
            </div>

            <!-- Shipping Details -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-gray-100 dark:border-slate-800">
                <h3 class="text-xs font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest mb-6">Delivery Address</h3>
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-xl bg-gray-50 dark:bg-slate-800 text-primary-600 flex items-center justify-center text-xl shadow-inner">
                        <i class="hgi-stroke hgi-location-01"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-secondary-900 dark:text-white">{{ Auth::guard('customer')->user()->name }}</p>
                        <p class="text-xs text-secondary-500 dark:text-slate-400 mt-1 leading-relaxed">
                            {{ Auth::guard('customer')->user()->address ?? 'No Address Provided' }}<br>
                            {{ Auth::guard('customer')->user()->city }}, {{ Auth::guard('customer')->user()->state }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Need Help -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 text-center">
                <i class="hgi-stroke hgi-help-circle text-gray-300 dark:text-slate-700 text-4xl mb-3 block"></i>
                <h4 class="text-sm font-black text-secondary-900 dark:text-white uppercase">Issue with this order?</h4>
                <p class="text-[10px] text-secondary-400 dark:text-slate-500 font-bold uppercase tracking-widest mt-2 mb-4">Our support team is online</p>
                <button class="w-full py-3 bg-gray-50 dark:bg-slate-800 text-secondary-900 dark:text-slate-300 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-primary-600 hover:text-white transition">Get Support</button>
            </div>
        </div>
    </div>
</div>
@endsection
