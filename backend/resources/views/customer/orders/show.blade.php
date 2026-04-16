@extends('layouts.customer')

@section('title', 'Order #' . $order->order_number . ' | OMS Portal')

@section('content')
    @php
        $customer = Auth::guard('customer')->user();
        $sc = ['pending' => 'bg-amber-100 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400', 'processing' => 'bg-blue-100 dark:bg-blue-900/20 text-blue-700 dark:text-blue-400', 'shipped' => 'bg-indigo-100 dark:bg-indigo-900/20 text-indigo-700 dark:text-indigo-400', 'delivered' => 'bg-emerald-100 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400', 'cancelled' => 'bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-400'];
        $statusClass = $sc[strtolower($order->order_status)] ?? 'bg-gray-100 text-gray-700';
    @endphp
    <div class="max-w-6xl mx-auto space-y-8 pb-12 transition-colors duration-300">

        <!-- Breadcrumb / Back -->
        <div class="flex items-center justify-between animate__animated animate__fadeInDown">
            <a href="javascript:history.back()"
                class="inline-flex items-center gap-2 text-sm font-bold text-secondary-500 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 transition group">
                <i class="hgi-stroke hgi-arrow-left-01 group-hover:-translate-x-1 transition-transform"></i>
                Back to My Orders
            </a>
            <span
                class="inline-flex items-center px-3 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider {{ $statusClass }}">
                <span class="w-1.5 h-1.5 rounded-full bg-current mr-2 opacity-60"></span>
                {{ $order->order_status }}
            </span>
        </div>

        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Left: Order Detail -->
            <div class="lg:col-span-2 space-y-6 animate__animated animate__fadeInLeft">

                <!-- Order Banner -->
                <div
                    class="bg-primary-600 dark:bg-primary-900/40 rounded-3xl p-8 text-white relative overflow-hidden shadow-xl border dark:border-primary-800/50">
                    <div class="absolute right-0 top-0 w-48 h-48 bg-white/10 rounded-full -mr-16 -mt-16 blur-3xl"></div>
                    <div class="relative z-10">
                        <p class="text-[10px] font-black uppercase tracking-[0.2em] opacity-70 mb-3">Order Reference</p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center text-2xl">
                                <i class="hgi-stroke hgi-package"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-black uppercase tracking-tight">#{{ $order->order_number }}</h2>
                                <p class="text-primary-100 dark:text-primary-300 text-sm font-medium mt-1">Placed on
                                    {{ $order->created_at->format('F d, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Items Table -->
                <div
                    class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 dark:border-slate-800">
                        <h3 class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter">Order
                            Items</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr
                                    class="bg-gray-50/50 dark:bg-slate-800/50 text-secondary-400 dark:text-slate-500 text-[10px] uppercase font-black tracking-widest">
                                    <th class="py-4 px-6">Product</th>
                                    <th class="py-4 px-6 text-center">Qty</th>
                                    <th class="py-4 px-6 text-right">Unit Price</th>
                                    <th class="py-4 px-6 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 dark:divide-slate-800 text-sm">
                                @foreach($order->items as $item)
                                    <tr class="hover:bg-gray-50/50 dark:hover:bg-slate-800/50 transition">
                                        <td class="py-5 px-6">
                                            <div class="flex items-center gap-4">
                                                <div
                                                    class="w-10 h-10 rounded-xl bg-gray-50 dark:bg-slate-800 flex items-center justify-center text-primary-600">
                                                    <i class="hgi-stroke hgi-package text-xl"></i>
                                                </div>
                                                <span
                                                    class="font-bold text-secondary-900 dark:text-white">{{ $item->product->name ?? 'Unavailable Product' }}</span>
                                            </div>
                                        </td>
                                        <td class="py-5 px-6 text-center font-bold text-secondary-600 dark:text-slate-400">×
                                            {{ $item->quantity }}</td>
                                        <td class="py-5 px-6 text-right text-secondary-500 dark:text-slate-400">
                                            {{ $order->currency }} {{ number_format($item->unit_price, 2) }}</td>
                                        <td class="py-5 px-6 text-right font-black text-secondary-900 dark:text-white">
                                            {{ $order->currency }} {{ number_format($item->total_price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right: Billing Sidebar -->
            <div class="space-y-6 animate__animated animate__fadeInRight">

                <!-- Order Totals -->
                <div
                    class="bg-secondary-900 dark:bg-slate-900 rounded-3xl p-8 text-white shadow-2xl border dark:border-slate-800">
                    <h3 class="text-xs font-black uppercase tracking-[0.2em] opacity-50 mb-6">Order Summary</h3>
                    <div class="space-y-4 mb-8">
                        <div
                            class="flex items-center justify-between text-xs font-black uppercase tracking-widest opacity-60">
                            <span>Subtotal</span>
                            <span>{{ $order->currency }} {{ number_format($order->subtotal_amount, 2) }}</span>
                        </div>
                        <div
                            class="flex items-center justify-between text-xs font-black uppercase tracking-widest opacity-60">
                            <span>Shipping</span>
                            <span>{{ $order->currency }} {{ number_format($order->shipping_amount, 2) }}</span>
                        </div>
                        @if($order->discount_amount > 0)
                            <div
                                class="flex items-center justify-between text-xs font-black uppercase tracking-widest text-emerald-400">
                                <span>Discount</span>
                                <span>- {{ $order->currency }} {{ number_format($order->discount_amount, 2) }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="pt-6 border-t border-white/10">
                        <p class="text-[10px] font-black uppercase tracking-[0.3em] opacity-40 mb-2">Total Charged</p>
                        <h3 class="text-4xl font-black text-primary-400 tracking-tighter">{{ $order->currency }}
                            {{ number_format($order->total_amount, 2) }}</h3>
                    </div>
                </div>

                <!-- Delivery Address -->
                <div
                    class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-gray-100 dark:border-slate-800">
                    <h3 class="text-xs font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest mb-5">
                        Delivery Address</h3>
                    <div class="flex gap-4">
                        <div
                            class="w-10 h-10 rounded-xl bg-gray-50 dark:bg-slate-800 text-primary-600 flex items-center justify-center text-xl flex-shrink-0">
                            <i class="hgi-stroke hgi-location-01"></i>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-secondary-900 dark:text-white">{{ $customer->name }}</p>
                            <p class="text-xs text-secondary-500 dark:text-slate-400 mt-1 leading-relaxed">
                                {{ $customer->address_line1 ?? 'No Address Provided' }}
                                @if($customer->city), {{ $customer->city }}@endif
                                @if($customer->state), {{ $customer->state }}@endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Help Card -->
                <div
                    class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 text-center">
                    <i class="hgi-stroke hgi-customer-service text-gray-300 dark:text-slate-700 text-4xl mb-3 block"></i>
                    <h4 class="text-sm font-black text-secondary-900 dark:text-white uppercase">Issue with this order?</h4>
                    <p
                        class="text-[10px] text-secondary-400 dark:text-slate-500 font-bold uppercase tracking-widest mt-2 mb-4">
                        Our support team is ready to help</p>
                    <button
                        class="w-full py-3 bg-gray-50 dark:bg-slate-800 text-secondary-900 dark:text-slate-300 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-primary-600 hover:text-white dark:hover:bg-primary-600 transition">
                        Contact Support
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection