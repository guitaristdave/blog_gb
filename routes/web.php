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

Route::get('/', fn() => view('page.index'))->name('home');

require __DIR__.'/auth.php';
require __DIR__.'/profile.php';
require __DIR__.'/feed.php';
