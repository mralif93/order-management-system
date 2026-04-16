<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $seller->store_name ?? $seller->name }} — Shop</title>
    <meta name="description" content="{{ $seller->store_bio ?? 'Shop at ' . ($seller->store_name ?? $seller->name) }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Theme (Prevent FOUC) -->
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else { document.documentElement.classList.remove('dark'); }
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: { 50: '#fffbeb', 100: '#fef3c7', 200: '#fde68a', 300: '#fcd34d', 400: '#fbbf24', 500: '#f59e0b', 600: '#d97706', 700: '#b45309', 800: '#92400e', 900: '#78350f', 950: '#451a03' },
                        secondary: { 50: '#f8fafc', 100: '#f1f5f9', 200: '#e2e8f0', 300: '#cbd5e1', 400: '#94a3b8', 500: '#64748b', 600: '#475569', 700: '#334155', 800: '#1e293b', 900: '#0f172a', 950: '#020617' }
                    },
                    fontFamily: { sans: ['Poppins', 'sans-serif'] }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        .qty-btn {
            width: 2rem;
            height: 2rem;
            border-radius: 0.5rem;
            font-weight: 800;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .15s;
        }

        .cart-item-enter {
            animation: fadeInUp .2s ease forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(8px)
            }

            to {
                opacity: 1;
                transform: none
            }
        }

        .screen {
            transition: opacity .2s ease;
        }
    </style>
</head>

