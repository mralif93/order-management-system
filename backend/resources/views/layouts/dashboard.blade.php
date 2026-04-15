<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard | OMS')</title>

    <!-- Theme Logic (Prevent flash) -->
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f',
                            950: '#451a03',
                        },
                        secondary: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                            950: '#020617',
                        }
                    },
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- HugeIcons -->
    <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css" />

    <!-- Google Font: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')

    <style>
        [x-cloak] { display: none !important; }
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
    </style>
</head>
<body 
    class="bg-gray-50 dark:bg-slate-950 text-secondary-900 dark:text-slate-100 font-sans h-full overflow-hidden transition-colors duration-300" 
    x-data="{ 
        sidebarOpen: true, 
        mobileMenu: false, 
        darkMode: localStorage.getItem('theme') === 'dark',
        toggleTheme() {
            this.darkMode = !this.darkMode;
            if (this.darkMode) {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            }
        }
    }"
>

    <div class="flex h-full overflow-hidden">
        
        <!-- Sidebar -->
        <aside 
            class="bg-secondary-900 text-white flex-shrink-0 transition-all duration-300 ease-in-out flex flex-col z-40 fixed lg:relative h-full"
            :class="{ 'w-64': sidebarOpen, 'w-20': !sidebarOpen, '-translate-x-full lg:translate-x-0': !mobileMenu }"
        >
            <!-- Logo area -->
            <div class="h-16 flex items-center px-6 border-b border-secondary-800 flex-shrink-0">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-primary-600 flex items-center justify-center text-white">
                        <i class="hgi-stroke hgi-delivery-truck-02 text-xl"></i>
                    </div>
                    <span class="font-bold text-xl tracking-tight transition-opacity duration-300" :class="{ 'opacity-100': sidebarOpen, 'opacity-0 lg:hidden': !sidebarOpen }">OMS Admin</span>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto sidebar-scroll py-6 px-3 space-y-1">
                <div class="text-secondary-500 text-[10px] uppercase font-bold tracking-wider px-3 mb-2" :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }">Main</div>
                
                <a href="{{ route('dashboard.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('dashboard.index') ? 'bg-primary-600 text-white' : 'hover:bg-secondary-800 text-secondary-400 hover:text-white' }}">
                    <i class="hgi-stroke hgi-dashboard-square-01 text-xl"></i>
                    <span :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }">Dashboard</span>
                </a>

                <div class="pt-4 text-secondary-500 text-[10px] uppercase font-bold tracking-wider px-3 mb-2" :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }">Management</div>

                <a href="{{ route('orders.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('orders.*') ? 'bg-primary-600 text-white' : 'hover:bg-secondary-800 text-secondary-400 hover:text-white' }}">
                    <i class="hgi-stroke hgi-shopping-cart-01 text-xl"></i>
                    <span :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }">Orders</span>
                </a>

                <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('products.*') ? 'bg-primary-600 text-white' : 'hover:bg-secondary-800 text-secondary-400 hover:text-white' }}">
                    <i class="hgi-stroke hgi-package text-xl"></i>
                    <span :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }">Products</span>
                </a>

                <a href="{{ route('customers.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->routeIs('customers.*') ? 'bg-primary-600 text-white' : 'hover:bg-secondary-800 text-secondary-400 hover:text-white' }}">
                    <i class="hgi-stroke hgi-user-multiple text-xl"></i>
                    <span :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }">Customers</span>
                </a>

                <div class="pt-4 text-secondary-500 text-[10px] uppercase font-bold tracking-wider px-3 mb-2" :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }">System</div>

                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition hover:bg-secondary-800 text-secondary-400 hover:text-white">
                    <i class="hgi-stroke hgi-settings-01 text-xl"></i>
                    <span :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }">Settings</span>
                </a>
            </nav>

            <!-- Sidebar Footer -->
            <div class="p-4 border-t border-secondary-800">
                <button 
                    @click="sidebarOpen = !sidebarOpen"
                    class="w-full flex items-center justify-center p-2 rounded-lg bg-secondary-800 hover:bg-secondary-700 text-secondary-400 transition"
                >
                    <i class="hgi-stroke" :class="sidebarOpen ? 'hgi-sidebar-left-01' : 'hgi-sidebar-right-01'"></i>
                </button>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-w-0">
            
            <!-- Top Header -->
            <header class="h-16 bg-white dark:bg-slate-900 border-b border-gray-200 dark:border-slate-800 flex items-center justify-between px-6 flex-shrink-0 z-30 transition-colors">
                <div class="flex items-center gap-4">
                    <button @click="mobileMenu = !mobileMenu" class="lg:hidden p-2 text-gray-500 dark:text-slate-400 hover:bg-gray-100 dark:hover:bg-slate-800 rounded-lg">
                        <i class="hgi-stroke hgi-menu-01"></i>
                    </button>
                    
                    <!-- Search Box -->
                    <div class="hidden md:flex items-center bg-gray-100 dark:bg-slate-800 rounded-lg px-3 py-1.5 w-64 lg:w-96">
                        <i class="hgi-stroke hgi-search-01 text-gray-400 dark:text-slate-500 mr-2"></i>
                        <input type="text" placeholder="Search orders, customers..." class="bg-transparent border-none focus:ring-0 text-sm w-full outline-none dark:text-slate-200">
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <!-- Theme Toggle -->
                    <button 
                        @click="toggleTheme()" 
                        class="p-2 text-gray-500 dark:text-slate-400 hover:bg-gray-100 dark:hover:bg-slate-800 rounded-lg transition"
                    >
                        <i class="hgi-stroke" :class="darkMode ? 'hgi-sun-01' : 'hgi-moon-02'"></i>
                    </button>

                    <!-- Notifications -->
                    <button class="relative p-2 text-gray-500 dark:text-slate-400 hover:bg-gray-100 dark:hover:bg-slate-800 rounded-lg transition">
                        <i class="hgi-stroke hgi-notification-03"></i>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full border-2 border-white dark:border-slate-900"></span>
                    </button>

                    <div class="h-8 w-px bg-gray-200 dark:bg-slate-800 mx-2 hidden sm:block"></div>

                    <!-- User Profile -->
                    <div class="relative" x-data="{ profileOpen: false }" @click.away="profileOpen = false">
                        <button @click="profileOpen = !profileOpen" class="flex items-center gap-2 hover:bg-gray-50 dark:hover:bg-slate-800 p-1.5 rounded-lg transition">
                            <div class="w-8 h-8 rounded-full bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 flex items-center justify-center font-bold text-xs">AD</div>
                            <div class="hidden sm:block text-left">
                                <p class="text-xs font-bold text-gray-800 dark:text-slate-200 leading-none">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] text-gray-500 dark:text-slate-400 mt-1">Administrator</p>
                            </div>
                            <i class="hgi-stroke hgi-arrow-down-01 text-gray-400 text-xs transition-transform" :class="{ 'rotate-180': profileOpen }"></i>
                        </button>

                        <div 
                            x-show="profileOpen" 
                            x-cloak
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-900 rounded-xl shadow-xl border border-gray-100 dark:border-slate-800 py-2 z-50 animate__animated animate__fadeInUp animate__faster"
                        >
                            <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-800">
                                <i class="hgi-stroke hgi-user-circle"></i> My Profile
                            </a>
                            <a href="#" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-slate-300 hover:bg-gray-50 dark:hover:bg-slate-800 border-b border-gray-50 dark:border-slate-800">
                                <i class="hgi-stroke hgi-setting-01"></i> Settings
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20">
                                    <i class="hgi-stroke hgi-logout-01"></i> Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- View Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50 dark:bg-slate-950 p-6 sm:p-8 transition-colors">
                @yield('content')
            </main>
        </div>

        <!-- Mobile Overlay -->
        <div 
            x-show="mobileMenu" 
            x-cloak
            @click="mobileMenu = false"
            class="fixed inset-0 bg-secondary-900/50 dark:bg-black/70 z-30 lg:hidden backdrop-blur-sm transition-opacity"
        ></div>
    </div>

    @stack('scripts')
</body>
</html>