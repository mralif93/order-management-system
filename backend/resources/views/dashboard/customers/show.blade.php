@extends('layouts.dashboard')

@section('title', 'Customer Details | OMS Admin')

@section('content')
<div class="max-w-[1600px] mx-auto space-y-8 pb-12 transition-colors duration-300">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="animate__animated animate__fadeInLeft">
            <div class="flex items-center gap-3 mb-2">
                <a href="{{ route('customers.index') }}" class="text-secondary-400 hover:text-primary-600 transition-colors">
                    <i class="hgi-stroke hgi-arrow-left-01 text-2xl"></i>
                </a>
                <span class="text-secondary-400 font-black text-xs uppercase tracking-widest">Customer Details</span>
            </div>
            <h1 class="text-3xl font-extrabold text-secondary-900 dark:text-white tracking-tight leading-none">{{ $customer->name }}</h1>
        </div>
        
        <div class="flex items-center gap-3 animate__animated animate__fadeInRight">
            <form action="{{ route('customers.update', $customer) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="is_locked" value="{{ $customer->is_locked ? '0' : '1' }}">
                <button type="submit" class="px-6 py-3 {{ $customer->is_locked ? 'bg-emerald-600' : 'bg-red-600' }} text-white rounded-2xl font-black hover:opacity-90 transition flex items-center gap-2 shadow-lg shadow-primary-500/10">
                    <i class="hgi-stroke {{ $customer->is_locked ? 'hgi-unlock' : 'hgi-lock' }} text-xl"></i>
                    {{ $customer->is_locked ? 'Unlock Account' : 'Lock Account' }}
                </button>
            </form>

            <form action="{{ route('customers.update', $customer) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="is_active" value="{{ $customer->is_active ? '0' : '1' }}">
                <button type="submit" class="px-6 py-3 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 text-secondary-700 dark:text-slate-300 rounded-2xl font-black hover:bg-gray-50 dark:hover:bg-slate-800 transition flex items-center gap-2 shadow-sm">
                    <i class="hgi-stroke hgi-settings-01 text-xl"></i>
                    {{ $customer->is_active ? 'Deactivate' : 'Activate' }}
                </button>
            </form>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-100 dark:border-emerald-800 text-emerald-700 dark:text-emerald-400 px-6 py-4 rounded-2xl font-bold animate__animated animate__fadeIn">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Profile Card -->
        <div class="lg:col-span-1 space-y-8">
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden">
                <div class="h-24 bg-gradient-to-r from-primary-500 to-primary-700"></div>
                <div class="px-8 pb-8">
                    <div class="relative -mt-12 mb-6">
                        <div class="w-24 h-24 rounded-3xl bg-white dark:bg-slate-800 p-2 shadow-xl">
                            <div class="w-full h-full rounded-2xl bg-primary-100 dark:bg-primary-900/30 text-primary-600 flex items-center justify-center font-black text-3xl">
                                {{ substr($customer->name, 0, 1) }}
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <h3 class="text-xl font-black text-secondary-900 dark:text-white leading-tight">{{ $customer->name }}</h3>
                            <p class="text-secondary-400 dark:text-slate-500 text-sm font-medium mt-1">{{ $customer->email }}</p>
                        </div>

                        <div class="grid grid-cols-1 gap-4">
                            <div class="p-4 bg-gray-50 dark:bg-slate-800 rounded-2xl border border-gray-100 dark:border-slate-700/50">
                                <span class="text-[10px] text-secondary-400 dark:text-slate-500 uppercase font-black tracking-widest block mb-1">Phone Number</span>
                                <span class="text-secondary-900 dark:text-white font-bold">{{ $customer->phone ?? 'Not provided' }}</span>
                            </div>
                            <div class="p-4 bg-gray-50 dark:bg-slate-800 rounded-2xl border border-gray-100 dark:border-slate-700/50">
                                <span class="text-[10px] text-secondary-400 dark:text-slate-500 uppercase font-black tracking-widest block mb-1">Join Date</span>
                                <span class="text-secondary-900 dark:text-white font-bold">{{ $customer->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="p-4 bg-gray-50 dark:bg-slate-800 rounded-2xl border border-gray-100 dark:border-slate-700/50">
                                <span class="text-[10px] text-secondary-400 dark:text-slate-500 uppercase font-black tracking-widest block mb-1">Account Status</span>
                                <div class="flex gap-2 mt-1">
                                    @if($customer->is_locked)
                                    <span class="inline-flex px-2 py-0.5 bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-400 text-[10px] font-black uppercase rounded-lg">Locked</span>
                                    @endif
                                    @if($customer->is_active)
                                    <span class="inline-flex px-2 py-0.5 bg-emerald-100 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 text-[10px] font-black uppercase rounded-lg">Active</span>
                                    @else
                                    <span class="inline-flex px-2 py-0.5 bg-amber-100 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400 text-[10px] font-black uppercase rounded-lg">Inactive</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address Card -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-secondary-100 dark:bg-secondary-800 text-secondary-600 dark:text-slate-400 flex items-center justify-center">
                        <i class="hgi-stroke hgi-location-01 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-black text-secondary-900 dark:text-white leading-none">Shipping Address</h3>
                        <p class="text-[10px] text-secondary-400 dark:text-slate-500 uppercase tracking-widest mt-1">Primary Location</p>
                    </div>
                </div>

                <div class="space-y-4 text-sm">
                    @if($customer->address_line1)
                        <div class="space-y-1">
                            <p class="text-secondary-700 dark:text-slate-300 font-medium">{{ $customer->address_line1 }}</p>
                            @if($customer->address_line2)<p class="text-secondary-700 dark:text-slate-300 font-medium">{{ $customer->address_line2 }}</p>@endif
                            @if($customer->address_line3)<p class="text-secondary-700 dark:text-slate-300 font-medium">{{ $customer->address_line3 }}</p>@endif
                            <p class="text-secondary-700 dark:text-slate-300 font-medium">{{ $customer->postal_code }} {{ $customer->city }}</p>
                            <p class="text-secondary-700 dark:text-slate-300 font-medium">{{ $customer->state }}</p>
                            <p class="text-secondary-900 dark:text-white font-black uppercase tracking-tight mt-2">{{ $customer->country }}</p>
                        </div>
                    @else
                        <div class="py-10 text-center bg-gray-50 dark:bg-slate-800 rounded-2xl border border-dashed border-gray-200 dark:border-slate-700">
                            <p class="text-secondary-400 dark:text-slate-500 font-bold italic">No address provided</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column: Activity & Orders -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Stats Row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="p-6 bg-white dark:bg-slate-900 rounded-3xl border border-gray-100 dark:border-slate-800 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-amber-100 dark:bg-amber-900/20 text-amber-600 flex items-center justify-center">
                            <i class="hgi-stroke hgi-shopping-cart-01 text-2xl"></i>
                        </div>
                    </div>
                    <p class="text-3xl font-black text-secondary-900 dark:text-white tracking-tight">{{ $customer->orders->count() }}</p>
                    <p class="text-[10px] text-secondary-400 dark:text-slate-500 font-black uppercase tracking-widest mt-1">Total Orders</p>
                </div>
                <div class="p-6 bg-white dark:bg-slate-900 rounded-3xl border border-gray-100 dark:border-slate-800 shadow-sm">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-100 dark:bg-emerald-900/20 text-emerald-600 flex items-center justify-center">
                            <i class="hgi-stroke hgi-coins text-2xl"></i>
                        </div>
                    </div>
                    <p class="text-3xl font-black text-secondary-900 dark:text-white tracking-tight">MYR {{ number_format($customer->orders->sum('total_amount'), 2) }}</p>
                    <p class="text-[10px] text-secondary-400 dark:text-slate-500 font-black uppercase tracking-widest mt-1">Lifetime Value</p>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden">
                <div class="p-6 border-b border-gray-50 dark:border-slate-800 flex items-center justify-between">
                    <h3 class="font-black text-secondary-900 dark:text-white">Recent Orders</h3>
                    <a href="{{ route('orders.index', ['search' => $customer->email]) }}" class="text-primary-600 text-xs font-black uppercase tracking-widest hover:underline">View All</a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50/50 dark:bg-slate-800/30 text-secondary-400 dark:text-slate-500 text-[10px] uppercase font-black tracking-widest">
                                <th class="py-4 px-6">Order ID</th>
                                <th class="py-4 px-6">Date</th>
                                <th class="py-4 px-6">Amount</th>
                                <th class="py-4 px-6">Status</th>
                                <th class="py-4 px-6 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-slate-800 text-sm">
                            @forelse($customer->orders as $order)
                            <tr class="hover:bg-primary-50/20 dark:hover:bg-primary-900/5 transition-colors">
                                <td class="py-4 px-6">
                                    <span class="font-black text-secondary-900 dark:text-white">#{{ $order->order_number }}</span>
                                </td>
                                <td class="py-4 px-6 font-medium text-secondary-600 dark:text-slate-400">
                                    {{ $order->created_at->format('M d, Y') }}
                                </td>
                                <td class="py-4 px-6 font-black text-secondary-900 dark:text-white">
                                    {{ $order->currency }} {{ number_format($order->total_amount, 2) }}
                                </td>
                                <td class="py-4 px-6">
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
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-[10px] font-black uppercase tracking-wider {{ $colorClass }}">
                                        {{ $order->order_status }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <a href="{{ route('orders.show', $order) }}" class="text-primary-600 hover:text-primary-700 transition-colors">
                                        <i class="hgi-stroke hgi-eye text-xl"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-secondary-400 dark:text-slate-500 font-bold italic">
                                    No orders found for this customer.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
