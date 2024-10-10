<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api;

Route::prefix('/v1')->name('api.')->group(function () {
    Route::post('login', Api\Auth\LoginController::class)
        ->name('login');
    Route::post('register', Api\Auth\RegisterController::class)
        ->name('register');

    Route::middleware('auth:api')->group(function () {
        Route::get('user', Api\Auth\LoginCheckController::class)
            ->name('user');
        Route::post('logout', Api\Auth\LoginController::class)
            ->name('logout');
        
        Route::get('posts', Api\GetPostController::class);
        Route::post('posts', Api\CreatePostController::class);
        Route::get('posts/{post}', Api\GetPostDetailController::class);
        Route::post('posts/{post}/like', Api\CreatePostLikeController::class);
        Route::post('posts/{post}/comment', Api\CreatePostCommentController::class);
    });
});
