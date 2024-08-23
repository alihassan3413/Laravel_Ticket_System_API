<?php

use App\Exceptions\CustomException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $customHandler = new CustomException();

        $exceptions->render(function ($request, Throwable $exception) use ($customHandler) {
            return $customHandler->handleException($request, $exception);
        });
    });

return $app->create();
