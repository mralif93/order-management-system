@extends('layouts.public')

@section('title', 'Order Management System — Smart Sales & Inventory for SMEs')
@section('meta_description', 'Track orders, manage inventory, build customer relationships, and grow your business — all from one powerful dashboard. Free to start.')

@section('content')

{{-- ══════════════════════════════════════════════════════════════════
     HERO
══════════════════════════════════════════════════════════════════ --}}
<section class="relative bg-white dark:bg-gray-900 overflow-hidden pt-16 sm:pt-20 lg:pt-28 pb-20 transition-colors duration-200">
    {{-- Decorative gradient blob --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
        <div class="absolute -top-40 -right-40 w-[600px] h-[600px] rounded-full bg-primary-400/10 dark:bg-primary-500/5 blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 w-[400px] h-[400px] rounded-full bg-accent-400/10 dark:bg-accent-500/5 blur-3xl"></div>
    </div>

    <div class="relative container mx-auto px-4 sm:px-6 z-10">
        <div class="max-w-4xl mx-auto text-center animate__animated animate__fadeInDown">

            {{-- Live badge --}}
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-50 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 font-semibold text-sm mb-8 border border-primary-100 dark:border-primary-800">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-500"></span>
                </span>
                Now serving 5,000+ businesses across Malaysia
            </div>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 dark:text-white tracking-tight mb-6 leading-tight">
                Smart <span class="text-primary-600 dark:text-primary-400">Order Management</span><br class="hidden sm:block"> Built For Growth
            </h1>

            <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 mb-10 max-w-2xl mx-auto leading-relaxed">
                Take full control of your sales pipeline. Effortlessly track inventory, manage customer relationships, and fulfil orders — all from one unified dashboard.
            </p>

            <div class="flex flex-col sm:flex-row justify-center items-center gap-3">
                <a href="{{ url('register') }}"
                   class="w-full sm:w-auto px-8 py-3.5 bg-primary-600 dark:bg-primary-500 text-white rounded-xl font-bold shadow-lg shadow-primary-500/30 hover:bg-primary-700 dark:hover:bg-primary-600 hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2">
                    Get Started Free <i class="hgi-stroke hgi-arrow-right-01"></i>
                </a>
                <a href="#how-it-works"
                   class="w-full sm:w-auto px-8 py-3.5 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 border border-gray-200 dark:border-gray-700 rounded-xl font-bold shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600 transition-all flex items-center justify-center gap-2">
                    <i class="hgi-stroke hgi-play-circle"></i> See How It Works
                </a>
            </div>

            <p class="mt-4 text-xs text-gray-400 dark:text-gray-500">No credit card required &bull; Free forever plan available</p>
        </div>

        {{-- Trust stats --}}
        <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-4 max-w-3xl mx-auto">
            @foreach([
                ['icon'=>'hgi-cloud-server',     'stat'=>'99.9%',  'label'=>'Uptime SLA'],
                ['icon'=>'hgi-customer-support', 'stat'=>'24/7',   'label'=>'Expert Support'],
                ['icon'=>'hgi-user-multiple',    'stat'=>'5,000+', 'label'=>'Active Businesses'],
                ['icon'=>'hgi-shield-key',       'stat'=>'100%',   'label'=>'Secure & Encrypted'],
            ] as $s)
            <div class="group bg-white dark:bg-gray-800 p-5 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300 text-center">
                <div class="w-10 h-10 mx-auto bg-primary-50 dark:bg-primary-900/40 text-primary-600 dark:text-primary-400 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <i class="hgi-stroke {{ $s['icon'] }} text-xl"></i>
                </div>
                <h4 class="text-2xl font-black text-gray-900 dark:text-white">{{ $s['stat'] }}</h4>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 font-medium">{{ $s['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════════════
     HOW IT WORKS
══════════════════════════════════════════════════════════════════ --}}
<section id="how-it-works" class="bg-gray-50 dark:bg-gray-800/50 py-20 border-t border-gray-100 dark:border-gray-700 scroll-mt-16 transition-colors duration-200">
    <div class="container mx-auto px-4 sm:px-6">

        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-primary-600 dark:text-primary-400 mb-3 block">Simple Process</span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white mb-4" data-animate="fadeInUp">
                Up and Running in Minutes
            </h2>
            <p class="text-gray-600 dark:text-gray-400 text-lg" data-animate="fadeInUp" style="animation-delay:.1s">
                No technical knowledge needed. Set up your store and start taking orders today.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto relative">
            {{-- Connecting line — z-0 sits above the grid background but below the z-10    --}}
            {{-- step wrappers. IMPORTANT: data-animate must NOT be on the same element as  --}}
            {{-- z-10 because opacity:0 creates a new stacking context that breaks z-index. --}}
            {{-- Solution: outer div keeps z-10 (no opacity change); data-animate goes on   --}}
            {{-- an inner child div so the stacking order is always correct.                --}}
            <div class="hidden md:block absolute top-10 left-[calc(16.66%+2rem)] right-[calc(16.66%+2rem)] h-0.5 bg-gradient-to-r from-primary-300 via-primary-500 to-primary-300 dark:from-primary-700 dark:via-primary-500 dark:to-primary-700 z-0"></div>

            @foreach([
                ['step'=>'01','icon'=>'hgi-store-01','color'=>'primary','title'=>'Create Your Store','desc'=>'Sign up free and customise your store profile. Add your logo, bio, and public store link in under 5 minutes.'],
                ['step'=>'02','icon'=>'hgi-share-08','color'=>'accent','title'=>'List Your Products','desc'=>'Add products with prices, stock levels, and descriptions. Share your unique store link with customers instantly.'],
                ['step'=>'03','icon'=>'hgi-dashboard-square-01','color'=>'emerald','title'=>'Manage Orders','desc'=>'Receive orders via WhatsApp or online, track fulfilment, and analyse sales — all from your dashboard.'],
            ] as $i => $step)
            @php $delay = $i * 0.15; @endphp
            {{-- Outer wrapper: z-10 with NO data-animate — ensures it always stacks above the line --}}
            <div class="relative z-10 flex flex-col items-center text-center group">
                {{-- Inner wrapper: carries data-animate so opacity:0 is isolated here, not on z-10 parent --}}
                <div data-animate="fadeInUp" style="animation-delay:{{ $delay }}s" class="flex flex-col items-center text-center w-full">
                    <div class="w-20 h-20 rounded-2xl bg-{{ $step['color'] }}-100 dark:bg-{{ $step['color'] }}-900/30 flex items-center justify-center mb-5 shadow-md group-hover:scale-110 transition-transform relative">
                        <i class="hgi-stroke {{ $step['icon'] }} text-3xl text-{{ $step['color'] }}-600 dark:text-{{ $step['color'] }}-400"></i>
                        <span class="absolute -top-2 -right-2 w-7 h-7 rounded-full bg-{{ $step['color'] }}-600 text-white text-xs font-black flex items-center justify-center">{{ $step['step'] }}</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $step['title'] }}</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════════════
     FEATURES
