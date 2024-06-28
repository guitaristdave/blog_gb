<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // @GET /own-posts -> feed/me
    // @GET /profile
    // @PATCH /profile
    // @POST /profile
    // @DELETE /profile
    Route::get('/own-posts', [ProfileController::class, 'posts'])->name('feed.posts'); // TODO вынести отсюда нафиг
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'updateUser'])->name('profile.update-user');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
