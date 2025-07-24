<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\QrcodeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('user/register', [UserController::class, 'showRegistrationForm'])->name('user.register');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('user/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('user/auth', [UserController::class, 'login'])->name('user.auth');
});

Route::middleware('auth')->group(function() {
    Route::get('plans', [PlanController::class, 'index'])->name('plans.index');
    Route::get('subscribe/{plan}/plan', [SubscriptionController::class, 'showSubscriptionForm'])->name('subscription.show');
    Route::post('subscribe', [SubscriptionController::class, 'createCheckoutSession'])->name('subscription.create');
    Route::post('subscribe/cancel', [SubscriptionController::class, 'cancel'])->name('subscription.cancel');
    Route::resource('qrcodes', QrcodeController::class)->except(['show']);
    Route::middleware('trial')->group(function() {
        Route::resource('qrcodes', QrcodeController::class)->only(
            ['create','store','edit','update']
        );
    });
    Route::post('user/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');
});