══════════════════════════════════════════════════════════════════ --}}
<section id="features" class="bg-white dark:bg-gray-900 py-20 border-t border-gray-100 dark:border-gray-800 scroll-mt-16 transition-colors duration-200">
    <div class="container mx-auto px-4 sm:px-6">

        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-primary-600 dark:text-primary-400 mb-3 block">Everything You Need</span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white mb-4" data-animate="fadeInUp">
                Powerful Features, Zero Complexity
            </h2>
            <p class="text-gray-600 dark:text-gray-400 text-lg" data-animate="fadeInUp" style="animation-delay:.1s">
                Purpose-built tools for Malaysian SMEs — designed to save you hours every week.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['icon'=>'hgi-shopping-cart-01',    'bg'=>'primary',  'title'=>'Real-Time Order Tracking',    'desc'=>'Monitor every order from placement to delivery. Get instant status updates and automated customer notifications.'],
                ['icon'=>'hgi-user-multiple',        'bg'=>'accent',   'title'=>'Customer CRM',                'desc'=>'Maintain rich customer profiles with purchase history, contact details, and lifetime value insights.'],
                ['icon'=>'hgi-dashboard-square-01',  'bg'=>'emerald',  'title'=>'Rich Sales Analytics',        'desc'=>'Understand your best-sellers, peak hours, and revenue trends with an intuitive analytics dashboard.'],
                ['icon'=>'hgi-package',              'bg'=>'sky',      'title'=>'Inventory Management',        'desc'=>'Set stock levels, get low-stock alerts, and prevent overselling with automatic quantity tracking.'],
                ['icon'=>'hgi-whatsapp',             'bg'=>'green',    'title'=>'WhatsApp Integration',        'desc'=>'Let customers order directly via WhatsApp. Orders are captured and synced to your dashboard automatically.'],
                ['icon'=>'hgi-store-01',             'bg'=>'rose',     'title'=>'Multi-Store Support',         'desc'=>'Manage multiple brands or outlets from a single account. Switch between stores in one click.'],
            ] as $i => $feat)
            @php $delay = ($i % 3) * 0.12; @endphp
            <div class="bg-white dark:bg-gray-800 p-7 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 group"
                 data-animate="fadeInUp" style="animation-delay:{{ $delay }}s">
                <div class="w-14 h-14 bg-{{ $feat['bg'] }}-50 dark:bg-{{ $feat['bg'] }}-900/30 rounded-2xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                    <i class="hgi-stroke {{ $feat['icon'] }} text-2xl text-{{ $feat['bg'] }}-600 dark:text-{{ $feat['bg'] }}-400"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $feat['title'] }}</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">{{ $feat['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════════════
     TESTIMONIALS
══════════════════════════════════════════════════════════════════ --}}
<section class="bg-gray-50 dark:bg-gray-800/50 py-20 border-t border-gray-100 dark:border-gray-700 transition-colors duration-200">
    <div class="container mx-auto px-4 sm:px-6">

        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-primary-600 dark:text-primary-400 mb-3 block">Customer Stories</span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white mb-4" data-animate="fadeInUp">
                Loved by Businesses Like Yours
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
            @foreach([
                ['name'=>'Sarah Ahmad',   'role'=>'F&B Owner, Kuala Lumpur',    'avatar'=>'SA', 'color'=>'primary', 'quote'=>'"Since switching to OMS, I can manage all my outlets from my phone. Orders are organised, stock levels are accurate, and my team has never been more productive."'],
                ['name'=>'James Tan',     'role'=>'E-commerce Seller, Penang',  'avatar'=>'JT', 'color'=>'accent',  'quote'=>'"The analytics dashboard helped me identify my best-selling products. I increased revenue by 40% in just two months by focusing on what actually sells."'],
                ['name'=>'Nur Aisyah',   'role'=>'Home Baker, Johor Bahru',    'avatar'=>'NA', 'color'=>'emerald', 'quote'=>'"Setting up my WhatsApp store took literally 5 minutes. Customers can now browse and order without me manually replying to every single message."'],
            ] as $i => $t)
            @php $delay = $i * 0.12; @endphp
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-7 shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col"
                 data-animate="fadeInUp" style="animation-delay:{{ $delay }}s">
                <div class="flex gap-1 mb-4">
                    @for($s=0;$s<5;$s++)<i class="hgi-stroke hgi-star text-amber-400 text-sm"></i>@endfor
                </div>
                <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed flex-1 italic">{{ $t['quote'] }}</p>
                <div class="flex items-center gap-3 mt-6 pt-5 border-t border-gray-100 dark:border-gray-700">
                    <div class="w-10 h-10 rounded-full bg-{{ $t['color'] }}-100 dark:bg-{{ $t['color'] }}-900/30 text-{{ $t['color'] }}-700 dark:text-{{ $t['color'] }}-400 font-black text-sm flex items-center justify-center shrink-0">{{ $t['avatar'] }}</div>
                    <div>
                        <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $t['name'] }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $t['role'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════════════
     PRICING
══════════════════════════════════════════════════════════════════ --}}
<section id="pricing" class="bg-white dark:bg-gray-900 py-20 border-t border-gray-100 dark:border-gray-800 scroll-mt-16 transition-colors duration-200">
    <div class="container mx-auto px-4 sm:px-6">

        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="text-xs font-bold uppercase tracking-widest text-primary-600 dark:text-primary-400 mb-3 block">Transparent Pricing</span>
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 dark:text-white mb-4" data-animate="fadeInUp">
                Plans That Grow With You
            </h2>
            <p class="text-gray-600 dark:text-gray-400" data-animate="fadeInUp" style="animation-delay:.1s">Start free, upgrade when you're ready. No hidden fees, cancel anytime.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto items-start">
            @foreach([
                ['name'=>'Starter','price'=>'Free','period'=>'forever','highlight'=>false,'badge'=>null,'features'=>['1 store','Up to 50 products','Basic order tracking','WhatsApp integration','Community support'],'cta'=>'Get Started Free','href'=>'register'],
                ['name'=>'Growth','price'=>'RM 29','period'=>'/month','highlight'=>true,'badge'=>'Most Popular','features'=>['3 stores','Unlimited products','Advanced analytics','Customer CRM','Priority email support','Custom store domain'],'cta'=>'Start 14-Day Trial','href'=>'register'],
                ['name'=>'Enterprise','price'=>'RM 79','period'=>'/month','highlight'=>false,'badge'=>null,'features'=>['Unlimited stores','Unlimited products','Full analytics suite','Dedicated account manager','API access','Custom integrations'],'cta'=>'Contact Sales','href'=>'register'],
            ] as $i => $plan)
            @php $delay = $i * 0.12; @endphp
            <div class="rounded-2xl border {{ $plan['highlight'] ? 'border-primary-500 shadow-2xl shadow-primary-500/20 scale-[1.02]' : 'border-gray-200 dark:border-gray-700 shadow-sm' }} overflow-hidden flex flex-col bg-white dark:bg-gray-800"
                 data-animate="fadeInUp" style="animation-delay:{{ $delay }}s">
                @if($plan['badge'])
                <div class="bg-primary-600 text-white text-center py-2 text-xs font-bold uppercase tracking-widest">{{ $plan['badge'] }}</div>
                @endif
                <div class="p-7 flex flex-col flex-1">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1">{{ $plan['name'] }}</h3>
                    <div class="flex items-end gap-1 mb-6">
                        <span class="text-4xl font-black text-gray-900 dark:text-white">{{ $plan['price'] }}</span>
                        <span class="text-gray-400 dark:text-gray-500 text-sm pb-1">{{ $plan['period'] }}</span>
                    </div>
                    <ul class="space-y-2.5 mb-8 flex-1">
                        @foreach($plan['features'] as $f)
                        <li class="flex items-center gap-2.5 text-sm text-gray-700 dark:text-gray-300">
                            <i class="hgi-stroke hgi-checkmark-circle-02 text-emerald-500 text-base shrink-0"></i>{{ $f }}
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ url($plan['href']) }}"
                       class="block text-center px-6 py-3 rounded-xl font-bold text-sm transition-all {{ $plan['highlight'] ? 'bg-primary-600 text-white hover:bg-primary-700 shadow-lg shadow-primary-500/30' : 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-600' }}">
                        {{ $plan['cta'] }}
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════════════════
     CTA BANNER
