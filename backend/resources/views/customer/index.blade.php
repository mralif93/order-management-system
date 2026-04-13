@extends('layouts.customer')

@section('title', 'My Dashboard | Order Management System')

@section('content')
<div class="space-y-6 max-w-6xl mx-auto">
    <!-- Header Page -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between animate__animated animate__fadeIn">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">My Account</h1>
            <p class="text-sm text-gray-500 mt-1">Welcome back, Customer. Track your orders and manage your profile.</p>
        </div>
        <div class="mt-4 md:mt-0 flex gap-3">
            <button class="bg-primary-600 text-white px-5 py-2.5 rounded-lg font-medium hover:bg-primary-700 transition shadow-sm flex items-center gap-2">
                <i class="hgi-stroke hgi-plus"></i> Place New Order
            </button>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Stat Card 1 -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center gap-4 animate__animated animate__fadeInUp animate__delay-1s">
            <div class="w-12 h-12 rounded-full bg-primary-50 text-primary-600 flex items-center justify-center text-2xl flex-shrink-0">
                <i class="hgi-stroke hgi-shopping-cart-01"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Orders</p>
                <h3 class="text-2xl font-bold text-gray-800">24</h3>
            </div>
        </div>
        <!-- Stat Card 2 -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center gap-4 animate__animated animate__fadeInUp animate__delay-1s" style="animation-delay: 0.1s">
            <div class="w-12 h-12 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center text-2xl flex-shrink-0">
                <i class="hgi-stroke hgi-time-02"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Pending Orders</p>
                <h3 class="text-2xl font-bold text-gray-800">2</h3>
            </div>
        </div>
        <!-- Stat Card 3 -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center gap-4 animate__animated animate__fadeInUp animate__delay-1s" style="animation-delay: 0.2s">
            <div class="w-12 h-12 rounded-full bg-accent-50 text-accent-600 flex items-center justify-center text-2xl flex-shrink-0">
                <i class="hgi-stroke hgi-star-circle"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Reward Points</p>
                <h3 class="text-2xl font-bold text-gray-800">450</h3>
            </div>
        </div>
    </div>

    <!-- Recent Orders & Profile Overview Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Recent Orders Table -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden animate__animated animate__fadeInUp animate__delay-1s" style="animation-delay: 0.3s">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-lg font-bold text-gray-800">Recent Orders</h2>
                <a href="#" class="text-sm font-medium text-primary-600 hover:text-primary-800">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-600 text-sm">
                            <th class="py-3 px-6 font-medium">Order ID</th>
                            <th class="py-3 px-6 font-medium">Date</th>
                            <th class="py-3 px-6 font-medium">Status</th>
                            <th class="py-3 px-6 font-medium">Total</th>
                            <th class="py-3 px-6 font-medium text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 px-6 font-medium">#ORD-892</td>
                            <td class="py-4 px-6 text-gray-500">Oct 24, 2026</td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                    Processing
                                </span>
                            </td>
                            <td class="py-4 px-6 font-medium">$45.00</td>
                            <td class="py-4 px-6 text-right">
                                <button class="text-primary-600 hover:text-primary-800 font-medium text-xs">Details</button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 px-6 font-medium">#ORD-865</td>
                            <td class="py-4 px-6 text-gray-500">Oct 15, 2026</td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                    Delivered
                                </span>
                            </td>
                            <td class="py-4 px-6 font-medium">$120.50</td>
                            <td class="py-4 px-6 text-right">
                                <button class="text-primary-600 hover:text-primary-800 font-medium text-xs">Details</button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 px-6 font-medium">#ORD-831</td>
                            <td class="py-4 px-6 text-gray-500">Sep 28, 2026</td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                    Delivered
                                </span>
                            </td>
                            <td class="py-4 px-6 font-medium">$89.00</td>
                            <td class="py-4 px-6 text-right">
                                <button class="text-primary-600 hover:text-primary-800 font-medium text-xs">Details</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Profile Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 animate__animated animate__fadeInUp animate__delay-1s" style="animation-delay: 0.4s">
            <h2 class="text-lg font-bold text-gray-800 mb-6">Profile Details</h2>
            <div class="flex items-center gap-4 mb-6">
                <div class="w-16 h-16 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center text-3xl font-bold flex-shrink-0">
                    JD
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">John Doe</h3>
                    <p class="text-sm text-gray-500">Customer Member</p>
                </div>
            </div>
            
            <div class="space-y-4">
                <div class="flex items-center gap-3 text-sm text-gray-600">
                    <i class="hgi-stroke hgi-mail-01 text-gray-400 text-lg"></i>
                    john.doe@example.com
                </div>
                <div class="flex items-center gap-3 text-sm text-gray-600">
                    <i class="hgi-stroke hgi-smart-phone-01 text-gray-400 text-lg"></i>
                    +1 234 567 890
                </div>
                <div class="flex items-center gap-3 text-sm text-gray-600">
                    <i class="hgi-stroke hgi-location-01 text-gray-400 text-lg"></i>
                    New York, USA
                </div>
            </div>

            <div class="mt-8 pt-4 border-t border-gray-100">
                <button class="w-full py-2.5 bg-gray-50 hover:bg-gray-100 text-gray-700 rounded-lg font-medium transition text-sm flex items-center justify-center gap-2">
                    <i class="hgi-stroke hgi-setting-01"></i> Edit Profile
                </button>
            </div>
        </div>

    </div>
</div>
@endsection
