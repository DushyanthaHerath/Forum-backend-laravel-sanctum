<?php

use Illuminate\Support\Facades\Route;

/*
 *  v1 routes
 *  Dushyantha Herath
 */


Route::get(
    '/test',
    [\App\V1\Controllers\PostController::class, 'test']
)->name('test');

Route::prefix('posts')->group(function () {
    // Get all posts
    Route::get(
        '/all',
        [\App\V1\Controllers\PostController::class, 'all']
    )->name('posts.get.all');
    // Save all post
    Route::post(
        '/save',
        [\App\V1\Controllers\PostController::class, 'save']
    )->name('posts.save.post');
    // Get all posts
    Route::get(
        '/categories',
        [\App\V1\Controllers\PostController::class, 'getPostCategories']
    )->name('posts.get.categories');
    Route::post(
        '/approve',
        [\App\V1\Controllers\PostController::class, 'save']
    )->name('posts.approve.post');
});
