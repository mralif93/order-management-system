<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $seller->store_name ?? $seller->name }} — Store</title>
    <meta name="description" content="{{ $seller->store_bio ?? 'Browse products from ' . ($seller->store_name ?? $seller->name) }}">

    <!-- Theme Logic (Prevent FOUC) -->
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
                            50:'#fffbeb',100:'#fef3c7',200:'#fde68a',300:'#fcd34d',
                            400:'#fbbf24',500:'#f59e0b',600:'#d97706',700:'#b45309',
                            800:'#92400e',900:'#78350f',950:'#451a03',
                        },
                        secondary: {
                            50:'#f8fafc',100:'#f1f5f9',200:'#e2e8f0',300:'#cbd5e1',
                            400:'#94a3b8',500:'#64748b',600:'#475569',700:'#334155',
                            800:'#1e293b',900:'#0f172a',950:'#020617',
                        }
                    },
                    fontFamily: { sans: ['Poppins', 'sans-serif'] }
                }
            }
        }
    </script>

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- HugeIcons -->
    <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css"/>
    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-gradient-to-br from-amber-50 via-white to-amber-50 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950 font-sans antialiased transition-colors duration-300">

    <!-- Sticky Nav -->
    <nav class="sticky top-0 z-50 bg-white/70 dark:bg-slate-900/70 backdrop-blur-xl border-b border-gray-100 dark:border-slate-800">
        <div class="max-w-2xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center gap-2 text-secondary-500 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 transition text-sm font-bold">
                <i class="hgi-stroke hgi-arrow-left-01 text-base"></i>
                <span class="hidden sm:inline">Back to OMS</span>
            </a>
            <span class="text-xs font-black uppercase tracking-widest text-secondary-400 dark:text-slate-500">/shop/{{ $seller->store_slug }}</span>
            <button id="theme-toggle" type="button"
                class="w-9 h-9 rounded-full bg-gray-100 dark:bg-slate-800 flex items-center justify-center text-secondary-500 dark:text-slate-400 hover:bg-primary-100 dark:hover:bg-slate-700 transition">
                <i id="icon-dark" class="hgi-stroke hgi-moon text-base hidden"></i>
                <i id="icon-light" class="hgi-stroke hgi-sun-03 text-base hidden"></i>
            </button>
        </div>
    </nav>

    <main class="max-w-2xl mx-auto px-4 py-12 space-y-8">

        <!-- Hero / Profile -->
        <section class="text-center space-y-4 animate__animated animate__fadeInDown">
            <div class="w-24 h-24 mx-auto rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center ring-4 ring-primary-200 dark:ring-primary-800 shadow-xl shadow-primary-200/30 dark:shadow-primary-900/30">
                <i class="hgi-stroke hgi-store-01 text-4xl text-primary-600 dark:text-primary-400"></i>
            </div>
            <div>
                <h1 class="text-3xl font-black text-secondary-900 dark:text-white tracking-tight">
                    {{ $seller->store_name ?? $seller->name }}
                </h1>
                @if($seller->store_bio)
                    <p class="mt-2 text-secondary-500 dark:text-slate-400 font-medium max-w-sm mx-auto leading-relaxed">
                        {{ $seller->store_bio }}
                    </p>
                @endif
            </div>
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-50 dark:bg-primary-900/20 border border-primary-100 dark:border-primary-800 text-primary-700 dark:text-primary-300 text-xs font-black uppercase tracking-widest">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-500"></span>
                </span>
                {{ $products->count() }} Product{{ $products->count() !== 1 ? 's' : '' }} Available
            </div>
        </section>

        <!-- Products -->
        @if($products->isNotEmpty())
            <section class="space-y-4 animate__animated animate__fadeInUp">
                <h2 class="text-xs font-black uppercase tracking-widest text-secondary-400 dark:text-slate-500 text-center">Featured Products</h2>
                @foreach($products as $product)
                    <div class="group bg-white dark:bg-slate-900 rounded-2xl border border-gray-100 dark:border-slate-800 shadow-sm hover:shadow-md hover:border-primary-200 dark:hover:border-primary-700 transition-all duration-200 overflow-hidden">
                        <div class="flex items-center gap-4 p-5">
                            {{-- Icon --}}
                            <div class="w-14 h-14 rounded-xl bg-primary-50 dark:bg-primary-900/20 flex items-center justify-center flex-shrink-0 group-hover:bg-primary-100 dark:group-hover:bg-primary-900/40 transition">
                                <i class="hgi-stroke hgi-package text-2xl text-primary-600 dark:text-primary-400"></i>
                            </div>
                            {{-- Info --}}
                            <div class="flex-1 min-w-0">
                                <h3 class="font-black text-secondary-900 dark:text-white text-base leading-tight truncate">{{ $product->name }}</h3>
                                <p class="text-xs text-secondary-400 dark:text-slate-500 font-mono mt-0.5">{{ $product->sku }}</p>
                                @if($product->description)
                                    <p class="text-xs text-secondary-500 dark:text-slate-400 mt-1 line-clamp-2 font-medium">{{ $product->description }}</p>
                                @endif
                            </div>
                            {{-- Price + Stock --}}
                            <div class="flex-shrink-0 text-right space-y-1.5">
                                <p class="font-black text-secondary-900 dark:text-white text-base">MYR {{ number_format($product->price, 2) }}</p>
                                @if($product->quantity > 10)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-black bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> In Stock
                                    </span>
                                @elseif($product->quantity > 0)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-black bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400 border border-amber-100 dark:border-amber-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Low Stock
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-black bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400 border border-red-100 dark:border-red-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Sold Out
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </section>
        @else
            <section class="text-center py-20 animate__animated animate__fadeIn">
                <div class="w-20 h-20 mx-auto rounded-full bg-gray-50 dark:bg-slate-800 flex items-center justify-center mb-4">
                    <i class="hgi-stroke hgi-package text-4xl text-gray-200 dark:text-slate-700"></i>
                </div>
                <h3 class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter">Nothing Here Yet</h3>
                <p class="text-secondary-400 dark:text-slate-500 text-sm font-medium mt-1">This store hasn't featured any products yet.</p>
            </section>
        @endif

        <!-- Footer -->
        <footer class="text-center pt-4 pb-2 text-xs text-secondary-300 dark:text-slate-700 font-medium">
            Powered by <a href="{{ url('/') }}" class="hover:text-primary-600 dark:hover:text-primary-400 transition font-bold">OMS</a>
        </footer>

    </main>

    <script>
        const btn = document.getElementById('theme-toggle');
        const iconDark = document.getElementById('icon-dark');
        const iconLight = document.getElementById('icon-light');

        function applyTheme() {
            const dark = document.documentElement.classList.contains('dark');
            iconDark.classList.toggle('hidden', dark);
            iconLight.classList.toggle('hidden', !dark);
        }
        applyTheme();

        btn.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
            applyTheme();
        });
    </script>
</body>
</html>

