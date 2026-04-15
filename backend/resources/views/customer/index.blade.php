@extends('layouts.customer')

@section('title', 'My Dashboard | OMS Portal')

@section('content')
<div class="max-w-6xl mx-auto space-y-8 pb-12 transition-colors duration-300">
    <!-- Welcome Hero -->
    <div class="relative bg-primary-600 dark:bg-primary-900/40 rounded-3xl p-8 overflow-hidden shadow-2xl animate__animated animate__fadeIn border dark:border-primary-800/50">
        <div class="absolute right-0 top-0 w-64 h-64 bg-white/10 dark:bg-primary-500/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
        <div class="absolute left-0 bottom-0 w-40 h-40 bg-black/10 rounded-full -ml-10 -mb-10 blur-2xl"></div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="text-white">
                <h1 class="text-3xl font-black tracking-tight">Welcome back, {{ explode(' ', Auth::guard('customer')->user()->name ?? 'Customer')[0] }}!</h1>
                <p class="text-primary-100 dark:text-primary-300 mt-2 font-medium">You have <span class="font-bold underline dark:text-white">2 active orders</span> being processed right now.</p>
            </div>
            <div class="flex items-center gap-3">
                <button class="px-6 py-3 bg-white dark:bg-slate-900 text-primary-600 dark:text-primary-400 rounded-2xl font-black hover:bg-primary-50 dark:hover:bg-slate-800 transition shadow-lg flex items-center gap-2">
                    <i class="hgi-stroke hgi-plus-circle text-xl"></i> New Order
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Loyalty Card -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex items-center gap-5 group hover:shadow-md transition">
            <div class="w-14 h-14 rounded-2xl bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 flex items-center justify-center text-3xl shadow-inner group-hover:scale-110 transition duration-300">
                <i class="hgi-stroke hgi-star-circle"></i>
            </div>
            <div>
                <p class="text-xs font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">Rewards Points</p>
                <div class="flex items-center gap-2 mt-1">
                    <h3 class="text-2xl font-black text-secondary-900 dark:text-white">1,250</h3>
                    <span class="text-[10px] font-bold px-1.5 py-0.5 bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400 rounded border border-amber-100 dark:border-amber-800 uppercase">Gold</span>
                </div>
            </div>
        </div>

        <!-- Total Spent -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex items-center gap-5 group hover:shadow-md transition">
            <div class="w-14 h-14 rounded-2xl bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-3xl shadow-inner group-hover:scale-110 transition duration-300">
                <i class="hgi-stroke hgi-money-send-01"></i>
            </div>
            <div>
                <p class="text-xs font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">Total Spent</p>
                <h3 class="text-2xl font-black text-secondary-900 dark:text-white mt-1">$3,420.50</h3>
            </div>
        </div>

        <!-- Order Count -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 flex items-center gap-5 group hover:shadow-md transition">
            <div class="w-14 h-14 rounded-2xl bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center text-3xl shadow-inner group-hover:scale-110 transition duration-300">
                <i class="hgi-stroke hgi-shopping-bag-01"></i>
            </div>
            <div>
                <p class="text-xs font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">Order Count</p>
                <h3 class="text-2xl font-black text-secondary-900 dark:text-white mt-1">42 Orders</h3>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Orders -->
        <div class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden">
            <div class="p-6 border-b border-gray-50 dark:border-slate-800 flex items-center justify-between">
                <h2 class="text-xl font-black text-secondary-900 dark:text-white tracking-tighter uppercase">Recent Orders</h2>
                <a href="#" class="text-sm font-bold text-primary-600 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300">History</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-slate-800/50 text-secondary-400 dark:text-slate-500 text-[10px] uppercase font-black tracking-widest">
                            <th class="py-4 px-6">Order ID</th>
                            <th class="py-4 px-6">Date</th>
                            <th class="py-4 px-6">Status</th>
                            <th class="py-4 px-6">Total</th>
                            <th class="py-4 px-6 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-slate-800 text-sm text-secondary-700 dark:text-slate-300 font-medium">
                        @foreach([1, 2, 3] as $order)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-slate-800/50 transition duration-200">
                            <td class="py-5 px-6 font-bold text-secondary-900 dark:text-white">#ORD-{{ 940 - $order }}</td>
                            <td class="py-5 px-6 text-secondary-500 dark:text-slate-400">Oct 24, 2026</td>
                            <td class="py-5 px-6">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-primary-100 dark:bg-primary-900/20 text-primary-700 dark:text-primary-400">
                                    <span class="w-1.5 h-1.5 rounded-full bg-primary-600 dark:bg-primary-500 mr-2 animate-pulse"></span>
                                    Delivering
                                </span>
                            </td>
                            <td class="py-5 px-6 font-black text-secondary-900 dark:text-white">$45.00</td>
                            <td class="py-5 px-6 text-right">
                                <button class="px-3 py-1.5 bg-secondary-900 dark:bg-slate-800 text-white dark:text-slate-300 text-[10px] font-black rounded-lg uppercase tracking-widest hover:bg-primary-600 dark:hover:bg-primary-700 transition">Track</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Info -->
        <div class="space-y-6">
            <!-- Delivery Status -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-gray-100 dark:border-slate-800">
                <h3 class="text-lg font-black text-secondary-900 dark:text-white mb-6 uppercase tracking-tighter">Live Track</h3>
                <div class="relative pl-8 space-y-8 before:absolute before:left-3 before:top-2 before:bottom-2 before:w-0.5 before:bg-gray-100 dark:before:bg-slate-800">
                    <div class="relative">
                        <div class="absolute -left-[26px] top-1 w-4 h-4 rounded-full bg-primary-600 border-4 border-white dark:border-slate-900 shadow-sm shadow-primary-600/50"></div>
                        <h4 class="text-sm font-bold text-secondary-900 dark:text-slate-200">Out for Delivery</h4>
                        <p class="text-xs text-secondary-400 dark:text-slate-500 mt-1 font-medium">Driver: Ahmad S. (Motorcycle)</p>
                    </div>
                    <div class="relative">
                        <div class="absolute -left-[26px] top-1 w-4 h-4 rounded-full bg-primary-200 dark:bg-primary-900 border-4 border-white dark:border-slate-900 shadow-sm"></div>
                        <h4 class="text-sm font-bold text-secondary-500 dark:text-slate-400">Order Prepared</h4>
                        <p class="text-xs text-secondary-400 dark:text-slate-500 mt-1">Oct 24, 10:30 AM</p>
                    </div>
                </div>
            </div>

            <!-- Profile Overview -->
            <div class="bg-secondary-50 dark:bg-slate-900/50 rounded-3xl p-6 border border-secondary-100 dark:border-slate-800">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-primary-600 text-white flex items-center justify-center font-black text-xl shadow-lg">
                        {{ substr(Auth::guard('customer')->user()->name, 0, 1) }}
                    </div>
                    <div>
                        <h4 class="text-sm font-black text-secondary-900 dark:text-white">{{ Auth::guard('customer')->user()->name }}</h4>
                        <p class="text-[10px] text-primary-600 dark:text-primary-400 font-bold uppercase tracking-widest">Premium Member</p>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center gap-3 text-sm text-secondary-600 dark:text-slate-400 font-medium">
                        <i class="hgi-stroke hgi-mail-01 text-secondary-400 dark:text-slate-500"></i>
                        {{ Auth::guard('customer')->user()->email }}
                    </div>
                    <div class="flex items-center gap-3 text-sm text-secondary-600 dark:text-slate-400 font-medium">
                        <i class="hgi-stroke hgi-location-01 text-secondary-400 dark:text-slate-500"></i>
                        {{ Auth::guard('customer')->user()->city }}, {{ Auth::guard('customer')->user()->state }}
                    </div>
                </div>
                <button class="w-full mt-6 py-3 bg-white dark:bg-slate-800 border border-secondary-200 dark:border-slate-700 text-secondary-900 dark:text-slate-300 rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-secondary-900 hover:text-white dark:hover:bg-primary-600 transition duration-300">
                    Settings
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
