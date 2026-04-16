<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Order Management System')</title>
    <meta name="description"
        content="@yield('meta_description', 'Smart Order Management System — track inventory, manage customers, and fulfill orders from one unified dashboard.')">

    <!-- Prevent FOUC: apply theme before CSS loads -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
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
                        primary: tailwind.colors.amber,
                        secondary: tailwind.colors.slate,
                        accent: tailwind.colors.purple,
                    }
                }
            }
        }
    </script>

    <!-- Animate.css v4 — required base: animate__animated + animate__<name> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- HugeIcons -->
    <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css" />

    <!-- Google Font: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Smooth theme transitions for all elements */
        *,
        *::before,
        *::after {
            transition-property: background-color, border-color, color, fill, stroke, box-shadow;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 200ms;
        }

        /* Keep transform-only transitions snappy (hover effects etc.) */
        .transition-all,
        .transition-transform,
        [class*="hover:-translate"] {
            transition-property: all;
        }

        /* Scroll-reveal: hide until IntersectionObserver fires */
        [data-animate] {
            opacity: 0;
        }
    </style>

    @stack('styles')
</head>

<body
    class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased min-h-screen flex flex-col transition-colors duration-200">

    <!-- ── Header ──────────────────────────────────────────────────────── -->
    <header
        class="bg-primary-600 dark:bg-gray-900 border-b border-transparent dark:border-gray-800 sticky top-0 z-50 transition-colors duration-200 shadow-md backdrop-blur-sm">
        <div class="container mx-auto px-4 sm:px-6 py-2.5">
            <div class="flex justify-between items-center gap-4">

                <!-- Brand -->
                <a href="{{ url('/') }}" class="flex items-center gap-2 group whitespace-nowrap shrink-0">
                    <div
                        class="flex items-center justify-center w-8 h-8 rounded-full bg-white/20 group-hover:bg-white/30 transition-colors">
                        <i
                            class="hgi-stroke hgi-store-01 text-lg text-white group-hover:scale-110 transition-transform"></i>
                    </div>
                    <span class="text-base sm:text-lg font-bold text-white tracking-wide">
                        <span class="sm:hidden">OMS</span>
                        <span class="hidden sm:inline">Order Management System</span>
                    </span>
                </a>

                <!-- Desktop nav links -->
                <nav class="hidden md:flex items-center gap-6 text-sm font-medium text-primary-100 dark:text-gray-300">
                    <a href="#features" class="hover:text-white dark:hover:text-white transition-colors">Features</a>
                    <a href="#how-it-works" class="hover:text-white dark:hover:text-white transition-colors">How It
                        Works</a>
                    <a href="#pricing" class="hover:text-white dark:hover:text-white transition-colors">Pricing</a>
                </nav>

                <!-- Right actions -->
                <div class="flex items-center gap-2 sm:gap-3">
                    <button id="theme-toggle" type="button" aria-label="Toggle theme"
                        class="text-primary-100 dark:text-gray-400 hover:bg-primary-700 dark:hover:bg-gray-800 focus:outline-none rounded-full w-8 h-8 flex items-center justify-center transition-colors">
                        <i id="theme-toggle-dark-icon" class="hgi-stroke hgi-moon hidden text-base sm:text-lg"></i>
                        <i id="theme-toggle-light-icon" class="hgi-stroke hgi-sun-03 hidden text-base sm:text-lg"></i>
                    </button>

                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-3 py-1.5 bg-white/20 hover:bg-white/30 text-white font-semibold rounded-lg flex items-center gap-1.5 text-xs sm:text-sm transition-colors">
                            <i class="hgi-stroke hgi-dashboard-square-01 text-base"></i>
                            <span class="hidden sm:inline">Dashboard</span>
                        </a>
                    @else
                        <a href="{{ url('/login') }}"
                            class="text-primary-100 dark:text-gray-300 hover:text-white dark:hover:text-white transition font-medium text-xs sm:text-sm px-1 hidden sm:inline">Log
                            in</a>
                        <a href="{{ url('/register') }}"
                            class="px-3 py-1.5 bg-white dark:bg-primary-500 text-primary-600 dark:text-white font-bold rounded-lg hover:bg-primary-50 dark:hover:bg-primary-400 transition shadow-sm text-xs sm:text-sm whitespace-nowrap">
                            Get Started
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- ── Page content ────────────────────────────────────────────────── -->
    <main class="flex-grow flex flex-col">
        @yield('content')
    </main>

    <!-- ── Footer ──────────────────────────────────────────────────────── -->
    <footer class="bg-gray-900 dark:bg-gray-950 border-t border-gray-800 mt-auto">
        <div class="container mx-auto px-4 sm:px-6 py-4">

            <!-- Single compact row -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">

                <!-- Left: brand -->
                <div class="flex items-center gap-2 shrink-0">
                    <div class="w-6 h-6 rounded-full bg-primary-500/20 flex items-center justify-center">
                        <i class="hgi-stroke hgi-store-01 text-primary-400 text-xs"></i>
                    </div>
                    <span class="text-white text-xs font-bold tracking-wide">Order Management System</span>
                </div>

                <!-- Centre: quick links -->
                <nav class="flex items-center gap-4 text-[11px] text-gray-500 flex-wrap justify-center">
                    <a href="#features" class="hover:text-primary-400 transition-colors">Features</a>
                    <a href="#how-it-works" class="hover:text-primary-400 transition-colors">How It Works</a>
                    <a href="#pricing" class="hover:text-primary-400 transition-colors">Pricing</a>
                    <a href="#" class="hover:text-primary-400 transition-colors">Privacy</a>
                    <a href="#" class="hover:text-primary-400 transition-colors">Terms</a>
                </nav>

                <!-- Right: socials + copyright -->
                <div class="flex items-center gap-3 shrink-0">
                    <a href="#" aria-label="Twitter"
                        class="text-gray-500 hover:text-primary-400 transition-colors text-sm"><i
                            class="hgi-stroke hgi-twitter"></i></a>
                    <a href="#" aria-label="LinkedIn"
                        class="text-gray-500 hover:text-primary-400 transition-colors text-sm"><i
                            class="hgi-stroke hgi-linkedin-01"></i></a>
                    <a href="#" aria-label="GitHub"
                        class="text-gray-500 hover:text-primary-400 transition-colors text-sm"><i
                            class="hgi-stroke hgi-github"></i></a>
                    <span class="text-gray-700 select-none">·</span>
                    <p class="text-[11px] text-gray-600 whitespace-nowrap">&copy; 2026 OMS</p>
                </div>

            </div>
        </div>
    </footer>

    <!-- ── Scripts ─────────────────────────────────────────────────────── -->
    @stack('scripts')
    <script>
        // Theme toggle
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        var themeToggleBtn = document.getElementById('theme-toggle');

        (function () {
            var isDark = localStorage.getItem('color-theme') === 'dark' ||
                (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
            if (isDark) { themeToggleLightIcon.classList.remove('hidden'); }
            else { themeToggleDarkIcon.classList.remove('hidden'); }
        })();

        themeToggleBtn.addEventListener('click', function () {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        });
    </script>
</body>

</html>