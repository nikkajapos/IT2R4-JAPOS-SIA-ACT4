<?php

require_once __DIR__.'/../vendor/autoload.php';

// Load Environment Variables
if (class_exists(Dotenv\Dotenv::class)) {
    try {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
        $dotenv->load();
    } catch (\Exception $e) {
        die('Could not load environment file.');
    }
}

date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
*/

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

$app->withFacades();
$app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Config Files
|--------------------------------------------------------------------------
*/
$app->configure('app');
$app->configure('database');
$app->configure('filesystems');
$app->configure('auth'); // Ensure auth.php is configured

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
*/

$app->register(Laravel\Tinker\TinkerServiceProvider::class);
$app->register(Laravel\Lumen\Console\ConsoleServiceProvider::class);
$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);
$app->register(App\Providers\EventServiceProvider::class);
$app->register(Flipbox\LumenGenerator\LumenGeneratorServiceProvider::class);
$app->register(Illuminate\Auth\AuthServiceProvider::class);
$app->register(Tymon\JWTAuth\Providers\LumenServiceProvider::class); // 

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
*/
$app->middleware([
    // Add any global middleware if needed
]);

$app->routeMiddleware([
    'auth' => App\Http\Middleware\Authenticate::class, 
    'jwt.auth' => Tymon\JWTAuth\Http\Middleware\Authenticate::class, 
    'jwt.refresh' => Tymon\JWTAuth\Http\Middleware\RefreshToken::class, 
]);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
*/

$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/web.php';
    require __DIR__.'/../routes/api.php';
});

return $app;
