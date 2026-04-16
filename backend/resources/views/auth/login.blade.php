@extends('layouts.public')

@section('title', ($title ?? 'Log In') . ' | Order Management System')

@section('content')
    <main
        class="flex-grow flex items-center justify-center p-6 min-h-screen bg-primary-50 dark:bg-gray-900 transition-colors duration-200">
        <div
            class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-8 animate__animated animate__zoomIn transition-colors duration-200">
            <div class="text-center mb-8">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary-100 dark:bg-primary-900/40 text-primary-600 dark:text-primary-400 mb-4 animate__animated animate__flipInY transition-colors duration-200">
                    <i class="hgi-stroke hgi-login-03 text-3xl"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 dark:text-white transition-colors duration-200">
                    {{ $title ?? 'Welcome Back' }}
                </h2>
                <p class="text-gray-500 dark:text-gray-400 mt-2 transition-colors duration-200">Please enter your details to
                    sign in.</p>
            </div>

            {{-- Success flash --}}
            @if(session('success'))
                <div
                    class="flex items-center gap-3 mb-6 px-4 py-3 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-700 text-emerald-700 dark:text-emerald-400 rounded-xl text-sm font-semibold animate__animated animate__fadeInDown">
                    <i class="hgi-stroke hgi-checkmark-circle-01 text-lg flex-shrink-0"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error flash or validation errors --}}
            @if(session('error'))
                <div
                    class="flex items-center gap-3 mb-6 px-4 py-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 text-red-700 dark:text-red-400 rounded-xl text-sm font-semibold animate__animated animate__fadeInDown">
                    <i class="hgi-stroke hgi-alert-circle text-lg flex-shrink-0"></i>
                    {{ session('error') }}
                </div>
            @elseif($errors->any())
                <div
                    class="flex items-start gap-3 mb-6 px-4 py-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 text-red-700 dark:text-red-400 rounded-xl text-sm font-semibold animate__animated animate__fadeInDown">
                    <i class="hgi-stroke hgi-alert-circle text-lg flex-shrink-0 mt-0.5"></i>
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                action="{{ isset($isAdmin) && $isAdmin ? url('admin/login') : (isset($isSeller) && $isSeller ? url('seller/login') : url('login')) }}"
                method="POST" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 transition-colors duration-200">Email
                        Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i
                                class="hgi-stroke hgi-mail-01 text-gray-400 dark:text-gray-500 transition-colors duration-200"></i>
                        </div>
                        <input type="email" id="email" name="email"
                            class="pl-10 w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-all outline-none dark:text-white"
                            placeholder="Enter your email" required autofocus>
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 transition-colors duration-200">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i
                                class="hgi-stroke hgi-lock-password text-gray-400 dark:text-gray-500 transition-colors duration-200"></i>
                        </div>
                        <input type="password" id="password" name="password"
                            class="pl-10 w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-all outline-none dark:text-white"
                            placeholder="••••••••" required>
                    </div>
                </div>

                <!-- Remember & Forgot -->
                <div class="flex items-center justify-between mt-2">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                            class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded transition-colors duration-200">
                        <label for="remember"
                            class="ml-2 block text-sm text-gray-700 dark:text-gray-300 transition-colors duration-200">
                            Remember me
                        </label>
                    </div>
                    <div class="text-sm">
                        <a href="{{ url('forgot-password') }}"
                            class="font-medium text-primary-600 hover:text-primary-500 transition">
                            Forgot password?
                        </a>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors mt-6">
                    Sign In
                </button>
            </form>

            @if(!isset($isAdmin))
                <div class="mt-8 text-center text-sm text-gray-600 dark:text-gray-400 transition-colors duration-200">
                    Don't have an account?
                    <a href="{{ isset($isSeller) && $isSeller ? route('seller.register') : route('register') }}"
                        class="font-bold text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300 transition-colors duration-200">
                        Sign up now
                    </a>
                </div>
            @endif
        </div>
    </main>
@endsection