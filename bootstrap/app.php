<?php

use App\Http\Middleware\IsAuth;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
           'isAuth'=>\App\Http\Middleware\IsAuth::class,
            'isAdmin'=>\App\Http\Middleware\IsAdmin::class,
            'isAgent'=>\App\Http\Middleware\IsAgent::class,
           'isSuperviseur'=>\App\Http\Middleware\IsSuperviseur::class,
            'isChef'=>\App\Http\Middleware\IsChef::class

        ]);


    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
