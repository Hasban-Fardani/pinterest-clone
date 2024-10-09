<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api;

Route::prefix('/v1')->name('api.')->group(function () {
    Route::post('login', Api\Auth\LoginController::class)
        ->name('login');
    Route::post('register', Api\Auth\LoginController::class)
        ->name('register');

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', Api\Auth\LoginController::class)
            ->name('logout');
        Route::get('user', Api\Auth\LoginCheckController::class);
        Route::apiResource('posts', Api\PostController::class);
        Route::apiResource('postLikes', Api\PostLikeController::class);
        Route::apiResource('postComments', Api\PostCommentController::class);
    });
});
