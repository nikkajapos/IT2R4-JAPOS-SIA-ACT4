<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting([
        'web' => __DIR__ . '/../routes/web.php',
        'api' => __DIR__ . '/../routes/api.php',
        'commands' => __DIR__ . '/../routes/console.php',
        'health' => '/up',
    ])
    ->withFacades()
    ->withEloquent()
    ->withServiceProviders([
        Laravel\Lumen\View\ViewServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
    ])
    ->withMiddleware(function (Middleware $middleware) {
        // Register global middleware here if needed
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Handle exceptions
    })
    ->create();
