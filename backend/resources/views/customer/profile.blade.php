@extends('layouts.customer')

@section('title', 'Profile Settings | OMS Portal')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 pb-12 transition-colors duration-300">
    <!-- Header -->
    <div class="animate__animated animate__fadeInDown">
        <h1 class="text-3xl font-black text-secondary-900 dark:text-white tracking-tighter uppercase leading-none">Account Settings</h1>
        <p class="text-secondary-500 dark:text-slate-400 mt-2 font-medium">Manage your personal information, address, and security preferences.</p>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 p-4 rounded-2xl border border-emerald-100 dark:border-emerald-800 flex items-center gap-3 animate__animated animate__fadeIn">
        <i class="hgi-stroke hgi-tick-01 text-xl"></i>
        <span class="text-sm font-bold">{{ session('success') }}</span>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 animate__animated animate__fadeInUp">
        <!-- Sidebar Navigation (Settings Tabs) -->
        <div class="space-y-2">
            <button class="w-full flex items-center gap-3 px-5 py-3 rounded-2xl bg-primary-600 text-white font-black text-xs uppercase tracking-widest shadow-lg shadow-primary-600/30 transition-all">
                <i class="hgi-stroke hgi-user text-lg"></i> Personal Info
            </button>
            <button class="w-full flex items-center gap-3 px-5 py-3 rounded-2xl text-secondary-500 dark:text-slate-400 font-black text-xs uppercase tracking-widest hover:bg-white dark:hover:bg-slate-900 transition-all">
                <i class="hgi-stroke hgi-location-01 text-lg"></i> Addresses
            </button>
            <button class="w-full flex items-center gap-3 px-5 py-3 rounded-2xl text-secondary-500 dark:text-slate-400 font-black text-xs uppercase tracking-widest hover:bg-white dark:hover:bg-slate-900 transition-all">
                <i class="hgi-stroke hgi-security-check text-lg"></i> Security
            </button>
        </div>

        <!-- Form Content -->
        <div class="md:col-span-2 space-y-8">
            <!-- Basic Info Card -->
            <form action="#" method="POST" class="bg-white dark:bg-slate-900 rounded-[32px] p-8 shadow-sm border border-gray-100 dark:border-slate-800 space-y-8">
                <div class="flex items-center gap-4 pb-6 border-b dark:border-slate-800">
                    <div class="w-16 h-16 rounded-3xl bg-primary-600 text-white flex items-center justify-center text-2xl font-black shadow-xl">
                        {{ substr($customer->name, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter leading-none mb-1">{{ $customer->name }}</h3>
                        <p class="text-[10px] text-primary-600 dark:text-primary-400 font-black uppercase tracking-widest">Premium Member since 2026</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest ml-1">Full Name</label>
                        <input type="text" name="name" value="{{ $customer->name }}" class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest ml-1">Email Address</label>
                        <input type="email" name="email" value="{{ $customer->email }}" class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest ml-1">Phone Number</label>
                        <input type="text" name="phone" value="{{ $customer->phone ?? '+60 12-XXXXXXX' }}" class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest ml-1">Language</label>
                        <select class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200">
                            <option>English (US)</option>
                            <option>Malay (BM)</option>
                            <option>Singaporean (EN)</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest ml-1">Bio / Notes</label>
                    <textarea rows="3" class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200 resize-none" placeholder="Write something about yourself..."></textarea>
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit" class="px-10 py-4 bg-secondary-900 dark:bg-primary-600 text-white rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-secondary-900/20 dark:shadow-primary-600/20 hover:-translate-y-1 transition-all active:scale-95">
                        Save Changes
                    </button>
                </div>
            </form>

            <!-- Danger Zone -->
            <div class="bg-red-50 dark:bg-red-900/10 rounded-[32px] p-8 border border-red-100 dark:border-red-900/30">
                <h4 class="text-sm font-black text-red-700 dark:text-red-400 uppercase tracking-widest mb-2">Danger Zone</h4>
                <p class="text-xs text-red-600 dark:text-red-400/60 font-medium mb-6">Once you delete your account, there is no going back. Please be certain.</p>
                <button class="px-6 py-3 bg-red-600 text-white rounded-xl text-xs font-black uppercase tracking-widest hover:bg-red-700 transition">Delete Account</button>
            </div>
        </div>
    </div>
</div>
@endsection