<body
    class="min-h-screen bg-gradient-to-br from-amber-50 via-white to-amber-50 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950 font-sans antialiased pb-28">

    {{-- ═══════════════════════════════════════════════════════════════
    GLOBAL NAV — always visible, adapts label based on active screen
    ══════════════════════════════════════════════════════════════════ --}}
    <nav
        class="sticky top-0 z-50 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl border-b border-gray-100 dark:border-slate-800 shadow-sm">
        <div class="max-w-lg mx-auto px-4 h-14 flex items-center justify-between gap-3">

            {{-- Left: back / store slug --}}
            <button id="nav-back" onclick="goBack()"
                class="flex items-center gap-1.5 text-secondary-500 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 transition text-sm font-bold min-w-0 flex-shrink-0">
                <i class="hgi-stroke hgi-arrow-left-01 text-base flex-shrink-0"></i>
                <span id="nav-back-label" class="hidden sm:inline truncate">Back to OMS</span>
            </button>

            {{-- Center: store identity --}}
            <div class="flex-1 min-w-0 text-center">
                <p class="text-sm font-black text-secondary-900 dark:text-white truncate leading-tight">
                    {{ $seller->store_name ?? $seller->name }}
                </p>
                <p
                    class="text-[10px] font-bold text-secondary-400 dark:text-slate-500 tracking-widest uppercase hidden sm:block">
                    /shop/{{ $seller->store_slug }}</p>
            </div>

            {{-- Right: cart icon + theme toggle --}}
            <div class="flex items-center gap-2 flex-shrink-0">
                <button id="cart-nav-btn" onclick="goCheckout()"
                    class="relative w-9 h-9 rounded-full bg-primary-500 flex items-center justify-center text-white shadow-md shadow-primary-500/30 hover:bg-primary-600 transition hidden">
                    <i class="hgi-stroke hgi-shopping-cart-01 text-base"></i>
                    <span id="cart-nav-count"
                        class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-red-500 text-white text-[9px] font-black flex items-center justify-center">0</span>
                </button>
                <button id="theme-toggle" type="button"
                    class="w-9 h-9 rounded-full bg-gray-100 dark:bg-slate-800 flex items-center justify-center text-secondary-500 dark:text-slate-400 hover:bg-primary-100 dark:hover:bg-slate-700 transition">
                    <i id="icon-dark" class="hgi-stroke hgi-moon text-base hidden"></i>
                    <i id="icon-light" class="hgi-stroke hgi-sun-03 text-base hidden"></i>
                </button>
            </div>
        </div>
    </nav>

    {{-- ═══════════════════════════════════════════════════════════════
    SCREEN 1 — STORE (product listing)
    ══════════════════════════════════════════════════════════════════ --}}
    <div id="screen-store" class="screen max-w-lg mx-auto px-4 py-8 space-y-8">

        {{-- Hero --}}
        <section class="text-center space-y-3 animate__animated animate__fadeInDown">
            <div
                class="w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-primary-400 to-primary-600 flex items-center justify-center shadow-xl shadow-primary-500/30">
                <i class="hgi-stroke hgi-store-01 text-4xl text-white"></i>
            </div>
            <div>
                <h1 class="text-2xl font-black text-secondary-900 dark:text-white tracking-tight leading-tight">
                    {{ $seller->store_name ?? $seller->name }}
                </h1>
                @if($seller->store_bio)
                    <p
                        class="mt-1.5 text-sm text-secondary-500 dark:text-slate-400 font-medium max-w-xs mx-auto leading-relaxed">
                        {{ $seller->store_bio }}
                    </p>
                @endif
            </div>
            <div
                class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-50 dark:bg-primary-900/20 border border-primary-100 dark:border-primary-800 text-primary-700 dark:text-primary-300 text-xs font-black uppercase tracking-widest">
                <span class="flex h-2 w-2 relative">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-500"></span>
                </span>
                {{ $products->count() }} Product{{ $products->count() !== 1 ? 's' : '' }} Available
            </div>
        </section>

        {{-- Product list --}}
        @if($products->isNotEmpty())
            <section class="space-y-3 animate__animated animate__fadeInUp">
                <h2 class="text-xs font-black uppercase tracking-widest text-secondary-400 dark:text-slate-500 text-center">
                    Available Products</h2>
                @foreach($products as $product)
                    @php $soldOut = $product->quantity <= 0; @endphp
                    <div
                        class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-100 dark:border-slate-800 shadow-sm overflow-hidden transition-all duration-200 hover:shadow-md hover:border-primary-200 dark:hover:border-primary-700">
                        <div class="flex items-start gap-4 p-4">
                            {{-- Product icon --}}
                            <div
                                class="w-14 h-14 rounded-xl bg-primary-50 dark:bg-primary-900/20 flex items-center justify-center flex-shrink-0">
                                <i class="hgi-stroke hgi-package text-2xl text-primary-500 dark:text-primary-400"></i>
                            </div>
                            {{-- Info --}}
                            <div class="flex-1 min-w-0">
                                <h3 class="font-black text-secondary-900 dark:text-white text-sm leading-snug">
                                    {{ $product->name }}</h3>
                                <p class="text-[10px] text-secondary-400 dark:text-slate-500 font-mono mt-0.5">
                                    {{ $product->sku }}</p>
                                @if($product->description)
                                    <p class="text-xs text-secondary-500 dark:text-slate-400 mt-1 line-clamp-2 leading-relaxed">
                                        {{ $product->description }}</p>
                                @endif
                            </div>
                            {{-- Price + stock --}}
                            <div class="flex-shrink-0 text-right space-y-1.5">
                                <p class="font-black text-secondary-900 dark:text-white text-base">MYR
                                    {{ number_format($product->price, 2) }}</p>
                                @if($product->quantity > 10)
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-black bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block"></span> In Stock
                                    </span>
                                @elseif($product->quantity > 0)
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-black bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400 border border-amber-100 dark:border-amber-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 inline-block"></span> Low Stock
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-black bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 border border-red-100 dark:border-red-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500 inline-block"></span> Sold Out
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- Add to Cart / Qty Controls --}}
                        <div class="border-t border-gray-50 dark:border-slate-800 px-4 py-3" id="cart-ctrl-{{ $product->id }}">
                            @if(!$soldOut)
                                <button onclick="addToCart({{ $product->id }})" id="btn-add-{{ $product->id }}"
                                    class="w-full py-2.5 rounded-xl bg-primary-500 hover:bg-primary-600 active:scale-[.98] text-white text-xs font-black uppercase tracking-widest transition-all shadow-sm shadow-primary-500/20">
                                    <i class="hgi-stroke hgi-shopping-cart-add text-sm mr-1"></i> Add to Cart
                                </button>
                                <div id="qty-ctrl-{{ $product->id }}" class="items-center justify-between" style="display:none">
                                    <button onclick="decreaseQty({{ $product->id }})"
                                        class="qty-btn bg-gray-100 dark:bg-slate-800 text-secondary-600 dark:text-slate-300 hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-500">
                                        <i class="hgi-stroke hgi-minus-sign text-sm"></i>
                                    </button>
                                    <div class="flex-1 text-center">
                                        <span id="qty-display-{{ $product->id }}"
                                            class="text-base font-black text-secondary-900 dark:text-white">1</span>
                                        <span class="text-xs text-secondary-400 dark:text-slate-500 font-medium ml-1">in cart</span>
                                    </div>
                                    <button onclick="increaseQty({{ $product->id }}, {{ $product->quantity }})"
                                        class="qty-btn bg-primary-500 text-white hover:bg-primary-600">
                                        <i class="hgi-stroke hgi-plus-sign text-sm"></i>
                                    </button>
                                </div>
                            @else
                                <button disabled
                                    class="w-full py-2.5 rounded-xl bg-gray-100 dark:bg-slate-800 text-secondary-400 dark:text-slate-600 text-xs font-black uppercase tracking-widest cursor-not-allowed">
                                    Sold Out
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </section>
        @else
            <section class="text-center py-20 animate__animated animate__fadeIn">
                <div
                    class="w-20 h-20 mx-auto rounded-2xl bg-gray-50 dark:bg-slate-800 flex items-center justify-center mb-4">
                    <i class="hgi-stroke hgi-package text-4xl text-gray-200 dark:text-slate-700"></i>
                </div>
                <h3 class="text-base font-black text-secondary-900 dark:text-white uppercase tracking-tighter">Nothing Here
                    Yet</h3>
                <p class="text-secondary-400 dark:text-slate-500 text-sm font-medium mt-1">This store hasn't listed any
                    products yet.</p>
            </section>
        @endif

        <footer class="text-center pt-2 pb-4 text-xs text-secondary-300 dark:text-slate-700 font-medium">
            Powered by <a href="{{ url('/') }}"
                class="hover:text-primary-600 dark:hover:text-primary-400 transition font-bold">OMS</a>
        </footer>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════
    SCREEN 2 — CHECKOUT
    ══════════════════════════════════════════════════════════════════ --}}
    <div id="screen-checkout"
        class="hidden screen max-w-lg mx-auto px-4 py-6 space-y-5 animate__animated animate__fadeIn">

        {{-- Order Summary --}}
        <div
            class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-100 dark:border-slate-800 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-50 dark:border-slate-800 flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-primary-50 dark:bg-primary-900/20 flex items-center justify-center">
                    <i class="hgi-stroke hgi-shopping-cart-01 text-base text-primary-600 dark:text-primary-400"></i>
                </div>
                <h2 class="font-black text-secondary-900 dark:text-white text-sm uppercase tracking-wider">Order Summary
                </h2>
            </div>
            <div id="checkout-items" class="divide-y divide-gray-50 dark:divide-slate-800"></div>
            <div class="px-5 py-3 flex items-center justify-between border-t border-gray-100 dark:border-slate-800">
                <span class="text-xs font-bold text-secondary-500 dark:text-slate-400">Subtotal</span>
                <span id="checkout-subtotal" class="text-sm font-bold text-secondary-700 dark:text-slate-300">MYR 0.00</span>
            </div>
            <div class="px-5 py-3 flex items-center justify-between">
                <span class="text-xs font-bold text-secondary-500 dark:text-slate-400">Delivery Fee</span>
                <span id="checkout-delivery" class="text-sm font-bold text-secondary-700 dark:text-slate-300">
                    {{ ($seller->delivery_fee ?? 0) > 0 ? 'MYR ' . number_format($seller->delivery_fee, 2) : 'Free' }}
                </span>
            </div>
            <div class="px-5 py-4 bg-primary-50 dark:bg-primary-900/10 flex items-center justify-between">
                <span
                    class="text-sm font-black text-secondary-700 dark:text-slate-300 uppercase tracking-wider">Total</span>
                <span id="checkout-total" class="text-lg font-black text-primary-600 dark:text-primary-400">MYR
                    0.00</span>
            </div>
        </div>

        {{-- Customer Details --}}
        <div
            class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-100 dark:border-slate-800 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-50 dark:border-slate-800 flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-secondary-50 dark:bg-slate-800 flex items-center justify-center">
                    <i class="hgi-stroke hgi-user-circle text-base text-secondary-500 dark:text-slate-400"></i>
                </div>
                <h2 class="font-black text-secondary-900 dark:text-white text-sm uppercase tracking-wider">Your Details
                </h2>
            </div>

            @auth('customer')
            {{-- ── LOGGED-IN CUSTOMER ──────────────────────────────────────────── --}}
            <div class="p-5 space-y-4">
                {{-- Logged-in profile row --}}
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800">
                    <div class="w-9 h-9 rounded-full bg-emerald-100 dark:bg-emerald-800 flex items-center justify-center shrink-0">
                        <i class="hgi-stroke hgi-user-check text-emerald-600 dark:text-emerald-300 text-lg"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-black text-secondary-900 dark:text-white truncate">{{ auth('customer')->user()->name }}</p>
                        <p class="text-xs text-emerald-600 dark:text-emerald-400 font-medium">Logged in &bull; {{ auth('customer')->user()->email }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs text-secondary-400 dark:text-slate-500 hover:text-red-500 dark:hover:text-red-400 font-semibold transition">Logout</button>
                    </form>
                </div>

                {{-- Hidden inputs carry the customer name & phone for JS --}}
                <input id="cust-name" type="hidden" value="{{ auth('customer')->user()->name }}">
                <input id="cust-phone" type="hidden" value="{{ auth('customer')->user()->phone ?? '' }}">

                {{-- Phone (editable if not stored on account) --}}
                @if(!auth('customer')->user()->phone)
                <div>
                    <label class="block text-xs font-black text-secondary-600 dark:text-slate-400 uppercase tracking-widest mb-1.5">
                        Phone Number <span class="text-red-500">*</span>
                    </label>
                    <input id="cust-phone" type="tel" placeholder="e.g. 0123456789"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 text-secondary-900 dark:text-white text-sm font-medium placeholder-secondary-300 dark:placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent transition">
                </div>
                @endif

                {{-- Notes --}}
                <div>
                    <label class="block text-xs font-black text-secondary-600 dark:text-slate-400 uppercase tracking-widest mb-1.5">Notes
                        <span class="text-secondary-300 dark:text-slate-600 font-medium normal-case tracking-normal">(optional)</span>
                    </label>
                    <textarea id="cust-notes" rows="2" placeholder="Delivery address, special requests…"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800 text-secondary-900 dark:text-white text-sm font-medium placeholder-secondary-300 dark:placeholder-slate-600 focus:outline-none focus:ring-2 focus:ring-primary-400 focus:border-transparent transition resize-none"></textarea>
                </div>
            </div>
            @else
            {{-- ── GUEST: Login / Register prompt ─────────────────────────────── --}}
            @php $shopPath = '/shop/' . $seller->store_slug; @endphp
            <div class="p-5 space-y-4">
                <p class="text-sm text-secondary-500 dark:text-slate-400 leading-relaxed">
                    Please <strong class="text-secondary-800 dark:text-white">login</strong> or
                    <strong class="text-secondary-800 dark:text-white">create an account</strong> to proceed with your order.
                </p>
                <div class="flex flex-col gap-3">
                    <a href="{{ route('login') }}?redirect={{ urlencode($shopPath) }}"
                        class="w-full py-3 rounded-xl bg-primary-600 hover:bg-primary-700 text-white font-black text-sm uppercase tracking-widest flex items-center justify-center gap-2 transition">
                        <i class="hgi-stroke hgi-login-02 text-lg"></i>
                        Login to Your Account
                    </a>
                    <a href="{{ route('register') }}?redirect={{ urlencode($shopPath) }}"
                        class="w-full py-3 rounded-xl border border-primary-200 dark:border-primary-700 text-primary-600 dark:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/20 font-black text-sm uppercase tracking-widest flex items-center justify-center gap-2 transition">
                        <i class="hgi-stroke hgi-user-add-01 text-lg"></i>
                        Create New Account
                    </a>
                </div>
                <p class="text-center text-xs text-secondary-400 dark:text-slate-600">
                    Your cart will be saved when you return.
                </p>
            </div>
            @endauth
        </div>

        {{-- ── How to Place Order ── --}}
        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-100 dark:border-slate-800 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-50 dark:border-slate-800 flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-violet-50 dark:bg-violet-900/20 flex items-center justify-center">
                    <i class="hgi-stroke hgi-sent text-base text-violet-500 dark:text-violet-400"></i>
                </div>
                <h2 class="font-black text-secondary-900 dark:text-white text-sm uppercase tracking-wider">How to Place Order</h2>
            </div>
            <div class="p-4 grid grid-cols-3 gap-2">
                {{-- WhatsApp --}}
                <button id="method-wa" onclick="setMethod('whatsapp')"
                    class="method-btn active flex flex-col items-center gap-2 p-3 rounded-xl border-2 border-[#25D366] bg-emerald-50 dark:bg-emerald-900/20 text-[#25D366] transition-all">
                    <svg class="w-6 h-6 fill-current flex-shrink-0" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    <span class="text-[10px] font-black uppercase tracking-widest text-center leading-tight">WhatsApp</span>
                </button>
                {{-- System / Online --}}
                <button id="method-sys" onclick="setMethod('system')"
                    class="method-btn flex flex-col items-center gap-2 p-3 rounded-xl border-2 border-gray-200 dark:border-slate-700 text-secondary-400 dark:text-slate-500 transition-all">
                    <i class="hgi-stroke hgi-globe text-2xl"></i>
                    <span class="text-[10px] font-black uppercase tracking-widest text-center leading-tight">Online Only</span>
                </button>
                {{-- Both --}}
                <button id="method-both" onclick="setMethod('both')"
                    class="method-btn flex flex-col items-center gap-2 p-3 rounded-xl border-2 border-gray-200 dark:border-slate-700 text-secondary-400 dark:text-slate-500 transition-all">
                    <i class="hgi-stroke hgi-share-08 text-2xl"></i>
                    <span class="text-[10px] font-black uppercase tracking-widest text-center leading-tight">Both</span>
                </button>
            </div>
            <p id="method-hint" class="px-5 pb-4 text-center text-xs text-secondary-400 dark:text-slate-500 font-medium">
                Your order will be sent directly to the seller on WhatsApp.
            </p>
        </div>

        {{-- Dynamic Place Order Button --}}
        <button id="place-order-btn" onclick="placeOrder()"
            class="w-full py-4 rounded-2xl bg-[#25D366] hover:bg-[#20be5a] active:scale-[.98] text-white font-black text-sm uppercase tracking-widest flex items-center justify-center gap-3 shadow-lg transition-all disabled:opacity-60 disabled:cursor-not-allowed">
            <svg id="btn-wa-icon" class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            <i id="btn-sys-icon" class="hgi-stroke hgi-globe text-lg hidden"></i>
            <i id="btn-both-icon" class="hgi-stroke hgi-share-08 text-lg hidden"></i>
            <span id="btn-label">Send Order via WhatsApp</span>
        </button>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════
    SCREEN 3 — ORDER SUCCESS (shown for system/both methods)
    ══════════════════════════════════════════════════════════════════ --}}
    <div id="screen-success"
        class="hidden screen max-w-lg mx-auto px-4 py-12 space-y-6 animate__animated animate__fadeIn">
        <div class="text-center space-y-4">
            <div class="w-20 h-20 mx-auto rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center shadow-lg">
                <i class="hgi-stroke hgi-checkmark-circle-01 text-4xl text-emerald-500 dark:text-emerald-400"></i>
            </div>
            <div>
                <h2 class="text-2xl font-black text-secondary-900 dark:text-white tracking-tight">Order Confirmed!</h2>
                <p class="text-secondary-500 dark:text-slate-400 text-sm font-medium mt-1">Your order has been saved successfully.</p>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-gray-100 dark:border-slate-800 shadow-sm p-5 space-y-3">
            <div class="flex items-center justify-between py-2.5 px-4 rounded-xl bg-gray-50 dark:bg-slate-800">
                <span class="text-xs font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">Order #</span>
                <span id="success-order-number" class="text-sm font-black text-secondary-900 dark:text-white"></span>
            </div>
            <div class="flex items-center justify-between py-2.5 px-4 rounded-xl bg-gray-50 dark:bg-slate-800">
                <span class="text-xs font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">Store</span>
                <span class="text-sm font-bold text-secondary-700 dark:text-slate-300">{{ $seller->store_name ?? $seller->name }}</span>
            </div>
            <div class="flex items-center justify-between py-2.5 px-4 rounded-xl bg-gray-50 dark:bg-slate-800">
                <span class="text-xs font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">Status</span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black bg-amber-100 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400 uppercase tracking-widest">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse inline-block"></span> Pending
                </span>
            </div>
            <div id="success-total-row" class="flex items-center justify-between py-3 px-4 rounded-xl bg-primary-600">
                <span class="text-xs font-black text-primary-100 uppercase tracking-widest">Total</span>
                <span id="success-total" class="text-base font-black text-white"></span>
            </div>
        </div>

        {{-- WA button — only shown for 'both' method --}}
        <button id="success-wa-btn"
            onclick="openWhatsAppAfterSuccess()"
            class="hidden w-full py-4 rounded-2xl bg-[#25D366] hover:bg-[#20be5a] active:scale-[.98] text-white font-black text-sm uppercase tracking-widest flex items-center justify-center gap-3 shadow-lg shadow-green-500/25 transition-all">
            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            Also Send via WhatsApp
        </button>

        <button onclick="startNewOrder()"
            class="w-full py-4 rounded-2xl bg-secondary-900 dark:bg-slate-800 hover:bg-secondary-700 dark:hover:bg-slate-700 text-white font-black text-sm uppercase tracking-widest flex items-center justify-center gap-2 transition-all">
            <i class="hgi-stroke hgi-shopping-cart-add text-lg"></i> Place Another Order
        </button>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════
    FLOATING CART BAR — visible when cart has items, on store screen
    ══════════════════════════════════════════════════════════════════ --}}
    <div id="cart-bar"
        class="hidden fixed bottom-0 left-0 right-0 z-40 p-4 bg-gradient-to-t from-white/95 dark:from-slate-950/95 to-transparent pb-6">
        <div class="max-w-lg mx-auto">
            <button onclick="goCheckout()"
                class="w-full py-4 rounded-2xl bg-secondary-900 dark:bg-white hover:bg-secondary-700 dark:hover:bg-gray-100 active:scale-[.98] text-white dark:text-secondary-900 font-black text-sm flex items-center justify-between px-5 shadow-xl shadow-secondary-900/20 dark:shadow-black/30 transition-all">
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 rounded-lg bg-primary-500 flex items-center justify-center">
                        <i class="hgi-stroke hgi-shopping-cart-01 text-sm text-white"></i>
                    </div>
                    <span id="cart-bar-label">0 items</span>
                </div>
                <div class="flex items-center gap-3">
                    <span id="cart-bar-total" class="font-black text-primary-400 dark:text-primary-500">MYR 0.00</span>
                    <span class="flex items-center gap-1">Checkout <i
                            class="hgi-stroke hgi-arrow-right-01 text-sm"></i></span>
                </div>
            </button>
        </div>
    </div>

    {{-- ══════════════════ DUPLICATE ORDER WARNING MODAL ══════════════════ --}}
    <div id="dup-modal" class="hidden fixed inset-0 z-50 flex items-end sm:items-center justify-center px-4 pb-6 sm:pb-0">
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" onclick="closeDupModal()"></div>
        <div class="relative w-full max-w-sm bg-white dark:bg-slate-900 rounded-3xl shadow-2xl p-6 space-y-4 animate__animated animate__fadeInUp">
            <div class="flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center flex-shrink-0">
                    <i class="hgi-stroke hgi-alert-02 text-amber-600 dark:text-amber-400 text-2xl"></i>
                </div>
                <div>
                    <h3 class="font-black text-secondary-900 dark:text-white text-base leading-tight">Duplicate Order Detected</h3>
                    <p id="dup-subtitle" class="text-xs text-secondary-500 dark:text-slate-400 font-medium mt-0.5"></p>
                </div>
            </div>
            <p id="dup-body" class="text-sm text-secondary-600 dark:text-slate-300 font-medium leading-relaxed"></p>
            <div class="flex gap-3 pt-1">
                <button onclick="closeDupModal()"
                    class="flex-1 py-3 rounded-2xl bg-gray-100 dark:bg-slate-800 text-secondary-700 dark:text-slate-300 text-sm font-black hover:bg-gray-200 dark:hover:bg-slate-700 transition active:scale-95">
                    Cancel
                </button>
                <button id="dup-confirm-btn" onclick="confirmDupSend()"
                    class="flex-1 py-3 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-black transition active:scale-95 flex items-center justify-center gap-2">
                    <i class="hgi-stroke hgi-whatsapp text-lg"></i> Send Anyway
                </button>
            </div>
        </div>
    </div>

    {{-- ─────────────────────────────── SCRIPTS ─────────────────────────────── --}}
    @php
        $productData  = $products->map(fn($p) => [
            'id'     => $p->id,
            'name'   => $p->name,
            'sku'    => $p->sku,
            'price'  => (float) $p->price,
            'maxQty' => (int) $p->quantity,
        ]);
        $sellerPhone  = preg_replace('/\D/', '', $seller->phone ?? '');
        $storeName    = $seller->store_name ?? $seller->name;
        $deliveryFee  = (float) ($seller->delivery_fee ?? 0);
        $orderUrl     = route('public.store.order', ['slug' => $seller->store_slug]);
    @endphp
    <script>
        // ── Data from PHP ───────────────────────────────────────────────────────────
        const PRODUCTS      = @json($productData);
        const SELLER_PHONE  = @json($sellerPhone);
        const STORE_NAME    = @json($storeName);
        const DELIVERY_FEE  = @json($deliveryFee);
        const ORDER_URL     = @json($orderUrl);
        const LOOKUP_URL    = @json(route('public.store.lookup', $seller->store_slug));
        const CSRF_TOKEN    = document.querySelector('meta[name="csrf-token"]').content;
        const AUTH_CUSTOMER = @json(auth('customer')->check());

        // ── Cart state ───────────────────────────────────────────────────────────────
        let cart = {}; // { productId: qty }

        // ── Theme toggle ─────────────────────────────────────────────────────────────
        const iconDark = document.getElementById('icon-dark');
        const iconLight = document.getElementById('icon-light');
        function applyTheme() {
            const dark = document.documentElement.classList.contains('dark');
            iconDark.classList.toggle('hidden', dark);
            iconLight.classList.toggle('hidden', !dark);
        }
        applyTheme();
        document.getElementById('theme-toggle').addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
            applyTheme();
        });

        // ── Screen navigation ────────────────────────────────────────────────────────
        const screenStore = document.getElementById('screen-store');
        const screenCheckout = document.getElementById('screen-checkout');
        const navBackLabel = document.getElementById('nav-back-label');

        function goBack() {
            // If success or checkout screen is visible, go back to store
            const ss = document.getElementById('screen-success');
            if (!screenCheckout.classList.contains('hidden') || (ss && !ss.classList.contains('hidden'))) {
                showStore();
            } else {
                window.location.href = '/';
            }
        }
        function showStore() {
            screenCheckout.classList.add('hidden');
            const ss = document.getElementById('screen-success');
            if (ss) ss.classList.add('hidden');
            screenStore.classList.remove('hidden');
            navBackLabel.textContent = 'Back to OMS';
            updateCartBar();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        function goCheckout() {
            if (Object.keys(cart).length === 0) return;
            renderCheckout();
            screenStore.classList.add('hidden');
            screenCheckout.classList.remove('hidden');
            document.getElementById('cart-bar').classList.add('hidden');
            navBackLabel.textContent = 'Back to Store';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // ── Cart helpers ─────────────────────────────────────────────────────────────
        function addToCart(id) {
            cart[id] = 1;
            refreshProductCard(id);
            updateCartBar();
        }
        function increaseQty(id, max) {
            if (cart[id] === undefined) return;
            if (cart[id] < max) cart[id]++;
            else showToast('Maximum available stock reached');
            refreshProductCard(id);
            updateCartBar();
        }
        function decreaseQty(id) {
            if (cart[id] === undefined) return;
            cart[id]--;
            if (cart[id] <= 0) {
                delete cart[id];
                refreshProductCard(id);
            } else {
                refreshProductCard(id);
            }
            updateCartBar();
        }
        function refreshProductCard(id) {
            const addBtn = document.getElementById('btn-add-' + id);
            const qtyCtrl = document.getElementById('qty-ctrl-' + id);
            const display = document.getElementById('qty-display-' + id);
            if (!addBtn || !qtyCtrl) return;
            if (cart[id]) {
                addBtn.style.display = 'none';
                qtyCtrl.style.display = 'flex';
                display.textContent = cart[id];
            } else {
                addBtn.style.display = '';
                qtyCtrl.style.display = 'none';
            }
        }
        function cartSubtotal() {
            return Object.entries(cart).reduce((sum, [id, qty]) => {
                const p = PRODUCTS.find(x => x.id == id);
                return sum + (p ? p.price * qty : 0);
            }, 0);
        }
        function cartTotal() {
            return cartSubtotal() + (Object.keys(cart).length > 0 ? DELIVERY_FEE : 0);
        }
        function cartItemCount() {
            return Object.values(cart).reduce((s, q) => s + q, 0);
        }
        function updateCartBar() {
            const count = cartItemCount();
            const total = cartTotal();
            const bar = document.getElementById('cart-bar');
            const navBtn = document.getElementById('cart-nav-btn');
            const navCount = document.getElementById('cart-nav-count');

            if (count > 0) {
                bar.classList.remove('hidden');
                navBtn.classList.remove('hidden');
                document.getElementById('cart-bar-label').textContent = count + (count === 1 ? ' item' : ' items');
                document.getElementById('cart-bar-total').textContent = 'MYR ' + total.toFixed(2);
                navCount.textContent = count;
            } else {
                bar.classList.add('hidden');
                navBtn.classList.add('hidden');
            }
        }

        // ── Checkout rendering ────────────────────────────────────────────────────────
        function renderCheckout() {
            const container = document.getElementById('checkout-items');
            container.innerHTML = '';
            let subtotal = 0;
            Object.entries(cart).forEach(([id, qty]) => {
                const p = PRODUCTS.find(x => x.id == id);
                if (!p) return;
                const lineTotal = p.price * qty;
                subtotal += lineTotal;
                const row = document.createElement('div');
                row.className = 'px-5 py-3.5 flex items-center gap-3 cart-item-enter';
                row.innerHTML = `
            <div class="w-10 h-10 rounded-xl bg-primary-50 dark:bg-primary-900/20 flex items-center justify-center flex-shrink-0">
                <i class="hgi-stroke hgi-package text-lg text-primary-500 dark:text-primary-400"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-black text-secondary-900 dark:text-white truncate">${escHtml(p.name)}</p>
                <p class="text-[10px] text-secondary-400 dark:text-slate-500 font-mono">${escHtml(p.sku)}</p>
            </div>
            <div class="flex items-center gap-2 flex-shrink-0">
                <button onclick="coDecreaseQty(${id})" class="qty-btn bg-gray-100 dark:bg-slate-800 text-secondary-600 dark:text-slate-300 hover:bg-red-50 hover:text-red-500 text-sm">
                    <i class="hgi-stroke hgi-minus-sign text-xs"></i>
                </button>
                <span class="text-sm font-black text-secondary-900 dark:text-white w-5 text-center" id="co-qty-${id}">${qty}</span>
                <button onclick="coIncreaseQty(${id}, ${p.maxQty})" class="qty-btn bg-primary-500 text-white hover:bg-primary-600 text-sm">
                    <i class="hgi-stroke hgi-plus-sign text-xs"></i>
                </button>
            </div>
            <div class="flex-shrink-0 text-right min-w-[4.5rem]">
                <p class="text-sm font-black text-secondary-900 dark:text-white" id="co-sub-${id}">MYR ${lineTotal.toFixed(2)}</p>
                <p class="text-[10px] text-secondary-400 dark:text-slate-500">@ ${p.price.toFixed(2)}</p>
            </div>`;
                container.appendChild(row);
            });
            const grandTotal = subtotal + DELIVERY_FEE;
            document.getElementById('checkout-subtotal').textContent = 'MYR ' + subtotal.toFixed(2);
            document.getElementById('checkout-delivery').textContent = DELIVERY_FEE > 0 ? 'MYR ' + DELIVERY_FEE.toFixed(2) : 'Free';
            document.getElementById('checkout-total').textContent = 'MYR ' + grandTotal.toFixed(2);
        }
        function coDecreaseQty(id) {
            decreaseQty(id);
            if (Object.keys(cart).length === 0) { showStore(); return; }
            renderCheckout();
        }
        function coIncreaseQty(id, max) {
            increaseQty(id, max);
            renderCheckout();
        }

        // ── Registered-customer phone lookup ─────────────────────────────────────
        (function () {
            const phoneEl  = document.getElementById('cust-phone');
            const nameEl   = document.getElementById('cust-name');
            const badge    = document.getElementById('customer-badge');
            const badgeName = document.getElementById('customer-badge-name');

            if (!phoneEl) return;

            phoneEl.addEventListener('blur', async () => {
                const phone = phoneEl.value.trim();
                badge.classList.add('hidden');
                if (!phone || phone.length < 8) return;

                try {
                    const res  = await fetch(LOOKUP_URL + '?phone=' + encodeURIComponent(phone));
                    const data = await res.json();
                    if (data.found) {
                        badgeName.textContent = data.name;
                        badge.classList.remove('hidden');
                        // Pre-fill name only if the field is still empty
                        if (!nameEl.value.trim()) {
                            nameEl.value = data.name;
                        }
                    }
                } catch (e) {
                    // silently ignore — lookup is best-effort
                }
            });

            // Hide badge when phone is changed again
            phoneEl.addEventListener('input', () => badge.classList.add('hidden'));
        })();

        // ── Order method selector ─────────────────────────────────────────────────
        let selectedMethod = 'whatsapp'; // 'whatsapp' | 'system' | 'both'

        const METHOD_CONFIG = {
            whatsapp: {
                btnClass:  'bg-[#25D366] hover:bg-[#20be5a] shadow-green-500/25',
                label:     'Send Order via WhatsApp',
                waIcon:    true,
                sysIcon:   false,
                bothIcon:  false,
                hint:      'Your order will be sent directly to the seller on WhatsApp.',
                cardActive: { id: 'method-wa',   cls: 'border-[#25D366] bg-emerald-50 dark:bg-emerald-900/20 text-[#25D366]' },
            },
            system: {
                btnClass:  'bg-primary-600 hover:bg-primary-700 shadow-primary-600/25',
                label:     'Place Order Online',
                waIcon:    false,
                sysIcon:   true,
                bothIcon:  false,
                hint:      'Your order will be saved in the system. The seller will be notified.',
                cardActive: { id: 'method-sys',  cls: 'border-primary-500 bg-primary-50 dark:bg-primary-900/20 text-primary-600 dark:text-primary-400' },
            },
            both: {
                btnClass:  'bg-indigo-600 hover:bg-indigo-700 shadow-indigo-600/25',
                label:     'Place Order (System + WhatsApp)',
                waIcon:    false,
                sysIcon:   false,
                bothIcon:  true,
                hint:      'Your order will be saved online AND sent to the seller on WhatsApp.',
                cardActive: { id: 'method-both', cls: 'border-indigo-500 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400' },
            },
        };
        const CARD_IDS = ['method-wa', 'method-sys', 'method-both'];
        const CARD_INACTIVE = 'border-gray-200 dark:border-slate-700 text-secondary-400 dark:text-slate-500';

        function setMethod(m) {
            selectedMethod = m;
            const cfg = METHOD_CONFIG[m];

            // Reset all cards to inactive
            CARD_IDS.forEach(id => {
                const el = document.getElementById(id);
                if (!el) return;
                // Strip active classes, apply inactive
                el.className = el.className
                    .replace(/border-\S+/g, '')
                    .replace(/bg-\S+/g, '')
                    .replace(/text-\S+/g, '')
                    .trim();
                el.className += ' method-btn flex flex-col items-center gap-2 p-3 rounded-xl border-2 transition-all ' + CARD_INACTIVE;
            });

            // Apply active card classes
            const activeEl = document.getElementById(cfg.cardActive.id);
            if (activeEl) {
                activeEl.className = 'method-btn flex flex-col items-center gap-2 p-3 rounded-xl border-2 transition-all ' + cfg.cardActive.cls;
            }

            // Update CTA button appearance
            const btn = document.getElementById('place-order-btn');
            btn.className = 'w-full py-4 rounded-2xl active:scale-[.98] text-white font-black text-sm uppercase tracking-widest flex items-center justify-center gap-3 shadow-lg transition-all disabled:opacity-60 disabled:cursor-not-allowed ' + cfg.btnClass;
            document.getElementById('btn-wa-icon').classList.toggle('hidden', !cfg.waIcon);
            document.getElementById('btn-sys-icon').classList.toggle('hidden', !cfg.sysIcon);
            document.getElementById('btn-both-icon').classList.toggle('hidden', !cfg.bothIcon);
            document.getElementById('btn-label').textContent = cfg.label;

            // Update hint text
            document.getElementById('method-hint').textContent = cfg.hint;
        }

        // ── WhatsApp helpers ──────────────────────────────────────────────────────
        let _dupOrderNumber = null; // stores order# for "Send Anyway"
        let _lastOrderNumber = null; // used by success screen WA button

        function buildWaUrl(orderNumber) {
            const name  = document.getElementById('cust-name').value.trim();
            const phone = document.getElementById('cust-phone').value.trim();
            const notes = document.getElementById('cust-notes').value.trim();
            const lines = [];
            lines.push('🛒 *New Order — ' + STORE_NAME + '*');
            lines.push('📋 *Order #' + orderNumber + '*');
            lines.push('');
            lines.push('*Customer Details*');
            lines.push('Name: ' + name);
            lines.push('Phone: ' + phone);
            lines.push('');
            lines.push('*Order Items*');
            Object.entries(cart).forEach(([id, qty]) => {
                const p = PRODUCTS.find(x => x.id == id);
                if (!p) return;
                lines.push('• ' + p.name + ' × ' + qty + '  =  MYR ' + (p.price * qty).toFixed(2));
            });
            lines.push('');
            const sub = cartSubtotal();
            if (DELIVERY_FEE > 0) {
                lines.push('Subtotal: MYR ' + sub.toFixed(2));
                lines.push('Delivery Fee: MYR ' + DELIVERY_FEE.toFixed(2));
            }
            lines.push('*Total: MYR ' + (sub + DELIVERY_FEE).toFixed(2) + '*');
            if (notes) { lines.push(''); lines.push('📝 Notes: ' + notes); }
            lines.push('');
            lines.push('_Sent via OMS Shop_');
            let waPhone = SELLER_PHONE.replace(/\D/g, '');
            if (waPhone.startsWith('0')) waPhone = '60' + waPhone.slice(1);
            return waPhone ? 'https://wa.me/' + waPhone + '?text=' + encodeURIComponent(lines.join('\n')) : null;
        }

        function openWhatsApp(orderNumber) {
            const url = buildWaUrl(orderNumber);
            if (!url) { showToast('This seller has not set up a WhatsApp number yet.'); return; }
            window.open(url, '_blank');
        }

        function closeDupModal() {
            document.getElementById('dup-modal').classList.add('hidden');
            _dupOrderNumber = null;
        }

        function confirmDupSend() {
            closeDupModal();
            if (!_dupOrderNumber) return;
            if (selectedMethod === 'whatsapp') {
                openWhatsApp(_dupOrderNumber);
            } else if (selectedMethod === 'both') {
                showSuccess(_dupOrderNumber);
                openWhatsApp(_dupOrderNumber);
            } else {
                showSuccess(_dupOrderNumber);
            }
        }

        // ── Main place-order entry point ──────────────────────────────────────────
        async function placeOrder() {
            if (!AUTH_CUSTOMER) { showToast('Please log in to place an order.'); return; }
            const name  = document.getElementById('cust-name').value.trim();
            const phone = document.getElementById('cust-phone').value.trim();
            if (!name)  { showToast('Please enter your name.');         return; }
            if (!phone) { showToast('Please enter your phone number.'); return; }
            if (Object.keys(cart).length === 0) { showToast('Your cart is empty.'); return; }

            const btn = document.getElementById('place-order-btn');
            const origHtml = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<span class="animate-pulse font-black">Saving order…</span>';

            const items = Object.entries(cart).map(([id, qty]) => ({ product_id: parseInt(id), quantity: qty }));
            try {
                const res  = await fetch(ORDER_URL, {
                    method:  'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN },
                    body:    JSON.stringify({
                        name,
                        phone,
                        notes:  document.getElementById('cust-notes').value.trim(),
                        method: selectedMethod,
                        items,
                    }),
                });
                const data = await res.json();

                if (!res.ok) {
                    showToast(data.error ?? 'Something went wrong. Please try again.');
                    return;
                }

                if (data.duplicate) {
                    _dupOrderNumber = data.order_number;
                    const dupBody = selectedMethod === 'whatsapp'
                        ? 'Would you like to open WhatsApp to send it again?'
                        : selectedMethod === 'both'
                            ? 'Would you like to save it again and open WhatsApp?'
                            : 'Would you like to confirm the order again?';
                    document.getElementById('dup-subtitle').textContent = 'Order #' + data.order_number;
                    document.getElementById('dup-body').textContent =
                        'It looks like you already placed this exact order ' + data.minutes_ago + ' minute(s) ago. ' + dupBody;
                    // Update "Send Anyway" button label
                    const dupBtn = document.getElementById('dup-confirm-btn');
                    if (selectedMethod === 'system') {
                        dupBtn.innerHTML = '<i class="hgi-stroke hgi-globe text-lg"></i> Place Again';
                    } else {
                        dupBtn.innerHTML = '<i class="hgi-stroke hgi-whatsapp text-lg"></i> Send Anyway';
                    }
                    document.getElementById('dup-modal').classList.remove('hidden');
                    return;
                }

                if (data.success) {
                    _lastOrderNumber = data.order_number;
                    if (selectedMethod === 'whatsapp') {
                        openWhatsApp(data.order_number);
                        showToast('Order #' + data.order_number + ' saved! Opening WhatsApp…');
                    } else if (selectedMethod === 'both') {
                        showSuccess(data.order_number);
                        openWhatsApp(data.order_number);
                    } else {
                        showSuccess(data.order_number);
                    }
                }
            } catch (err) {
                showToast('Network error. Please check your connection and try again.');
            } finally {
                btn.disabled = false;
                btn.innerHTML = origHtml;
            }
        }

        // ── Success screen ────────────────────────────────────────────────────────
        const screenSuccess = document.getElementById('screen-success');

        function showSuccess(orderNumber) {
            // Populate success screen
            document.getElementById('success-order-number').textContent = '#' + orderNumber;
            document.getElementById('success-total').textContent = 'MYR ' + cartTotal().toFixed(2);

            // Show WA button only for 'both' method
            document.getElementById('success-wa-btn').classList.toggle('hidden', selectedMethod !== 'both');

            // Switch screens
            document.getElementById('screen-checkout').classList.add('hidden');
            screenSuccess.classList.remove('hidden');
            document.getElementById('cart-bar').classList.add('hidden');
            navBackLabel.textContent = 'Back to Store';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function openWhatsAppAfterSuccess() {
            if (_lastOrderNumber) openWhatsApp(_lastOrderNumber);
        }

        function startNewOrder() {
            // Reset cart
            cart = {};
            PRODUCTS.forEach(p => refreshProductCard(p.id));
            // Hide success, show store
            screenSuccess.classList.add('hidden');
            showStore();
        }

        // ── Utility ───────────────────────────────────────────────────────────────────
        function escHtml(str) {
            return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }
        let toastTimer;
        function showToast(msg) {
            let t = document.getElementById('toast');
            if (!t) {
                t = document.createElement('div');
                t.id = 'toast';
                t.className = 'fixed bottom-32 left-1/2 -translate-x-1/2 z-50 px-5 py-3 rounded-2xl bg-secondary-900 dark:bg-white text-white dark:text-secondary-900 text-xs font-black shadow-xl transition-all duration-300 opacity-0';
                document.body.appendChild(t);
            }
            t.textContent = msg;
            t.classList.remove('opacity-0');
            clearTimeout(toastTimer);
            toastTimer = setTimeout(() => t.classList.add('opacity-0'), 2500);
        }
    </script>
</body>

</html>