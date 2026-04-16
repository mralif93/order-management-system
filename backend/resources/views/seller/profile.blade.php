@extends('layouts.seller')

@section('title', 'Profile Settings | Seller Portal')

@section('content')
<div x-data="{ tab: 'personal' }" class="max-w-[1600px] mx-auto space-y-8 pb-12">
    <!-- Header -->
    <div class="animate__animated animate__fadeInDown">
        <h1 class="text-3xl font-black text-secondary-900 dark:text-white tracking-tighter uppercase leading-none">Account Settings</h1>
        <p class="text-secondary-500 dark:text-slate-400 mt-2 font-medium">Manage your seller profile, address, and security.</p>
    </div>

    @if(session('success'))
    <div class="bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 p-4 rounded-2xl border border-emerald-100 dark:border-emerald-800 flex items-center gap-3 animate__animated animate__fadeIn">
        <i class="hgi-stroke hgi-checkmark-circle-01 text-xl"></i>
        <span class="text-sm font-bold">{{ session('success') }}</span>
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400 p-4 rounded-2xl border border-red-100 dark:border-red-800 animate__animated animate__fadeIn">
        <ul class="text-sm font-medium space-y-1 list-disc ml-4">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 animate__animated animate__fadeInUp">
        <!-- Sidebar Tabs -->
        <div class="space-y-2">
            <button @click="tab='personal'" :class="tab==='personal' ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/30' : 'text-secondary-500 dark:text-slate-400 hover:bg-white dark:hover:bg-slate-900'"
                class="w-full flex items-center gap-3 px-5 py-3 rounded-2xl font-black text-xs uppercase tracking-widest transition-all">
                <i class="hgi-stroke hgi-user text-lg"></i> Personal Info
            </button>
            <button @click="tab='address'" :class="tab==='address' ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/30' : 'text-secondary-500 dark:text-slate-400 hover:bg-white dark:hover:bg-slate-900'"
                class="w-full flex items-center gap-3 px-5 py-3 rounded-2xl font-black text-xs uppercase tracking-widest transition-all">
                <i class="hgi-stroke hgi-location-01 text-lg"></i> Address
            </button>
            <button @click="tab='security'" :class="tab==='security' ? 'bg-primary-600 text-white shadow-lg shadow-primary-600/30' : 'text-secondary-500 dark:text-slate-400 hover:bg-white dark:hover:bg-slate-900'"
                class="w-full flex items-center gap-3 px-5 py-3 rounded-2xl font-black text-xs uppercase tracking-widest transition-all">
                <i class="hgi-stroke hgi-security-lock text-lg"></i> Security
            </button>
        </div>

        <div class="md:col-span-2">
            <!-- Personal Info Tab -->
            <div x-show="tab==='personal'" class="animate__animated animate__fadeIn">
                <form action="{{ route('seller.profile.update') }}" method="POST"
                    class="bg-white dark:bg-slate-900 rounded-[32px] p-8 shadow-sm border border-gray-100 dark:border-slate-800 space-y-6">
                    @csrf @method('PATCH')
                    <div class="flex items-center gap-4 pb-6 border-b dark:border-slate-800">
                        <div class="w-16 h-16 rounded-3xl bg-primary-600 text-white flex items-center justify-center text-2xl font-black shadow-xl">
                            {{ strtoupper(substr($seller->name, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="text-lg font-black text-secondary-900 dark:text-white uppercase tracking-tighter leading-none">{{ $seller->name }}</h3>
                            <p class="text-[10px] text-primary-600 dark:text-primary-400 font-black uppercase tracking-widest mt-1">Seller Account</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest ml-1">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', $seller->name) }}" required
                                class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest ml-1">Email Address</label>
                            <input type="email" name="email" value="{{ old('email', $seller->email) }}" required
                                class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200">
                        </div>
                        <div class="space-y-2 sm:col-span-2">
                            <label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest ml-1">Phone Number</label>
                            <input type="text" name="phone" value="{{ old('phone', $seller->phone) }}"
                                class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200">
                        </div>
                    </div>
                    <div class="flex justify-end pt-2">
                        <button type="submit" class="px-10 py-4 bg-secondary-900 dark:bg-primary-600 text-white rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl hover:-translate-y-1 transition-all active:scale-95">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>

            <!-- Address Tab -->
            <div x-show="tab==='address'" class="animate__animated animate__fadeIn">
                <form action="{{ route('seller.profile.update') }}" method="POST"
                    class="bg-white dark:bg-slate-900 rounded-[32px] p-8 shadow-sm border border-gray-100 dark:border-slate-800 space-y-6">
                    @csrf @method('PATCH')
                    <input type="hidden" name="name" value="{{ $seller->name }}">
                    <input type="hidden" name="email" value="{{ $seller->email }}">
                    <h3 class="text-base font-black text-secondary-900 dark:text-white uppercase tracking-tighter pb-4 border-b dark:border-slate-800">Business Address</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="space-y-2 sm:col-span-2"><label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest ml-1">Address Line 1</label>
                            <input type="text" name="address_line1" value="{{ old('address_line1', $seller->address_line1) }}" class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200"></div>
                        <div class="space-y-2 sm:col-span-2"><label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest ml-1">Address Line 2</label>
                            <input type="text" name="address_line2" value="{{ old('address_line2', $seller->address_line2) }}" class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200"></div>
                        <div class="space-y-2 sm:col-span-2"><label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest ml-1">Address Line 3</label>
                            <input type="text" name="address_line3" value="{{ old('address_line3', $seller->address_line3) }}" class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200"></div>
                        <div class="space-y-2"><label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest ml-1">City</label>
                            <input type="text" name="city" value="{{ old('city', $seller->city) }}" class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200"></div>
                        <div class="space-y-2"><label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest ml-1">State</label>
                            <input type="text" name="state" value="{{ old('state', $seller->state) }}" class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200"></div>
                        <div class="space-y-2"><label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest ml-1">Postal Code</label>
                            <input type="text" name="postal_code" value="{{ old('postal_code', $seller->postal_code) }}" class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200"></div>
                        <div class="space-y-2"><label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest ml-1">Country</label>
                            <input type="text" name="country" value="{{ old('country', $seller->country) }}" class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200"></div>
                    </div>
                    <div class="flex justify-end pt-2">
                        <button type="submit" class="px-10 py-4 bg-secondary-900 dark:bg-primary-600 text-white rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl hover:-translate-y-1 transition-all active:scale-95">Save Address</button>
                    </div>
                </form>
            </div>

            <!-- Security Tab -->
            <div x-show="tab==='security'" class="animate__animated animate__fadeIn">
                <form action="{{ route('seller.profile.password') }}" method="POST"
                    class="bg-white dark:bg-slate-900 rounded-[32px] p-8 shadow-sm border border-gray-100 dark:border-slate-800 space-y-6">
                    @csrf @method('PATCH')
                    <h3 class="text-base font-black text-secondary-900 dark:text-white uppercase tracking-tighter pb-4 border-b dark:border-slate-800">Change Password</h3>
                    <div class="space-y-5">
                        <div class="space-y-2"><label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest ml-1">Current Password</label>
                            <input type="password" name="current_password" required class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200"></div>
                        <div class="space-y-2"><label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest ml-1">New Password</label>
                            <input type="password" name="new_password" required class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200"></div>
                        <div class="space-y-2"><label class="text-[10px] font-black text-secondary-400 dark:text-slate-500 uppercase tracking-widest ml-1">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation" required class="w-full px-5 py-3.5 bg-gray-50 dark:bg-slate-800 border-none rounded-2xl text-sm font-medium focus:ring-2 focus:ring-primary-600/50 outline-none dark:text-slate-200"></div>
                    </div>
                    <div class="flex justify-end pt-2">
                        <button type="submit" class="px-10 py-4 bg-secondary-900 dark:bg-primary-600 text-white rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl hover:-translate-y-1 transition-all active:scale-95">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
