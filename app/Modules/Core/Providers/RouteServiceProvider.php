<?php

namespace App\Modules\Core\Providers;

use Illuminate\Routing\Router;
//use Caffeinated\Modules\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * This namespace is applied to the controller routes in your module's routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Modules\Core\Http\Controllers';

    /**
     * Define your module's route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }


    /**
     * Define the routes for the module.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();

        $this->mapApiRoutes();


    }

    /**
     * Define the "web" routes for the module.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => 'web',
            'namespace'  => $this->namespace,
        ], function ($router) {
            require(config('modules.path') . '/Core/Routes/web.php');
        });




    }

    /**
     * Define the "api" routes for the module.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => 'api',
            'namespace'  => $this->namespace,
            'prefix'     => 'api',
        ], function ($router) {
            require(config('modules.path') . '/Core/Routes/api.php');
        });
    }
}
