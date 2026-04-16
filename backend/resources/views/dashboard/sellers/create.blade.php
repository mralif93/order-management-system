@extends('layouts.dashboard')

@section('title', 'Add New Seller | OMS Admin')

@section('content')
<div class="max-w-[1600px] mx-auto space-y-8 pb-12 transition-colors duration-300">
    <!-- Header -->
    <div class="flex items-center gap-4 animate__animated animate__fadeInLeft">
        <a href="javascript:history.back()" class="text-secondary-400 hover:text-primary-600 transition-colors">
            <i class="hgi-stroke hgi-arrow-left-01 text-2xl"></i>
        </a>
        <div>
            <h1 class="text-3xl font-extrabold text-secondary-900 dark:text-white tracking-tight leading-none">Add New Seller</h1>
            <p class="text-secondary-500 dark:text-slate-400 mt-1 font-medium">Create a new seller account in the system.</p>
        </div>
    </div>

    <form action="{{ route('admin.sellers.store') }}" method="POST" class="space-y-8 animate__animated animate__fadeInUp">
        @csrf

        <!-- Personal Information -->
        <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 p-8 space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b dark:border-slate-800">
                <div class="w-10 h-10 rounded-xl bg-violet-100 dark:bg-violet-900/30 text-violet-600 flex items-center justify-center">
                    <i class="hgi-stroke hgi-user text-xl"></i>
                </div>
                <div>
                    <h2 class="font-black text-secondary-900 dark:text-white uppercase tracking-tighter">Personal Information</h2>
                    <p class="text-[10px] text-secondary-400 dark:text-slate-500 uppercase tracking-widest">Basic seller details</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">Full Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200 @error('name') ring-2 ring-red-500 @enderror"
                        placeholder="John Doe">
                    @error('name')<p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">Email Address <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200 @error('email') ring-2 ring-red-500 @enderror"
                        placeholder="john@example.com">
                    @error('email')<p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">Password <span class="text-red-500">*</span></label>
                    <input type="password" name="password" required
                        class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200 @error('password') ring-2 ring-red-500 @enderror"
                        placeholder="••••••••">
                    @error('password')<p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>@enderror
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200"
                        placeholder="+60 12-XXXXXXX">
                </div>
            </div>
        </div>

        <!-- Address -->
        <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-gray-100 dark:border-slate-800 p-8 space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b dark:border-slate-800">
                <div class="w-10 h-10 rounded-xl bg-secondary-100 dark:bg-slate-800 text-secondary-600 dark:text-slate-400 flex items-center justify-center">
                    <i class="hgi-stroke hgi-location-01 text-xl"></i>
                </div>
                <div>
                    <h2 class="font-black text-secondary-900 dark:text-white uppercase tracking-tighter">Business Address</h2>
                    <p class="text-[10px] text-secondary-400 dark:text-slate-500 uppercase tracking-widest">Optional location details</p>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="sm:col-span-2 space-y-2">
                    <label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">Address Line 1</label>
                    <input type="text" name="address_line1" value="{{ old('address_line1') }}"
                        class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200"
                        placeholder="Street address">
                </div>
                <div class="sm:col-span-2 space-y-2">
                    <label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">Address Line 2</label>
                    <input type="text" name="address_line2" value="{{ old('address_line2') }}"
                        class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200"
                        placeholder="Apartment, suite, etc.">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">City</label>
                    <input type="text" name="city" value="{{ old('city') }}"
                        class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200"
                        placeholder="Kuala Lumpur">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">State</label>
                    <input type="text" name="state" value="{{ old('state') }}"
                        class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200"
                        placeholder="Selangor">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">Postal Code</label>
                    <input type="text" name="postal_code" value="{{ old('postal_code') }}"
                        class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200"
                        placeholder="50000">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest">Country</label>
                    <input type="text" name="country" value="{{ old('country', 'Malaysia') }}"
                        class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200"
                        placeholder="Malaysia">
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end gap-4">
            <a href="{{ route('admin.sellers.index') }}" class="px-8 py-4 bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-700 text-secondary-700 dark:text-slate-300 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-gray-50 dark:hover:bg-slate-800 transition">
                Cancel
            </a>
            <button type="submit" class="px-10 py-4 bg-primary-600 text-white rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-primary-600/20 hover:-translate-y-1 transition-all active:scale-95">
                <i class="hgi-stroke hgi-user-add-01 mr-2"></i> Create Seller
            </button>
        </div>
    </form>
</div>
@endsection

