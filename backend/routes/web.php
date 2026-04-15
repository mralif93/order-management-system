<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\public\PublicController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\dashboard\ProductController;
use App\Http\Controllers\dashboard\OrderController;
use App\Http\Controllers\customer\CustomerController;
use App\Http\Controllers\auth\AuthController;

// Public Routes
Route::get('/', [PublicController::class, 'index'])->name('public.index');

// Customer Auth Routes
Route::middleware('guest:customer')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Admin Auth Routes
Route::prefix('admin')->group(function () {
    Route::middleware('guest:web')->group(function () {
        Route::get('/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
        Route::post('/login', [AuthController::class, 'adminLogin']);
    });
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');

// Admin Routes (Protected)
Route::middleware(['auth:web'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'update']);
    Route::resource('customers', \App\Http\Controllers\dashboard\CustomerController::class);
});

// Customer Routes (Protected)
Route::middleware(['auth:customer'])->prefix('customer')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/orders', [CustomerController::class, 'orders'])->name('customer.orders.index');
    Route::get('/orders/{order}', [CustomerController::class, 'orderShow'])->name('customer.orders.show');
    Route::get('/products', [CustomerController::class, 'products'])->name('customer.products.index');
    Route::get('/profile', [CustomerController::class, 'profile'])->name('customer.profile');
});