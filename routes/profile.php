<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'updateUser'])->name('profile.update-user');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/manage', [ProfileController::class, 'manageUsers'])->name('profile.manage-users');
    Route::delete('/manage', [ProfileController::class, 'destroyUser'])->name('profile.destroy-user');
});
