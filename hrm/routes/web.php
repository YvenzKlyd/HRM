<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\BookingController as UserBookingController;
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
    Route::get('/rooms/{room}', [UserController::class, 'showRoom'])->name('rooms.show');
    Route::get('/bookings', [UserBookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings', [UserBookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [UserBookingController::class, 'show'])->name('bookings.show');
    Route::get('/bookings/{booking}/download', [UserBookingController::class, 'download'])->name('bookings.download');

});

// admin routes
Route::middleware(['auth', 'adminMiddleware'])->prefix('admin')->name('admin.')->group(function(){

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('rooms', RoomController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('services', ServiceController::class);

    // Reports routes
    Route::get('/reports', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/export', [App\Http\Controllers\Admin\ReportController::class, 'export'])->name('reports.export');

});
