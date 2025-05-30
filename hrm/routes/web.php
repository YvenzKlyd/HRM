<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Payment routes
    Route::get('/bookings/{booking}/payment', [PaymentController::class, 'showPaymentForm'])->name('payments.form');
    Route::post('/bookings/{booking}/payment', [PaymentController::class, 'processPayment'])->name('payments.process');
});

require __DIR__.'/auth.php';

// user routes
Route::middleware(['auth', 'userMiddleware'])->group(function(){

    Route::get('dashboard', [UserController::class,'index'])->name('dashboard');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');

});

// admin routes
Route::middleware(['auth', 'adminMiddleware'])->prefix('admin')->name('admin.')->group(function(){

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('rooms', RoomController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('bookings', \App\Http\Controllers\Admin\BookingController::class)->only(['index', 'show']);

});
