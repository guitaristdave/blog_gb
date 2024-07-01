<?php

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

Route::get('/', fn() => view('page.index'))->name('home');

require __DIR__.'/auth.php';
require __DIR__.'/profile.php';
require __DIR__.'/feed.php';
