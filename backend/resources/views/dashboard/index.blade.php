@extends('layouts.dashboard')

@section('title', 'Overview Dashboard | OMS Admin')

@section('content')
<div class="max-w-[1600px] mx-auto space-y-8 pb-12 transition-colors duration-300">
    <!-- Header Page -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="animate__animated animate__fadeInLeft">
            <h1 class="text-3xl font-extrabold text-secondary-900 dark:text-white tracking-tight">Dashboard Overview</h1>
            <p class="text-secondary-500 dark:text-slate-400 mt-2 font-medium">Monitoring your order ecosystem in real-time.</p>
        </div>
        <div class="flex items-center gap-3 animate__animated animate__fadeInRight">
            <button class="px-4 py-2.5 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 text-secondary-700 dark:text-slate-300 rounded-xl font-bold hover:bg-gray-50 dark:hover:bg-slate-800 transition shadow-sm flex items-center gap-2 text-sm">
                <i class="hgi-stroke hgi-calendar-03 text-lg"></i> Last 30 Days
            </button>
            <button class="px-4 py-2.5 bg-primary-600 text-white rounded-xl font-bold hover:bg-primary-700 hover:shadow-lg transition shadow-md flex items-center gap-2 text-sm">
                <i class="hgi-stroke hgi-plus text-lg"></i> Create Order
            </button>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Revenue Card -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 hover:shadow-xl hover:-translate-y-1 transition duration-300 group overflow-hidden relative">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-50 dark:bg-emerald-900/10 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="flex flex-col gap-4 relative z-10">
                <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-2xl">
                    <i class="hgi-stroke hgi-money-01"></i>
                </div>
                <div>
                    <p class="text-sm font-bold text-secondary-400 dark:text-slate-500 uppercase tracking-wider">Total Revenue</p>
                    <div class="flex items-end gap-2 mt-1">
                        <h3 class="text-3xl font-black text-secondary-900 dark:text-white">$128,430</h3>
                        <span class="text-xs font-bold text-emerald-600 mb-1 flex items-center shadow-sm"><i class="hgi-stroke hgi-chart-line-up-01 mr-1"></i> +12%</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 hover:shadow-xl hover:-translate-y-1 transition duration-300 group overflow-hidden relative">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-primary-50 dark:bg-primary-900/10 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="flex flex-col gap-4 relative z-10">
                <div class="w-12 h-12 rounded-xl bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 flex items-center justify-center text-2xl">
                    <i class="hgi-stroke hgi-shopping-bag-01"></i>
                </div>
                <div>
                    <p class="text-sm font-bold text-secondary-400 dark:text-slate-500 uppercase tracking-wider">Total Orders</p>
                    <div class="flex items-end gap-2 mt-1">
                        <h3 class="text-3xl font-black text-secondary-900 dark:text-white">3,842</h3>
                        <span class="text-xs font-bold text-primary-600 mb-1 flex items-center shadow-sm"><i class="hgi-stroke hgi-chart-line-up-01 mr-1"></i> +8.4%</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customers Card -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 hover:shadow-xl hover:-translate-y-1 transition duration-300 group overflow-hidden relative">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-50 dark:bg-blue-900/10 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="flex flex-col gap-4 relative z-10">
                <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center text-2xl">
                    <i class="hgi-stroke hgi-user-multiple text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-bold text-secondary-400 dark:text-slate-500 uppercase tracking-wider">Active Customers</p>
                    <div class="flex items-end gap-2 mt-1">
                        <h3 class="text-3xl font-black text-secondary-900 dark:text-white">1,208</h3>
                        <span class="text-xs font-bold text-blue-600 mb-1 flex items-center shadow-sm"><i class="hgi-stroke hgi-chart-line-up-01 mr-1"></i> +5.1%</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Card -->
        <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-slate-800 hover:shadow-xl hover:-translate-y-1 transition duration-300 group overflow-hidden relative">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-amber-50 dark:bg-amber-900/10 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="flex flex-col gap-4 relative z-10">
                <div class="w-12 h-12 rounded-xl bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 flex items-center justify-center text-2xl">
                    <i class="hgi-stroke hgi-time-02 text-xl"></i>
                </div>
                <div>
                    <p class="text-sm font-bold text-secondary-400 dark:text-slate-500 uppercase tracking-wider">Pending Tasks</p>
                    <div class="flex items-end gap-2 mt-1">
                        <h3 class="text-3xl font-black text-secondary-900 dark:text-white">42</h3>
                        <span class="text-xs font-bold text-amber-600 mb-1 flex items-center shadow-sm">Action Required</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Orders Table -->
        <div class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 overflow-hidden flex flex-col">
            <div class="p-6 border-b border-gray-50 dark:border-slate-800 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-black text-secondary-900 dark:text-white">Recent Orders</h2>
                    <p class="text-xs text-secondary-400 dark:text-slate-500 font-bold mt-1 uppercase tracking-tight">Latests Transactions</p>
                </div>
                <a href="#" class="px-3 py-1.5 bg-gray-50 dark:bg-slate-800 text-secondary-600 dark:text-slate-400 rounded-lg text-xs font-bold hover:bg-gray-100 dark:hover:bg-slate-700 transition">View All Orders</a>
            </div>
            <div class="flex-1 overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-slate-800/50 text-secondary-400 dark:text-slate-500 text-[11px] uppercase font-black tracking-widest">
                            <th class="py-4 px-6">ID</th>
                            <th class="py-4 px-6">Customer</th>
                            <th class="py-4 px-6">Status</th>
                            <th class="py-4 px-6">Amt</th>
                            <th class="py-4 px-6 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 dark:divide-slate-800 text-sm text-secondary-700 dark:text-slate-300 font-medium">
                        @foreach([1, 2, 3, 4, 5] as $index)
                        <tr class="hover:bg-primary-50/30 dark:hover:bg-primary-900/10 transition-colors group">
                            <td class="py-4 px-6 text-secondary-900 dark:text-white font-bold">#ORD-381{{ $index }}</td>
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gray-100 dark:bg-slate-800 flex items-center justify-center text-[10px] font-bold dark:text-slate-400">JD</div>
                                    <span>John Doe</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider {{ $index % 2 == 0 ? 'bg-emerald-100 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400' : 'bg-amber-100 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400' }}">
                                    <span class="w-1.5 h-1.5 rounded-full mr-1.5 {{ $index % 2 == 0 ? 'bg-emerald-500' : 'bg-amber-500 animate-pulse' }}"></span>
                                    {{ $index % 2 == 0 ? 'Delivered' : 'In Transit' }}
                                </span>
                            </td>
                            <td class="py-4 px-6 font-bold text-secondary-900 dark:text-white">$240.00</td>
                            <td class="py-4 px-6 text-right">
                                <button class="w-8 h-8 rounded-lg bg-white dark:bg-slate-800 border border-gray-100 dark:border-slate-700 text-gray-400 dark:text-slate-500 flex items-center justify-center hover:bg-primary-600 hover:text-white hover:border-primary-600 transition shadow-sm">
                                    <i class="hgi-stroke hgi-eye text-lg"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Sidebar Components -->
        <div class="space-y-8">
            <!-- Analytics Summary -->
            <div class="bg-secondary-900 dark:bg-slate-900/50 rounded-3xl p-6 text-white overflow-hidden relative group shadow-xl border dark:border-slate-800">
                <div class="absolute -right-8 -bottom-8 w-40 h-40 bg-primary-600 rounded-full opacity-20 group-hover:scale-125 transition-transform duration-700"></div>
                <h3 class="text-xl font-bold mb-6 relative z-10">Sales Goal</h3>
                <div class="flex flex-col items-center gap-6 relative z-10">
                    <div class="relative w-32 h-32 flex items-center justify-center">
                        <svg class="w-full h-full transform -rotate-90">
                            <circle cx="64" cy="64" r="58" stroke="currentColor" stroke-width="8" fill="transparent" class="text-secondary-800 dark:text-slate-800" />
                            <circle cx="64" cy="64" r="58" stroke="currentColor" stroke-width="8" fill="transparent" stroke-dasharray="364" stroke-dashoffset="100" class="text-primary-500" />
                        </svg>
                        <span class="absolute text-2xl font-black">72%</span>
                    </div>
                    <div class="text-center">
                        <p class="text-secondary-400 dark:text-slate-500 text-sm font-medium">Monthly Target</p>
                        <h4 class="text-lg font-bold mt-1">$45,000 / $62,000</h4>
                    </div>
                    <button class="w-full py-3 bg-white/10 dark:bg-slate-800 hover:bg-white/20 rounded-xl font-bold text-sm transition">View Detailed Analytics</button>
                </div>
            </div>

            <!-- Top Products -->
            <div class="bg-white dark:bg-slate-900 rounded-3xl p-6 shadow-sm border border-gray-100 dark:border-slate-800">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter text-shadow-sm">Top Products</h3>
                    <i class="hgi-stroke hgi-more-horizontal text-gray-400"></i>
                </div>
                <div class="space-y-5">
                    @foreach(['Classic Burger', 'Spicy Noodles', 'Iced Latte'] as $product)
                    <div class="flex items-center gap-4 group cursor-pointer">
                        <div class="w-12 h-12 rounded-xl bg-gray-50 dark:bg-slate-800 border border-gray-100 dark:border-slate-700 flex items-center justify-center text-xl text-primary-600 group-hover:bg-primary-600 group-hover:text-white transition-colors duration-300">
                            <i class="hgi-stroke hgi-package"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-bold text-secondary-900 dark:text-slate-200">{{ $product }}</h4>
                            <p class="text-xs text-secondary-400 dark:text-slate-500 font-medium">2.4k Sales</p>
                        </div>
                        <span class="text-sm font-black text-secondary-900 dark:text-white">$12.90</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
