<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api;

Route::prefix('/v1')->name('api.')->group(function () {
    Route::post('login', Api\Auth\LoginController::class)
        ->name('login');
    Route::post('register', Api\Auth\RegisterController::class)
        ->name('register');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('user', Api\Auth\LoginCheckController::class)
            ->name('user');
        Route::post('logout', Api\Auth\LoginController::class)
            ->name('logout');
        
        Route::apiResource('posts', Api\PostResourceController::class);
        Route::apiResource('posts/{post}/like', Api\PostLikeController::class)
            ->only(['store', 'delete']);
        Route::apiResource('posts/{post}/comment', Api\PostCommentController::class)
            ->except('show');
    });
});
