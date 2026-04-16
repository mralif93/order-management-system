@extends('layouts.seller')

@section('title', 'Order Details | #' . $order->order_number . ' | OMS Seller')

@section('content')
    @php
        $cur = $order->currency ?? 'MYR';
        $statusMap = [
            'pending' => ['color' => 'amber', 'icon' => 'hgi-clock-01', 'label' => 'Pending'],
            'processing' => ['color' => 'blue', 'icon' => 'hgi-settings-02', 'label' => 'Processing'],
            'shipped' => ['color' => 'indigo', 'icon' => 'hgi-truck-01', 'label' => 'Shipped'],
            'delivered' => ['color' => 'emerald', 'icon' => 'hgi-checkmark-circle-01', 'label' => 'Delivered'],
            'cancelled' => ['color' => 'red', 'icon' => 'hgi-cancel-circle', 'label' => 'Cancelled'],
        ];
        $st = $statusMap[strtolower($order->order_status)] ?? ['color' => 'gray', 'icon' => 'hgi-circle', 'label' => ucfirst($order->order_status)];
        $isGuest = !$order->customer_id;
        $custName = $order->customer?->name ?? $order->guest_name ?? 'Guest';
        $custEmail = $order->customer?->email ?? null;
        $custPhone = $order->customer?->phone ?? $order->guest_phone ?? null;
    @endphp

    <div class="max-w-[1600px] mx-auto space-y-8 pb-12 transition-colors duration-300">

        <!-- Back Link -->
        <a href="javascript:history.back()"
            class="inline-flex items-center gap-2 text-sm font-bold text-secondary-500 dark:text-slate-400 hover:text-primary-600 transition group">
            <i class="hgi-stroke hgi-arrow-left-01 group-hover:-translate-x-1 transition-transform"></i>
            <span>Back to My Orders</span>
        </a>

        <!-- Page Header -->
        <div class="animate__animated animate__fadeInDown">
            <div class="flex items-center gap-3 mb-1">
                <span
                    class="px-3 py-1 bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 rounded-lg text-[10px] font-black uppercase tracking-widest">Order
                    Receipt</span>
                <span
                    class="text-secondary-400 dark:text-slate-500 font-bold text-sm">{{ $order->created_at->format('M d, Y • h:i A') }}</span>
            </div>
            <h1 class="text-3xl font-extrabold text-secondary-900 dark:text-white tracking-tight">
                #{{ $order->order_number }}</h1>
        </div>


        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate__animated animate__fadeInUp">
            <!-- ── Left column (2/3) ── -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Ordered Items Card -->
                <div
                    class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 dark:border-slate-800 flex items-center gap-3">
                        <div
                            class="w-8 h-8 rounded-lg bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 flex items-center justify-center">
                            <i class="hgi-stroke hgi-package"></i>
                        </div>
                        <h2 class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter">Ordered
                            Items</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr
                                    class="bg-gray-50/50 dark:bg-slate-800/30 text-secondary-400 dark:text-slate-500 text-[10px] uppercase font-black tracking-widest">
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
                                                <div
                                                    class="w-12 h-12 rounded-xl bg-gray-100 dark:bg-slate-800 flex items-center justify-center text-primary-600 group-hover:bg-primary-100 dark:group-hover:bg-primary-900/30 transition-colors">
                                                    <i class="hgi-stroke hgi-package text-2xl"></i>
                                                </div>
                                                <div>
                                                    <p class="font-bold text-secondary-900 dark:text-white">
                                                        {{ $item->product->name ?? 'Product Unavailable' }}
                                                    </p>
                                                    <span
                                                        class="mt-1 px-2 py-0.5 bg-gray-100 dark:bg-slate-800 text-secondary-500 dark:text-slate-400 rounded-lg text-[10px] font-bold uppercase tracking-wider inline-block">{{ $item->product->sku ?? 'N/A' }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-5 px-6 text-center">
                                            <span
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-gray-100 dark:bg-slate-800 font-black text-secondary-700 dark:text-slate-300 text-sm">{{ $item->quantity }}</span>
                                        </td>
                                        <td class="py-5 px-6 text-right font-medium text-secondary-500 dark:text-slate-400">
                                            {{ $cur }} {{ number_format($item->unit_price, 2) }}
                                        </td>
                                        <td class="py-5 px-6 text-right font-black text-secondary-900 dark:text-white">
                                            {{ $cur }} {{ number_format($item->total_price, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Notes Card -->
                @if($order->notes)
                    <div
                        class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-8 h-8 rounded-lg bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 flex items-center justify-center">
                                <i class="hgi-stroke hgi-note"></i>
                            </div>
                            <h3 class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter">Order
                                Notes</h3>
                        </div>
                        <p
                            class="text-sm text-secondary-600 dark:text-slate-400 font-medium leading-relaxed bg-gray-50 dark:bg-slate-800 rounded-2xl px-4 py-3">
                            {{ $order->notes }}
                        </p>
                    </div>
                @endif

                <!-- Payment Summary Card -->
                <div
                    class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="w-8 h-8 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center">
                            <i class="hgi-stroke hgi-money-send-01"></i>
                        </div>
                        <h3 class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter">Payment
                            Summary</h3>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2.5 px-4 rounded-2xl bg-gray-50 dark:bg-slate-800">
                            <span
                                class="text-xs font-black text-secondary-500 dark:text-slate-400 uppercase tracking-widest">Subtotal</span>
                            <span class="font-bold text-secondary-700 dark:text-slate-300 text-sm">{{ $cur }}
                                {{ number_format($order->subtotal_amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2.5 px-4 rounded-2xl bg-gray-50 dark:bg-slate-800">
                            <span
                                class="text-xs font-black text-secondary-500 dark:text-slate-400 uppercase tracking-widest">Delivery
                                Fee</span>
                            <span
                                class="font-bold text-secondary-700 dark:text-slate-300 text-sm">{{ $order->shipping_amount > 0 ? $cur . ' ' . number_format($order->shipping_amount, 2) : 'Free' }}</span>
                        </div>
                        @if($order->tax_amount > 0)
                            <div class="flex justify-between items-center py-2.5 px-4 rounded-2xl bg-gray-50 dark:bg-slate-800">
                                <span
                                    class="text-xs font-black text-secondary-500 dark:text-slate-400 uppercase tracking-widest">Tax</span>
                                <span class="font-bold text-secondary-700 dark:text-slate-300 text-sm">{{ $cur }}
                                    {{ number_format($order->tax_amount, 2) }}</span>
                            </div>
                        @endif
                        @if(($order->discount_amount ?? 0) > 0)
                            <div
                                class="flex justify-between items-center py-2.5 px-4 rounded-2xl bg-emerald-50 dark:bg-emerald-900/20">
                                <span
                                    class="text-xs font-black text-emerald-600 dark:text-emerald-400 uppercase tracking-widest">Discount</span>
                                <span class="font-bold text-emerald-600 dark:text-emerald-400 text-sm">− {{ $cur }}
                                    {{ number_format($order->discount_amount, 2) }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between items-center py-3 px-4 rounded-2xl bg-primary-600">
                            <span class="text-xs font-black text-primary-100 uppercase tracking-[0.2em]">Total Amount</span>
                            <span class="text-xl font-black text-white">{{ $cur }}
                                {{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── Right column (1/3) ── -->
            <div class="space-y-6">

                <!-- Status Card -->
                <div
                    class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="w-8 h-8 rounded-lg bg-{{ $st['color'] }}-100 dark:bg-{{ $st['color'] }}-900/30 text-{{ $st['color'] }}-600 dark:text-{{ $st['color'] }}-400 flex items-center justify-center">
                            <i class="hgi-stroke {{ $st['icon'] }}"></i>
                        </div>
                        <h3 class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter">Order
                            Status</h3>
                    </div>
                    <div class="mb-5">
                        <p
                            class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest mb-2">
                            Current</p>
                        <span
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl text-sm font-black uppercase tracking-wider bg-{{ $st['color'] }}-100 dark:bg-{{ $st['color'] }}-900/20 text-{{ $st['color'] }}-700 dark:text-{{ $st['color'] }}-400">
                            <span
                                class="w-2 h-2 rounded-full bg-{{ $st['color'] }}-500 {{ strtolower($order->order_status) === 'pending' ? 'animate-pulse' : '' }}"></span>
                            {{ $st['label'] }}
                        </span>
                    </div>
                    <form action="{{ route('seller.orders.update', $order) }}" method="POST" class="space-y-3">
                        @csrf @method('PUT')
                        <p class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">
                            Update To</p>
                        <select name="order_status"
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-bold focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200">
                            @foreach(['pending' => 'Pending', 'processing' => 'Processing', 'shipped' => 'Shipped', 'delivered' => 'Delivered', 'cancelled' => 'Cancelled'] as $val => $label)
                                <option value="{{ $val }}" {{ $order->order_status == $val ? 'selected' : '' }}>{{ $label }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit"
                            class="w-full py-3 bg-secondary-900 dark:bg-primary-600 text-white rounded-2xl font-black text-sm hover:shadow-lg transition-all active:scale-95 flex items-center justify-center gap-2">
                            <i class="hgi-stroke hgi-tick-01 text-lg"></i> Update Status
                        </button>
                    </form>
                </div>

                <!-- Seller Remarks Card -->
                <div
                    class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 p-6">
                    <div class="flex items-center gap-3 mb-5">
                        <div
                            class="w-8 h-8 rounded-lg bg-violet-100 dark:bg-violet-900/30 text-violet-600 dark:text-violet-400 flex items-center justify-center">
                            <i class="hgi-stroke hgi-pencil-edit-01"></i>
                        </div>
                        <h3 class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter">Seller
                            Remarks</h3>
                    </div>

                    @if($order->seller_remarks)
                        <div
                            class="mb-4 px-4 py-3 bg-violet-50 dark:bg-violet-900/10 rounded-2xl border border-violet-100 dark:border-violet-800/40">
                            <p class="text-sm text-violet-800 dark:text-violet-300 font-medium leading-relaxed">
                                {{ $order->seller_remarks }}</p>
                            @if($order->updated_at && $order->updated_at != $order->created_at)
                                <p
                                    class="mt-2 text-[10px] font-black text-violet-400 dark:text-violet-500 uppercase tracking-widest">
                                    Last updated {{ $order->updated_at->diffForHumans() }}</p>
                            @endif
                        </div>
                    @endif

                    <form action="{{ route('seller.orders.update', $order) }}" method="POST" class="space-y-3">
                        @csrf @method('PUT')
                        {{-- Keep current status so it isn't reset --}}
                        <input type="hidden" name="order_status" value="{{ $order->order_status }}">
                        <textarea name="seller_remarks" rows="4"
                            placeholder="Add internal remarks, tracking info, or delivery notes…"
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium text-secondary-700 dark:text-slate-300 placeholder-secondary-300 dark:placeholder-slate-600 focus:ring-2 focus:ring-violet-500/50 outline-none resize-none">{{ old('seller_remarks', $order->seller_remarks) }}</textarea>
                        <button type="submit"
                            class="w-full py-3 bg-violet-600 hover:bg-violet-700 text-white rounded-2xl font-black text-sm hover:shadow-lg transition-all active:scale-95 flex items-center justify-center gap-2">
                            <i class="hgi-stroke hgi-floppy-disk text-lg"></i> Save Remarks
                        </button>
                    </form>
                </div>

                <!-- Customer Card -->
                <div
                    class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="w-8 h-8 rounded-lg {{ $isGuest ? 'bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400' : 'bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400' }} flex items-center justify-center">
                            <i class="hgi-stroke hgi-user-circle"></i>
                        </div>
                        <h3
                            class="flex-1 text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter leading-none">
                            Customer</h3>
                        @if($isGuest)
                            <span
                                class="px-2 py-1 bg-amber-100 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400 text-[9px] font-black uppercase rounded-lg tracking-wider">Guest</span>
                        @endif
                    </div>
                    <div class="flex items-center gap-4 mb-5">
                        <div
                            class="w-14 h-14 rounded-2xl {{ $isGuest ? 'bg-amber-100 dark:bg-amber-900/30 text-amber-600' : 'bg-primary-100 dark:bg-primary-900/30 text-primary-600' }} flex items-center justify-center font-black text-2xl uppercase flex-shrink-0">
                            {{ strtoupper(substr($custName, 0, 1)) }}
                        </div>
                        <div class="min-w-0">
                            <p class="font-black text-secondary-900 dark:text-white leading-none mb-1 truncate">
                                {{ $custName }}
                            </p>
                            <p
                                class="text-[10px] {{ $isGuest ? 'text-amber-600 dark:text-amber-400' : 'text-primary-600 dark:text-primary-400' }} font-black uppercase tracking-widest">
                                {{ $isGuest ? 'Guest Order' : 'Verified Customer' }}
                            </p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        @if($custEmail)
                            <div class="flex items-center gap-3 px-4 py-3 bg-gray-50 dark:bg-slate-800 rounded-2xl">
                                <i
                                    class="hgi-stroke hgi-mail-01 text-secondary-400 dark:text-slate-500 text-lg flex-shrink-0"></i>
                                <span
                                    class="text-sm font-medium text-secondary-600 dark:text-slate-400 truncate">{{ $custEmail }}</span>
                            </div>
                        @endif
                        @if($custPhone)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $custPhone) }}" target="_blank"
                                class="flex items-center gap-3 px-4 py-3 bg-gray-50 dark:bg-slate-800 rounded-2xl hover:bg-emerald-50 dark:hover:bg-emerald-900/20 group transition">
                                <i
                                    class="hgi-stroke hgi-whatsapp text-secondary-400 dark:text-slate-500 group-hover:text-emerald-500 text-lg flex-shrink-0 transition-colors"></i>
                                <span
                                    class="text-sm font-bold text-secondary-600 dark:text-slate-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">{{ $custPhone }}</span>
                            </a>
                        @endif
                        @if($order->source === 'whatsapp')
                            <div class="flex items-center gap-3 px-4 py-3 bg-emerald-50 dark:bg-emerald-900/10 rounded-2xl">
                                <i class="hgi-stroke hgi-store-01 text-emerald-500 text-lg flex-shrink-0"></i>
                                <span class="text-sm font-bold text-emerald-700 dark:text-emerald-400">Via WhatsApp Shop</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Order Meta Card -->
                <div
                    class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 p-6">
                    <div class="flex items-center gap-3 mb-5">
                        <div
                            class="w-8 h-8 rounded-lg bg-secondary-100 dark:bg-slate-800 text-secondary-500 dark:text-slate-400 flex items-center justify-center">
                            <i class="hgi-stroke hgi-information-circle"></i>
                        </div>
                        <h3 class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter">Order
                            Info</h3>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between px-4 py-3 bg-gray-50 dark:bg-slate-800 rounded-2xl">
                            <span
                                class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">Order
                                #</span>
                            <span
                                class="font-black text-secondary-900 dark:text-white text-sm">{{ $order->order_number }}</span>
                        </div>
                        <div class="flex items-center justify-between px-4 py-3 bg-gray-50 dark:bg-slate-800 rounded-2xl">
                            <span
                                class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">Date</span>
                            <span
                                class="font-bold text-secondary-700 dark:text-slate-300 text-sm">{{ $order->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between px-4 py-3 bg-gray-50 dark:bg-slate-800 rounded-2xl">
                            <span
                                class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">Time</span>
                            <span
                                class="font-bold text-secondary-700 dark:text-slate-300 text-sm">{{ $order->created_at->format('h:i A') }}</span>
                        </div>
                        <div class="flex items-center justify-between px-4 py-3 bg-gray-50 dark:bg-slate-800 rounded-2xl">
                            <span
                                class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">Currency</span>
                            <span class="font-bold text-secondary-700 dark:text-slate-300 text-sm">{{ $cur }}</span>
                        </div>
                        <div class="flex items-center justify-between px-4 py-3 bg-gray-50 dark:bg-slate-800 rounded-2xl">
                            <span
                                class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">Items</span>
                            <span
                                class="font-bold text-secondary-700 dark:text-slate-300 text-sm">{{ $order->items->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection