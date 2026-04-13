@extends('layouts.public')

@section('title', 'Welcome | Order Management System')

@section('content')
<!-- Hero Section -->
<section class="relative snap-start scroll-mt-16 bg-white dark:bg-gray-900 overflow-hidden pt-12 sm:pt-16 lg:pt-24 pb-16 min-h-[calc(100vh-60px)] flex flex-col justify-center transition-colors duration-200">
    <div class="relative container mx-auto px-4 sm:px-6 z-10">
        <div class="max-w-4xl mx-auto text-center animate__animated animate__zoomIn">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-primary-50 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 font-medium text-sm mb-6 border border-primary-100 dark:border-primary-800 transition-colors">
                <span class="flex h-2 w-2 relative">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-500"></span>
                </span>
                Streamline Your Business Today
            </div>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 dark:text-white tracking-tight mb-6 leading-tight transition-colors">
                Smart <span class="text-primary-600 dark:text-primary-400">Order Management</span> Built For Growth
            </h1>
            
            <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 mb-10 max-w-2xl mx-auto leading-relaxed transition-colors">
                Take full control of your sales pipeline. Effortlessly track inventory, manage customer relationships, and fulfill orders all from one unified dashboard.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="{{ url('register') }}" class="w-full sm:w-auto px-8 py-3.5 bg-primary-600 dark:bg-primary-500 text-white rounded-xl font-bold shadow-lg shadow-primary-600/30 hover:bg-primary-700 dark:hover:bg-primary-600 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                    Get Started Free <i class="hgi-stroke hgi-arrow-right-01"></i>
                </a>
                <a href="#features" class="w-full sm:w-auto px-8 py-3.5 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 border border-gray-200 dark:border-gray-700 rounded-xl font-bold shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600 transition-all flex items-center justify-center gap-2">
                    <i class="hgi-stroke hgi-play-circle cursor-pointer"></i> View Demo
                </a>
            </div>

            <!-- Trust simple stats under hero -->
            <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 text-center">
                <div class="group bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] dark:shadow-none hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-10 h-10 mx-auto bg-primary-50 dark:bg-primary-900/40 text-primary-600 dark:text-primary-400 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <i class="hgi-stroke hgi-server text-xl"></i>
                    </div>
                    <h4 class="text-2xl md:text-3xl font-black text-gray-900 dark:text-white tracking-tight">99.9%</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 font-medium">Uptime SLA</p>
                </div>
                <div class="group bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] dark:shadow-none hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-10 h-10 mx-auto bg-primary-50 dark:bg-primary-900/40 text-primary-600 dark:text-primary-400 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <i class="hgi-stroke hgi-customer-support text-xl"></i>
                    </div>
                    <h4 class="text-2xl md:text-3xl font-black text-gray-900 dark:text-white tracking-tight">24/7</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 font-medium">Expert Support</p>
                </div>
                <div class="group bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] dark:shadow-none hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-10 h-10 mx-auto bg-primary-50 dark:bg-primary-900/40 text-primary-600 dark:text-primary-400 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <i class="hgi-stroke hgi-user-multiple text-xl"></i>
                    </div>
                    <h4 class="text-2xl md:text-3xl font-black text-gray-900 dark:text-white tracking-tight">5k+</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 font-medium">Active Users</p>
                </div>
                <div class="group bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] dark:shadow-none hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="w-10 h-10 mx-auto bg-primary-50 dark:bg-primary-900/40 text-primary-600 dark:text-primary-400 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                        <i class="hgi-stroke hgi-shield-check text-xl"></i>
                    </div>
                    <h4 class="text-2xl md:text-3xl font-black text-gray-900 dark:text-white tracking-tight">100%</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 font-medium">Secure Data</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="bg-gray-50 snap-start scroll-mt-16 dark:bg-gray-800 py-20 border-t border-gray-100 dark:border-gray-700 transition-colors duration-200 min-h-screen flex flex-col justify-center">
    <div class="container mx-auto px-4 sm:px-6">
        <div class="text-center max-w-3xl mx-auto mb-16 px-4 animate__animated animate__fadeInUp">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4 transition-colors">Everything You Need to Succeed</h2>
            <p class="text-gray-600 dark:text-gray-400 text-lg transition-colors">Powerful features wrapped in an intuitive, accessible interface designed to save you hours every week.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all group animate__animated animate__fadeInUp animate__delay-1s">
                <div class="w-14 h-14 bg-primary-50 dark:bg-primary-900/30 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-primary-100 dark:group-hover:bg-primary-900/50 transition-all">
                    <i class="hgi-stroke hgi-shopping-cart-01 text-2xl text-primary-600 dark:text-primary-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Order Tracking</h3>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                    Monitor every purchase from checkout to delivery with real-time status updates and automated notifications.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all group animate__animated animate__fadeInUp animate__delay-1s" style="animation-delay: 0.1s;">
                <div class="w-14 h-14 bg-accent-50 dark:bg-accent-900/30 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-accent-100 dark:group-hover:bg-accent-900/50 transition-all">
                    <i class="hgi-stroke hgi-user-multiple text-2xl text-accent-600 dark:text-accent-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Customer CRM</h3>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                    Build loyalty with detailed customer profiles, purchase histories, and targeted promotional capabilities.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-md transition-all group animate__animated animate__fadeInUp animate__delay-1s" style="animation-delay: 0.2s;">
                <div class="w-14 h-14 bg-emerald-50 dark:bg-emerald-900/30 rounded-full flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-emerald-100 dark:group-hover:bg-emerald-900/50 transition-all">
                    <i class="hgi-stroke hgi-dashboard-square-01 text-2xl text-emerald-600 dark:text-emerald-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Rich Analytics</h3>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                    Make data-driven decisions using our comprehensive dashboard packed with actionable sales insights and trends.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="bg-white snap-start scroll-mt-16 dark:bg-gray-900 py-16 relative text-center transition-colors duration-200 min-h-[calc(100vh-100px)] flex flex-col justify-center border-t border-gray-100 dark:border-gray-800">
    <div class="container mx-auto px-4 sm:px-6 relative z-10 animate__animated animate__fadeInUp">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4 transition-colors">Ready to Transform Your Workflow?</h2>
        <p class="text-gray-600 dark:text-gray-400 mb-8 max-w-2xl mx-auto transition-colors">Join thousands of businesses managing their operations efficiently with Order Management System.</p>
        <a href="{{ url('register') }}" class="inline-flex px-8 py-3.5 bg-primary-600 text-white rounded-xl font-bold shadow-lg shadow-primary-600/30 hover:bg-primary-700 hover:-translate-y-0.5 transition-all items-center justify-center gap-2">
            Create Free Account
        </a>
    </div>
</section>
@endsection