══════════════════════════════════════════════════════════════════ --}}
<section class="bg-gradient-to-br from-primary-600 to-primary-700 dark:from-primary-700 dark:to-primary-900 py-20 border-t border-primary-700 dark:border-primary-800 transition-colors duration-200">
    <div class="container mx-auto px-4 sm:px-6 text-center" data-animate="fadeInUp">
        <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4">
            Ready to Transform Your Business?
        </h2>
        <p class="text-primary-100 dark:text-primary-200 mb-8 max-w-xl mx-auto text-lg">
            Join 5,000+ Malaysian businesses already managing smarter with OMS. It's free to start — no credit card required.
        </p>
        <div class="flex flex-col sm:flex-row justify-center items-center gap-3">
            <a href="{{ url('register') }}"
               class="px-8 py-4 bg-white dark:bg-gray-900 text-primary-700 dark:text-primary-400 rounded-xl font-bold shadow-xl hover:bg-primary-50 dark:hover:bg-gray-800 hover:-translate-y-0.5 transition-all flex items-center gap-2">
                Create Free Account <i class="hgi-stroke hgi-arrow-right-01"></i>
            </a>
            <a href="{{ url('login') }}"
               class="px-8 py-4 bg-white/10 dark:bg-white/5 text-white border border-white/30 dark:border-white/20 rounded-xl font-bold hover:bg-white/20 dark:hover:bg-white/10 transition-all flex items-center gap-2">
                <i class="hgi-stroke hgi-login-02"></i> Sign In
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
/**
 * Scroll-reveal using IntersectionObserver + Animate.css v4
 *
 * Correct usage:
 *   - Elements carry [data-animate] with the animation name (e.g. "fadeInUp")
 *   - Optionally set a custom delay via inline style="animation-delay: Xs"
 *   - The layout CSS hides [data-animate] elements (opacity:0)
 *   - When the element enters the viewport we add animate__animated + animate__<name>
 *     which triggers the CSS keyframe animation, then restore opacity.
 */
document.addEventListener('DOMContentLoaded', function () {
    var animatableEls = document.querySelectorAll('[data-animate]');

    if (!animatableEls.length) return;

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (!entry.isIntersecting) return;

            var el        = entry.target;
            var animation = el.dataset.animate;      // e.g. "fadeInUp"

            // Restore visibility and attach Animate.css classes
            el.style.opacity = '';
            el.classList.add('animate__animated', 'animate__' + animation);

            // Stop observing — animate only once
            observer.unobserve(el);
        });
    }, {
        threshold:   0.12,
        rootMargin: '0px 0px -40px 0px'
    });

    animatableEls.forEach(function (el) { observer.observe(el); });
});
</script>
@endpush