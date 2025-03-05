<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Lumen\Routing\Router;

class RouteListCommand extends Command
{
    protected $signature = 'route:list';
    protected $description = 'List all registered routes';

    public function handle(Router $router)
    {
        $routes = $router->getRoutes();
        foreach ($routes as $route) {
            $this->info($route['method'] . ' ' . $route['uri']);
        }
    }
}
