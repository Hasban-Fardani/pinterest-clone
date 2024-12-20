<?php

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (ValidationException $exception) {
            return response()->json([
                'message' => "validation error",
                'errors' => $exception->errors(),
            ], 422);
        });

        $exceptions->render(function (AuthorizationException $exception) {
            return response()->json([
                'message' => 'Unauthorized',
            ], 403);
        });

        $exceptions->render(function (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'Not Found',
            ], 404);
        });

        $exceptions->render(function (Exception $exception) {
            return response()->json([
                'message' => env('APP_DEBUG', false) == true ? $exception->getMessage() : 'Server Error',
            ], 500);
        });
    })->create();
