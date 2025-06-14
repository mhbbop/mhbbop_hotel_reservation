<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Guest\DashboardController as GuestDashboardController;
use App\Http\Controllers\Guest\RoomController as GuestRoomController;
use App\Http\Controllers\Guest\ReservationController as GuestReservationController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;

// RUTE PUBLIK
Route::get('/', function () {
    return view('welcome');
});

// RUTE UNTUK TAMU (WAJIB LOGIN)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [GuestDashboardController::class, 'index'])->name('dashboard');
    Route::get('/rooms', [GuestRoomController::class, 'index'])->name('guest.rooms.index');
    Route::get('/rooms/{room}', [GuestRoomController::class, 'show'])->name('guest.rooms.show');
    Route::post('/reservations', [GuestReservationController::class, 'store'])->name('guest.reservations.store');
    Route::get('/reservations/{reservation}/payment', [GuestReservationController::class, 'payment'])->name('guest.reservations.payment');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// RUTE UNTUK ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::post('/reservations/{reservation}/confirm', [AdminReservationController::class, 'confirmPayment'])->name('reservations.confirm');
    Route::resource('rooms', AdminRoomController::class);
    Route::resource('reservations', AdminReservationController::class);
});

// RUTE AUTENTIKASI
require __DIR__.'/auth.php';