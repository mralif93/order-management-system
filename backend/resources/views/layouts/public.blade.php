<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Order Management System')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: tailwind.colors.amber,
                        secondary: tailwind.colors.slate,
                        accent: tailwind.colors.purple,
                    }
                }
            }
        }
    </script>
    <script>
        // Check local storage for theme early to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- HugeIcons -->
    <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css" />

    <!-- Google Font: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <!-- Custom CSS -->
    @stack('styles')
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased min-h-screen flex flex-col transition-colors duration-200">
    <!-- Header -->
    <header class="bg-primary-600 dark:bg-gray-900 border-b border-transparent dark:border-gray-800 sticky top-0 z-50 transition-colors duration-200 shadow-sm">
        <div class="container mx-auto px-4 sm:px-6 py-2 sm:py-2.5">
            <div class="flex justify-between items-center">
                <a href="{{ url('/') }}" class="flex items-center gap-2 group whitespace-nowrap">
                    <div class="flex items-center justify-center w-8 h-8 rounded-full bg-white/20 group-hover:bg-white/30 transition-colors shrink-0">
                        <i class="hgi-stroke hgi-store-01 text-lg text-white group-hover:scale-110 transition-transform"></i>
                    </div>
                    <span class="text-base sm:text-lg font-bold text-white tracking-wide transition-colors">
                        <span class="sm:hidden">OMS</span>
                        <span class="hidden sm:inline">Order Management System</span>
                    </span>
                </a>
                
                <nav class="flex items-center gap-2 sm:gap-6">
                    <div class="flex items-center gap-1.5 sm:gap-3">
                        <button id="theme-toggle" type="button" class="text-primary-100 dark:text-gray-400 hover:bg-primary-700 dark:hover:bg-gray-800 focus:outline-none rounded-full w-7 h-7 sm:w-8 sm:h-8 flex items-center justify-center transition-colors">
                            <i id="theme-toggle-dark-icon" class="hgi-stroke hgi-moon hidden text-base sm:text-lg"></i>
                            <i id="theme-toggle-light-icon" class="hgi-stroke hgi-sun-03 hidden text-base sm:text-lg"></i>
                        </button>
                        
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-2 py-1.5 sm:px-3 sm:py-1.5 bg-primary-500 dark:bg-primary-900/50 text-white dark:text-primary-400 font-medium rounded hover:bg-primary-400 dark:hover:bg-primary-900 transition flex items-center gap-1 text-xs sm:text-sm">
                                <i class="hgi-stroke hgi-dashboard-square-01"></i> <span class="hidden sm:inline">Dashboard</span>
                            </a>
                        @else
                            <a href="{{ url('/login') }}" class="text-primary-100 dark:text-gray-300 hover:text-white dark:hover:text-primary-400 transition font-medium text-[11px] sm:text-sm px-1">Log in</a>
                            <a href="{{ url('/register') }}" class="px-2.5 py-1.5 sm:px-4 sm:py-1.5 bg-white text-primary-600 font-bold rounded hover:bg-primary-50 transition shadow-sm text-[11px] sm:text-sm">Sign up</a>
                        @endauth
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <!-- Content -->
    <main class="flex-grow flex flex-col">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-primary-600 dark:bg-gray-900 text-white dark:text-gray-400 py-2 sm:py-3 border-t border-transparent dark:border-gray-800 mt-auto transition-colors duration-200">
        <div class="container mx-auto px-4 sm:px-6 flex flex-row justify-between items-center text-[10px] sm:text-xs">
            <div class="flex items-center gap-1.5 opacity-90">
                <i class="hgi-stroke hgi-store text-base text-white dark:text-primary-500"></i>
                <span class="font-semibold text-white dark:text-gray-300">OMS</span>
            </div>
            <p class="text-center flex-1 mx-2 text-primary-100 dark:text-gray-400">&copy; 2026 Order Management System. <span class="hidden sm:inline">All rights reserved.</span></p>
            <div class="flex gap-2.5 text-sm sm:text-base">
                <a href="#" class="hover:text-primary-200 dark:hover:text-white transition"><i class="hgi-stroke hgi-twitter"></i></a>
                <a href="#" class="hover:text-primary-200 dark:hover:text-white transition"><i class="hgi-stroke hgi-linkedin-01"></i></a>
                <a href="#" class="hover:text-primary-200 dark:hover:text-white transition"><i class="hgi-stroke hgi-github"></i></a>
            </div>
        </div>
    </footer>

    <!-- Custom JavaScripts -->
    @stack('scripts')
    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        });
    </script>
</body>
</html>