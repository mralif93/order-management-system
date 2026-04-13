<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\public\PublicController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\customer\CustomerController;
use App\Http\Controllers\auth\AuthController;

// Public Routes
Route::get('/', [PublicController::class, 'index'])->name('public.index');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Customer Routes
Route::get('/customer/dashboard', [CustomerController::class, 'index'])->name('customer.index');