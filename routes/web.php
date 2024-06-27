<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/own-posts', [ProfileController::class, 'posts'])->name('profile.posts');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'updateUser'])->name('profile.update-user');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('feed/create', [\App\Http\Controllers\PostController::class, 'create'])->name('feed.create');
Route::get('/feed', [\App\Http\Controllers\PostController::class, 'index'])->name('feed');
Route::get('/feed/{post}', [\App\Http\Controllers\PostController::class, 'show'])->name('feed.show');
Route::post('feed', [\App\Http\Controllers\PostController::class, 'store'])->name('feed.store');
