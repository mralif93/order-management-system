<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\PublicController;
use App\Http\Controllers\Public\PublicStoreController;
use App\Http\Controllers\Seller\SellerStoreController;
use App\Http\Controllers\Dashboard\AdminDashboardController;
use App\Http\Controllers\Dashboard\AdminProductController;
use App\Http\Controllers\Dashboard\AdminOrderController;
use App\Http\Controllers\Dashboard\AdminCustomerController;
use App\Http\Controllers\Dashboard\AdminSellerController;
use App\Http\Controllers\Dashboard\AdminSellerStoreController;
use App\Http\Controllers\Customer\CustomerOrderController;
use App\Http\Controllers\Customer\CustomerProductController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Seller\SellerProductController;
use App\Http\Controllers\Seller\SellerOrderController;
use App\Http\Controllers\Auth\AuthController;

// Public Routes
Route::get('/', [PublicController::class, 'index'])->name('public.index');
Route::get('/shop/{slug}', [PublicStoreController::class, 'show'])->name('public.store');

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

// Seller Auth Routes
Route::prefix('seller')->group(function () {
    Route::middleware('guest:seller')->group(function () {
        Route::get('/login', [AuthController::class, 'showSellerLogin'])->name('seller.login');
        Route::post('/login', [AuthController::class, 'sellerLogin']);
        Route::get('/register', [AuthController::class, 'showSellerRegister'])->name('seller.register');
        Route::post('/register', [AuthController::class, 'sellerRegister']);
    });
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/seller/logout', [AuthController::class, 'sellerLogout'])->name('seller.logout');
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');

// Admin Routes (Protected)
Route::middleware(['auth:web'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [AdminDashboardController::class, 'profile'])->name('profile');
    Route::patch('/profile', [AdminDashboardController::class, 'profileUpdate'])->name('profile.update');
    Route::patch('/profile/password', [AdminDashboardController::class, 'passwordUpdate'])->name('profile.password');
    Route::resource('products', AdminProductController::class);
    Route::resource('orders', AdminOrderController::class);
    Route::resource('customers', AdminCustomerController::class);
    Route::resource('sellers', AdminSellerController::class);
    // Admin stores CRUD
    Route::resource('stores', AdminSellerStoreController::class)->parameters(['stores' => 'seller']);
    Route::post('stores/{seller}/products/{product}/featured', [AdminSellerStoreController::class, 'toggleFeatured'])->name('stores.featured.toggle');
    // Alias routes used by the embedded panel on seller show page
    Route::patch('sellers/{seller}/store', [AdminSellerStoreController::class, 'update'])->name('sellers.store.update');
    Route::delete('sellers/{seller}/store/slug', [AdminSellerStoreController::class, 'destroy'])->name('sellers.store.reset');
    Route::post('sellers/{seller}/store/products/{product}/featured', [AdminSellerStoreController::class, 'toggleFeatured'])->name('sellers.store.featured.toggle');
});

// Customer Routes (Protected)
Route::middleware(['auth:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'index'])->name('dashboard');
    Route::get('/profile', [CustomerController::class, 'profile'])->name('profile');
    Route::patch('/profile', [CustomerController::class, 'profileUpdate'])->name('profile.update');
    Route::patch('/profile/password', [CustomerController::class, 'passwordUpdate'])->name('profile.password');
    Route::resource('orders', CustomerOrderController::class);
    Route::get('catalog', [CustomerProductController::class, 'index'])->name('catalog.index');
});

// Seller Routes (Protected)
Route::middleware(['auth:seller'])->prefix('seller')->name('seller.')->group(function () {
    Route::get('/', [SellerController::class, 'index'])->name('index');
    Route::get('/dashboard', [SellerController::class, 'index'])->name('dashboard');
    Route::get('/profile', [SellerController::class, 'profile'])->name('profile');
    Route::patch('/profile', [SellerController::class, 'profileUpdate'])->name('profile.update');
    Route::patch('/profile/password', [SellerController::class, 'passwordUpdate'])->name('profile.password');
    Route::resource('products', SellerProductController::class);
    Route::resource('orders', SellerOrderController::class);
    // Store management
    Route::get('store', [SellerStoreController::class, 'index'])->name('store.index');
    Route::post('store/setup', [SellerStoreController::class, 'setup'])->name('store.setup');
    Route::patch('store', [SellerStoreController::class, 'update'])->name('store.update');
    Route::post('store/products/{product}/featured', [SellerStoreController::class, 'toggleFeatured'])->name('store.featured.toggle');
});