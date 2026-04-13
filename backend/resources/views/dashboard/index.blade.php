@extends('layouts.dashboard')

@section('title', 'Admin Dashboard | Order Management System')

@section('content')
<div class="space-y-6">
    <!-- Header Page -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between animate__animated animate__fadeIn">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Overview Dashboard</h1>
            <p class="text-sm text-gray-500 mt-1">Welcome back, Admin. Here is what's happening with your store today.</p>
        </div>
        <div class="mt-4 md:mt-0 flex gap-3">
            <button class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-50 transition shadow-sm flex items-center gap-2">
                <i class="hgi-stroke hgi-calendar-03"></i> Last 30 Days
            </button>
            <button class="bg-primary-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-primary-700 transition shadow-sm flex items-center gap-2">
                <i class="hgi-stroke hgi-file-download"></i> Export Report
            </button>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Stat Card 1 -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center gap-4 animate__animated animate__fadeInUp animate__delay-1s">
            <div class="w-12 h-12 rounded-full bg-primary-50 text-primary-600 flex items-center justify-center text-2xl flex-shrink-0">
                <i class="hgi-stroke hgi-shopping-bag-01"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Orders</p>
                <h3 class="text-2xl font-bold text-gray-800">1,245</h3>
            </div>
        </div>
        <!-- Stat Card 2 -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center gap-4 animate__animated animate__fadeInUp animate__delay-1s" style="animation-delay: 0.1s">
            <div class="w-12 h-12 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl flex-shrink-0">
                <i class="hgi-stroke hgi-money-01"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Revenue</p>
                <h3 class="text-2xl font-bold text-gray-800">$45,231</h3>
            </div>
        </div>
        <!-- Stat Card 3 -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center gap-4 animate__animated animate__fadeInUp animate__delay-1s" style="animation-delay: 0.2s">
            <div class="w-12 h-12 rounded-full bg-accent-50 text-accent-600 flex items-center justify-center text-2xl flex-shrink-0">
                <i class="hgi-stroke hgi-user-multiple"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Active Customers</p>
                <h3 class="text-2xl font-bold text-gray-800">842</h3>
            </div>
        </div>
        <!-- Stat Card 4 -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center gap-4 animate__animated animate__fadeInUp animate__delay-1s" style="animation-delay: 0.3s">
            <div class="w-12 h-12 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center text-2xl flex-shrink-0">
                <i class="hgi-stroke hgi-time-02"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Pending Orders</p>
                <h3 class="text-2xl font-bold text-gray-800">38</h3>
            </div>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden animate__animated animate__fadeInUp animate__delay-1s" style="animation-delay: 0.4s">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-lg font-bold text-gray-800">Recent Orders</h2>
            <a href="#" class="text-sm font-medium text-primary-600 hover:text-primary-800">View All</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 text-sm">
                        <th class="py-3 px-6 font-medium">Order ID</th>
                        <th class="py-3 px-6 font-medium">Customer</th>
                        <th class="py-3 px-6 font-medium">Date</th>
                        <th class="py-3 px-6 font-medium">Status</th>
                        <th class="py-3 px-6 font-medium">Amount</th>
                        <th class="py-3 px-6 font-medium text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-4 px-6 font-medium">#ORD-001</td>
                        <td class="py-4 px-6">John Doe</td>
                        <td class="py-4 px-6 text-gray-500">Oct 24, 2026</td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                Pending
                            </span>
                        </td>
                        <td class="py-4 px-6 font-medium">$120.00</td>
                        <td class="py-4 px-6 text-right">
                            <button class="text-gray-400 hover:text-primary-600 transition"><i class="hgi-stroke hgi-more-horizontal"></i></button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-4 px-6 font-medium">#ORD-002</td>
                        <td class="py-4 px-6">Jane Smith</td>
                        <td class="py-4 px-6 text-gray-500">Oct 23, 2026</td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                Completed
                            </span>
                        </td>
                        <td class="py-4 px-6 font-medium">$340.50</td>
                        <td class="py-4 px-6 text-right">
                            <button class="text-gray-400 hover:text-primary-600 transition"><i class="hgi-stroke hgi-more-horizontal"></i></button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-4 px-6 font-medium">#ORD-003</td>
                        <td class="py-4 px-6">Michael Johnson</td>
                        <td class="py-4 px-6 text-gray-500">Oct 23, 2026</td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                Shipped
                            </span>
                        </td>
                        <td class="py-4 px-6 font-medium">$85.00</td>
                        <td class="py-4 px-6 text-right">
                            <button class="text-gray-400 hover:text-primary-600 transition"><i class="hgi-stroke hgi-more-horizontal"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
