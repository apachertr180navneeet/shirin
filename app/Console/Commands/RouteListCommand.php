<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\RouteListCommand as BaseRouteListCommand;

/**
 * Custom Route List Command
 * Handles backward compatibility with --columns option from Laravel 10+
 * Also handles missing controllers gracefully
 */
class RouteListCommand extends BaseRouteListCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'route:list
                            {--json : Output the route list as JSON}
                            {--method= : Filter the routes by method}
                            {--name= : Filter the routes by name}
                            {--domain= : Filter the routes by domain}
                            {--path= : Only show routes matching the given path pattern}
                            {--except-path= : Do not display the routes matching the given path pattern}
                            {-r|--reverse : Reverse the ordering of the routes}
                            {--sort= : The column to sort by (default: uri)}
                            {--except-vendor : Do not display routes defined by vendor packages}
                            {--only-vendor : Only display routes defined by vendor packages}
                            {--columns= : Deprecated option for Laravel 10+ compatibility}';

    /**
     * Check if a route is a vendor route, handling missing controllers gracefully.
     * Override the parent method to catch ReflectionException.
     */
    protected function isVendorRoute($route)
    {
        try {
            $controller = $route->getControllerClass();
            if (!$controller) {
                return false;
            }
            
            // Handle closures and other non-class controllers
            if ($controller instanceof \Closure || !is_string($controller)) {
                return false;
            }

            $path = (new \ReflectionClass($controller))->getFileName();
            return strpos($path, base_path('vendor')) === 0;
        } catch (\ReflectionException $e) {
            // Controller class doesn't exist, treat as non-vendor route
            return false;
        } catch (\Exception $e) {
            // Any other exception, treat as non-vendor route
            return false;
        }
    }

    /**
     * Handle the command execution, ignoring the --columns option if provided.
     */
    public function handle()
    {
        // Simply ignore the --columns option and call parent
        // This maintains backward compatibility with scripts trying to use --columns
        return parent::handle();
    }
}
