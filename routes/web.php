<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/**
 * @GET    - Route::get($uri, $callback);    - получить
 * @POST   - Route::post($uri, $callback);   - создать
 * @PUT    - Route::put($uri, $callback);    - обновить (все, полные данные)
 * @PATH   - Route::patch($uri, $callback);  - обновить (часть, неполные данные)
 * @DELETE - Route::delete($uri, $callback); - удалить
 * Несколько:
 * Route::match(['get', 'post', ...], $uri, $callback);
 * Route::any($uri, $callback);
 */
/*
 * @GET         /feed               feed.index      PostController->index()
 * @POST        /feed               feed.store      PostController->store(Request $request)
 * @GET         /feed/create        feed.create     PostController->create()
 * @GET         /feed/{feed}/edit   feed.edit       PostController->edit($id)
 * @GET         /feed/{feed}        feed.show       PostController->show($id)
 * @PUT|@PATH   /feed/{feed}        feed.update     PostController->update(Request $request, $id)
 * @DELETE      /feed/{feed}        feed.destroy    PostController->destroy($id)
 *
 * @GET         /feed/{username}    feed.user       PostController->showByUsername($username)
 */
//Route::resource('feed', \App\Http\Controllers\PostController::class);
//Route::prefix('feed')
//    ->controller(\App\Http\Controllers\PostController::class)
//    ->group(function () {
//        Route::get('/{username}', 'showByUsername')->where('username', '[A-z0-9-_]+')->name('feed.user');
//    });

Route::get('/dashboard', fn() => view('dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', fn() => 'Home page')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/own-posts', [ProfileController::class, 'posts'])->name('profile.posts');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'updateUser'])->name('profile.update-user');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/manage', [ProfileController::class, 'manageUsers'])->name('profile.manage-users');
    Route::delete('/manage', [ProfileController::class, 'destroyUser'])->name('profile.destroy-user');
});

require __DIR__.'/auth.php';
require __DIR__.'/profile.php';

Route::get('/feed', [\App\Http\Controllers\PostController::class, 'index'])->name('feed');
Route::get('feed/create', [\App\Http\Controllers\PostController::class, 'create'])->name('feed.create');
Route::get('/feed/{post}', [\App\Http\Controllers\PostController::class, 'show'])->where('post', '[0-9]+')->name('feed.show');
Route::get('feed/{username}', [\App\Http\Controllers\PostController::class, 'index'])->name('feed.user-posts');
Route::post('feed', [\App\Http\Controllers\PostController::class, 'store'])->name('feed.store');
Route::get('feed/{post}/edit', [\App\Http\Controllers\PostController::class, 'edit'])->name('feed.edit');
Route::patch('feed/{post}', [\App\Http\Controllers\PostController::class, 'update'])->name('feed.update');


Route::get('/feed/{username}', [\App\Http\Controllers\PostController::class, 'index'])->name('feed.user-posts');
Route::post('/feed', [\App\Http\Controllers\PostController::class, 'store'])->name('feed.store');
Route::get('/feed/{post}/edit', [\App\Http\Controllers\PostController::class, 'edit'])->name('feed.edit');
Route::patch('/feed/{post}', [\App\Http\Controllers\PostController::class, 'update'])->name('feed.update');
Route::patch('/feed/{post}/remove', [\App\Http\Controllers\PostController::class, 'destroy'])->name('feed.remove');
