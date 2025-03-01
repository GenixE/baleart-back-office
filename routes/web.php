<?php

use App\Http\Controllers\BackOffice\SpaceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'check.role'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // BackOffice routes
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::resource('spaces', SpaceController::class);
    });

    // Add other routes that should be protected by role check here
});

require __DIR__.'/auth.php';
