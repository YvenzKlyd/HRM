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
});

require __DIR__.'/auth.php';

// user routes
Route::middleware(['auth', 'userMiddleware'])->group(function(){

    Route::get('dashboard', [UserController::class,'index'])->name('dashboard');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

});

// admin routes
Route::middleware(['auth', 'adminMiddleware'])->prefix('admin')->name('admin.')->group(function(){

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('rooms', RoomController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

});
