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

        // profile
        Route::put('profile', Api\Auth\ProfileController::class);

        // password
        Route::put('reset-password', Api\Auth\ResetPasswordController::class);
        
        // posts routes
        Route::apiResource('posts', Api\PostResourceController::class);
        Route::post('posts/{post}/like', Api\PostLikeController::class);
        Route::apiResource('posts/{post}/comment', Api\PostCommentController::class)
            ->except('show');
    });
});
