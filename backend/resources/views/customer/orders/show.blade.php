@extends('layouts.customer')

@section('title', 'Order #' . $order->order_number . ' | OMS Portal')

@section('content')
    @php
        $customer = Auth::guard('customer')->user();
        $cur = $order->currency ?? 'MYR';
        $statusMap = [
            'pending'    => ['color' => 'amber',   'icon' => 'hgi-clock-01',           'label' => 'Pending'],
            'processing' => ['color' => 'blue',    'icon' => 'hgi-settings-02',        'label' => 'Processing'],
            'shipped'    => ['color' => 'indigo',  'icon' => 'hgi-truck-01',           'label' => 'Shipped'],
            'delivered'  => ['color' => 'emerald', 'icon' => 'hgi-checkmark-circle-01','label' => 'Delivered'],
            'cancelled'  => ['color' => 'red',     'icon' => 'hgi-cancel-circle',      'label' => 'Cancelled'],
        ];
        $st = $statusMap[strtolower($order->order_status)] ?? ['color' => 'gray', 'icon' => 'hgi-circle', 'label' => ucfirst($order->order_status)];
    @endphp

    <div class="max-w-[1600px] mx-auto space-y-8 pb-12 transition-colors duration-300">

        {{-- Back link --}}
        <a href="javascript:history.back()"
            class="inline-flex items-center gap-2 text-sm font-bold text-secondary-500 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 transition group">
            <i class="hgi-stroke hgi-arrow-left-01 group-hover:-translate-x-1 transition-transform"></i>
            Back to My Orders
        </a>

        {{-- Page header --}}
        <div class="animate__animated animate__fadeInDown">
            <div class="flex items-center gap-3 mb-1">
                <span class="px-3 py-1 bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 rounded-lg text-[10px] font-black uppercase tracking-widest">Order Receipt</span>
                <span class="text-secondary-400 dark:text-slate-500 font-bold text-sm">{{ $order->created_at->format('M d, Y • h:i A') }}</span>
            </div>
            <h1 class="text-3xl font-extrabold text-secondary-900 dark:text-white tracking-tight">#{{ $order->order_number }}</h1>
        </div>

        {{-- Main grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate__animated animate__fadeInUp">

            {{-- ── Left column (2/3) ──────────────────────────────────────── --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Ordered Items --}}
                <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 dark:border-slate-800 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 flex items-center justify-center">
                            <i class="hgi-stroke hgi-package"></i>
                        </div>
                        <h2 class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter">Ordered Items</h2>
                        <span class="ml-auto px-2.5 py-1 bg-gray-100 dark:bg-slate-800 text-secondary-500 dark:text-slate-400 rounded-lg text-[10px] font-black uppercase tracking-widest">{{ $order->items->count() }} {{ Str::plural('item', $order->items->count()) }}</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-50/50 dark:bg-slate-800/30 text-secondary-400 dark:text-slate-500 text-[10px] uppercase font-black tracking-widest">
                                    <th class="py-4 px-6">Product</th>
                                    <th class="py-4 px-6 text-center">Qty</th>
                                    <th class="py-4 px-6 text-right">Unit Price</th>
                                    <th class="py-4 px-6 text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 dark:divide-slate-800 text-sm">
                                @foreach($order->items as $item)
                                    <tr class="hover:bg-primary-50/20 dark:hover:bg-primary-900/5 transition-colors group">
                                        <td class="py-5 px-6">
                                            <div class="flex items-center gap-4">
                                                <div class="w-12 h-12 rounded-xl bg-gray-100 dark:bg-slate-800 flex items-center justify-center text-primary-600 group-hover:bg-primary-100 dark:group-hover:bg-primary-900/30 transition-colors">
                                                    <i class="hgi-stroke hgi-package text-2xl"></i>
                                                </div>
                                                <div>
                                                    <p class="font-bold text-secondary-900 dark:text-white">{{ $item->product->name ?? 'Product Unavailable' }}</p>
                                                    @if($item->product?->sku)
                                                        <span class="mt-1 px-2 py-0.5 bg-gray-100 dark:bg-slate-800 text-secondary-500 dark:text-slate-400 rounded-lg text-[10px] font-bold uppercase tracking-wider inline-block">{{ $item->product->sku }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-5 px-6 text-center">
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-gray-100 dark:bg-slate-800 font-black text-secondary-700 dark:text-slate-300 text-sm">{{ $item->quantity }}</span>
                                        </td>
                                        <td class="py-5 px-6 text-right font-medium text-secondary-500 dark:text-slate-400">{{ $cur }} {{ number_format($item->unit_price, 2) }}</td>
                                        <td class="py-5 px-6 text-right font-black text-secondary-900 dark:text-white">{{ $cur }} {{ number_format($item->total_price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Order Notes --}}
                @if($order->notes)
                    <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 flex items-center justify-center">
                                <i class="hgi-stroke hgi-note"></i>
                            </div>
                            <h3 class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter">Order Notes</h3>
                        </div>
                        <p class="text-sm text-secondary-600 dark:text-slate-400 font-medium leading-relaxed bg-gray-50 dark:bg-slate-800 rounded-2xl px-4 py-3">{{ $order->notes }}</p>
                    </div>
                @endif

                {{-- Payment Summary --}}
                <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                            <i class="hgi-stroke hgi-money-send-01"></i>
                        </div>
                        <h3 class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter">Payment Summary</h3>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2.5 px-4 rounded-2xl bg-gray-50 dark:bg-slate-800">
                            <span class="text-xs font-black text-secondary-500 dark:text-slate-400 uppercase tracking-widest">Subtotal</span>
                            <span class="font-bold text-secondary-700 dark:text-slate-300 text-sm">{{ $cur }} {{ number_format($order->subtotal_amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2.5 px-4 rounded-2xl bg-gray-50 dark:bg-slate-800">
                            <span class="text-xs font-black text-secondary-500 dark:text-slate-400 uppercase tracking-widest">Delivery Fee</span>
                            <span class="font-bold text-secondary-700 dark:text-slate-300 text-sm">{{ $order->shipping_amount > 0 ? $cur . ' ' . number_format($order->shipping_amount, 2) : 'Free' }}</span>
                        </div>
                        @if(($order->discount_amount ?? 0) > 0)
                            <div class="flex justify-between items-center py-2.5 px-4 rounded-2xl bg-emerald-50 dark:bg-emerald-900/20">
                                <span class="text-xs font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-widest">Discount</span>
                                <span class="font-bold text-emerald-600 dark:text-emerald-400 text-sm">− {{ $cur }} {{ number_format($order->discount_amount, 2) }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between items-center py-3 px-4 rounded-2xl bg-primary-600">
                            <span class="text-xs font-black text-primary-100 uppercase tracking-[0.2em]">Total Amount</span>
                            <span class="text-xl font-black text-white">{{ $cur }} {{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Right column (1/3) ─────────────────────────────────────── --}}
            <div class="space-y-6">

                {{-- Order Status --}}
                <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 p-6">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-8 h-8 rounded-lg bg-{{ $st['color'] }}-100 dark:bg-{{ $st['color'] }}-900/30 text-{{ $st['color'] }}-600 dark:text-{{ $st['color'] }}-400 flex items-center justify-center">
                            <i class="hgi-stroke {{ $st['icon'] }}"></i>
                        </div>
                        <h3 class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter">Order Status</h3>
                    </div>
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl text-sm font-black uppercase tracking-wider bg-{{ $st['color'] }}-100 dark:bg-{{ $st['color'] }}-900/20 text-{{ $st['color'] }}-700 dark:text-{{ $st['color'] }}-400">
                        <span class="w-2 h-2 rounded-full bg-{{ $st['color'] }}-500 {{ strtolower($order->order_status) === 'pending' ? 'animate-pulse' : '' }}"></span>
                        {{ $st['label'] }}
                    </span>

                    {{-- Seller remarks (visible to customer) --}}
                    @if($order->seller_remarks)
                        <div class="mt-5 px-4 py-3 bg-violet-50 dark:bg-violet-900/10 rounded-2xl border border-violet-100 dark:border-violet-800/40">
                            <p class="text-[10px] font-black text-violet-500 dark:text-violet-400 uppercase tracking-widest mb-1">Seller Note</p>
                            <p class="text-sm text-violet-800 dark:text-violet-300 font-medium leading-relaxed">{{ $order->seller_remarks }}</p>
                        </div>
                    @endif
                </div>

                {{-- Delivery Address --}}
                <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 p-6">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center">
                            <i class="hgi-stroke hgi-location-01"></i>
                        </div>
                        <h3 class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter">Delivery Address</h3>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm font-bold text-secondary-900 dark:text-white">{{ $customer->name }}</p>
                        @if($customer->phone)
                            <p class="text-xs text-secondary-500 dark:text-slate-400 font-medium flex items-center gap-2">
                                <i class="hgi-stroke hgi-call text-secondary-300 dark:text-slate-600"></i>
                                {{ $customer->phone }}
                            </p>
                        @endif
                        <p class="text-xs text-secondary-500 dark:text-slate-400 leading-relaxed">
                            {{ $customer->address_line1 ?? 'No address on file' }}
                            @if($customer->city), {{ $customer->city }}@endif
                            @if($customer->state), {{ $customer->state }}@endif
                        </p>
                    </div>
                </div>

                {{-- Order Info --}}
                <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 p-6">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-8 h-8 rounded-lg bg-secondary-100 dark:bg-slate-800 text-secondary-600 dark:text-slate-400 flex items-center justify-center">
                            <i class="hgi-stroke hgi-information-circle"></i>
                        </div>
                        <h3 class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter">Order Info</h3>
                    </div>
                    <div class="space-y-2">
                        @foreach([
                            ['icon' => 'hgi-tag-01',       'label' => 'Order #',   'value' => '#' . $order->order_number],
                            ['icon' => 'hgi-calendar-03',  'label' => 'Date',      'value' => $order->created_at->format('d M Y')],
                            ['icon' => 'hgi-clock-01',     'label' => 'Time',      'value' => $order->created_at->format('h:i A')],
                            ['icon' => 'hgi-coins-01',     'label' => 'Currency',  'value' => $cur],
                            ['icon' => 'hgi-package',      'label' => 'Items',     'value' => $order->items->count() . ' ' . Str::plural('item', $order->items->count())],
                        ] as $row)
                            <div class="flex items-center justify-between py-2 px-3 rounded-xl bg-gray-50 dark:bg-slate-800 gap-2">
                                <div class="flex items-center gap-2 min-w-0">
                                    <i class="hgi-stroke {{ $row['icon'] }} text-secondary-400 dark:text-slate-500 shrink-0"></i>
                                    <span class="text-xs font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">{{ $row['label'] }}</span>
                                </div>
                                <span class="text-xs font-bold text-secondary-700 dark:text-slate-300 truncate">{{ $row['value'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Help --}}
                <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 p-6 text-center">
                    <i class="hgi-stroke hgi-customer-service text-gray-300 dark:text-slate-700 text-4xl mb-3 block"></i>
                    <h4 class="text-sm font-black text-secondary-900 dark:text-white uppercase">Issue with this order?</h4>
                    <p class="text-[10px] text-secondary-400 dark:text-slate-500 font-bold uppercase tracking-widest mt-2 mb-4">Our support team is ready to help</p>
                    <button class="w-full py-3 bg-gray-50 dark:bg-slate-800 text-secondary-900 dark:text-slate-300 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-primary-600 hover:text-white dark:hover:bg-primary-600 transition">
                        Contact Support
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection