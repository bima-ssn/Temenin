<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CustomerController::class, 'landing'])->name('landing');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'redirectToRoleDashboard'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('customer')
    ->name('customer.')
    ->middleware(['auth', 'verified', 'customer'])
    ->group(function () {
        Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
        Route::get('/mitra', [CustomerController::class, 'mitraIndex'])->name('mitra.index');
        Route::get('/mitra/{profile}', [CustomerController::class, 'mitraShow'])->name('mitra.show');
        Route::get('/mitra/{profile}/booking', [CustomerController::class, 'bookingForm'])->name('booking.form');
        Route::post('/mitra/{profile}/booking', [BookingController::class, 'store'])->name('booking.store');

        Route::get('/bookings/{booking}/payment', [PaymentController::class, 'show'])->name('payments.show');
        Route::post('/bookings/{booking}/payment', [PaymentController::class, 'store'])->name('payments.store');

        Route::get('/bookings/{booking}/chat', [ChatController::class, 'index'])->name('chat.show');
        Route::post('/bookings/{booking}/chat', [ChatController::class, 'store'])->name('chat.store');

        Route::post('/bookings/{booking}/review', [CustomerController::class, 'storeReview'])->name('reviews.store');
    });

Route::prefix('mitra')
    ->name('mitra.')
    ->middleware(['auth', 'verified', 'mitra'])
    ->group(function () {
        Route::get('/dashboard', [MitraController::class, 'dashboard'])->name('dashboard');
        Route::get('/bookings', [MitraController::class, 'bookings'])->name('bookings');
        Route::get('/approval-status', [MitraController::class, 'approval'])->name('approval');
        Route::get('/profile', [MitraController::class, 'profile'])->name('profile');
        Route::post('/profile', [MitraController::class, 'updateProfile'])->name('profile.update');

        Route::post('/bookings/{booking}/approve', [BookingController::class, 'approve'])->name('bookings.approve');
        Route::post('/bookings/{booking}/reject', [BookingController::class, 'reject'])->name('bookings.reject');
        Route::post('/bookings/{booking}/complete', [BookingController::class, 'complete'])->name('bookings.complete');

        Route::get('/bookings/{booking}/chat', [ChatController::class, 'index'])->name('chat.show');
        Route::post('/bookings/{booking}/chat', [ChatController::class, 'store'])->name('chat.store');
    });

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'verified', 'admin'])
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/approvals', [AdminController::class, 'approvals'])->name('approvals');
        Route::post('/approvals/{profile}/approve', [AdminController::class, 'approveMitra'])->name('approvals.approve');
        Route::post('/approvals/{profile}/reject', [AdminController::class, 'rejectMitra'])->name('approvals.reject');

        Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
        Route::get('/mitra', [AdminController::class, 'mitra'])->name('mitra');
        Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
    });

require __DIR__.'/auth.php';
