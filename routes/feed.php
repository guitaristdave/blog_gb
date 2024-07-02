<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/**
 * @GET              /feed             - Просмотр ленты
 * @GET              /feed/my          - Просмотр ленты текущего пользователя
 * @GET              /feed/user/{user} - Просмотр ленты запрошенного пользователя
 * @GET              /feed/{post}      - Просмотр поста
 * @GET|@POST        /feed/create      - Создание поста
 * @GET|@PUT|@DELETE /feed/{post}/edit - Редактирование/удаление поста
 * {user} = [0-9]+
 * {post} = [0-9]+
 */
Route::prefix('feed')->controller(PostController::class)->group(function () {
//    TODO изменить роуты на эти
//    Route::get('/', 'index')->name('feed');
//    Route::get('/my', 'indexByCurrentUserId')->name('feed.my');
//    Route::get('/user/{user}', 'indexByUserId')->where(['user' => '[0-9]+'])->name('feed.user');
//    Route::get('/{post}', 'show')->name('feed.show');
//
//    // Auth
//    Route::middleware('auth')->group(function () {
//
//        // Create
//        Route::prefix('create')->group(function () {
//            Route::get('/', 'create')->name('feed.create');
//            Route::post('/', 'store')->name('feed.store');
//        });
//
//        // Edit
//        Route::prefix('/{post}/edit')->where(['post' => '[0-9]+'])->group(function () {
//            Route::get('/', 'edit')->name('feed.edit');
//            Route::put('/', 'update')->name('feed.update');
//            Route::delete('/', 'destroy')->name('feed.remove');
//        });
//
//    });

    Route::get('/', 'index')->name('feed');
    Route::post('/', 'store')->name('feed.store')->middleware('auth');
    Route::get('/create', 'create')->name('feed.create')->middleware('auth');
    Route::get('/own-posts', 'posts')->name('feed.posts')->middleware('auth');
    Route::prefix('/{post}')->where(['post' => '[0-9]+'])->group(function () {
        Route::get('/', 'show')->name('feed.show');
        Route::get('/edit', 'edit')->name('feed.edit')->middleware('auth');
        Route::patch('/', 'update')->name('feed.update')->middleware('auth');
        Route::patch('/remove', 'destroy')->name('feed.remove')->middleware('auth');
    });
});

//Route::get('/feed/{username}', [PostController::class, 'index'])->name('feed.user-posts'); // TODO мешает для feed.show

