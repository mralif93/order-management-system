@extends('layouts.public')

@section('title', 'Register | Order Management System')

@section('content')
<main class="flex-grow flex items-center justify-center p-6 min-h-screen bg-primary-50 dark:bg-gray-900 transition-colors duration-200">
    <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-8 animate__animated animate__zoomIn transition-colors duration-200">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary-100 dark:bg-primary-900/40 text-primary-600 dark:text-primary-400 mb-4 animate__animated animate__flipInY transition-colors duration-200">
                <i class="hgi-stroke hgi-user-add-01 text-3xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 dark:text-white transition-colors duration-200">Create an Account</h2>
            <p class="text-gray-500 dark:text-gray-400 mt-2 transition-colors duration-200">Join us and start managing your orders.</p>
        </div>

        <form action="{{ url('register') }}" method="POST" class="space-y-4">
            @csrf
            
            <!-- Full Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 transition-colors duration-200">Full Name</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="hgi-stroke hgi-user text-gray-400 dark:text-gray-500 transition-colors duration-200"></i>
                    </div>
                    <input type="text" id="name" name="name" class="pl-10 w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-all outline-none dark:text-white" placeholder="John Doe" required autofocus>
                </div>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 transition-colors duration-200">Email Address</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="hgi-stroke hgi-mail-01 text-gray-400 dark:text-gray-500 transition-colors duration-200"></i>
                    </div>
                    <input type="email" id="email" name="email" class="pl-10 w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-all outline-none dark:text-white" placeholder="Enter your email" required>
                </div>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 transition-colors duration-200">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="hgi-stroke hgi-lock-password text-gray-400 dark:text-gray-500 transition-colors duration-200"></i>
                    </div>
                    <input type="password" id="password" name="password" class="pl-10 w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-all outline-none dark:text-white" placeholder="••••••••" required>
                </div>
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 transition-colors duration-200">Confirm Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="hgi-stroke hgi-shield-check text-gray-400 dark:text-gray-500 transition-colors duration-200"></i>
                    </div>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="pl-10 w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary-600 focus:border-transparent transition-all outline-none dark:text-white" placeholder="••••••••" required>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors mt-6">
                Create Account
            </button>
        </form>

        <div class="mt-8 text-center text-sm text-gray-600 dark:text-gray-400 transition-colors duration-200">
            Already have an account? 
            <a href="{{ url('login') }}" class="font-bold text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300 transition-colors duration-200">
                Log in here
            </a>
        </div>
    </div>
</main>
@endsection
