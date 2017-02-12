<?php

namespace App\Modules\Menus\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

use App;
use Config;
use Lang;
use Module;
use Theme;
use View;

use Plugin;


class MenusServiceProvider extends ServiceProvider
{


    /**
     * Register the Menus module service provider.
     *
     * @return void
     */
    public function register()
    {
        // This service provider is a convenient place to register your modules
        // services in the IoC container. If you wish, you may make additional
        // methods or service providers to keep the code more focused and granular.

        $this->registerNamespaces();
        $this->registerProviders();

    }


    /**
     * Register the Menus module resource namespaces.
     *
     * @return void
     */
    protected function registerNamespaces()
    {
        View::addNamespace('menus', realpath(__DIR__ . '/../Resources/Views'));
    }


    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {

        $this->publishes([
            __DIR__ . '/../Config/menu.php' => config_path('menu.php'),
            __DIR__ . '/../Resources/Menus/Images' => base_path('public/assets/images/'),
            __DIR__ . '/../Resources/Views/' => public_path('themes/') . Theme::getActive() . '/views/modules/menus/',
            __DIR__ . '/../Resources/Menus/Views/' => public_path('themes/') . Theme::getActive() . '/views/',
        ]);


        $this->publishes([
            __DIR__ . '/../Config/menu.php' => config_path('menu.php'),
        ], 'configs');

        $this->publishes([
            __DIR__ . '/../Resources/Menus/Images' => base_path('public/assets/images/'),
        ], 'images');


        $this->publishes([
            __DIR__ . '/../Resources/Views/' => public_path('themes/') . Theme::getActive() . '/views/modules/menus/',
            __DIR__ . '/../Resources/Menus/Views/' => public_path('themes/') . Theme::getActive() . '/views/',
        ], 'views');


        AliasLoader::getInstance()->alias(
            'CMenu',
            'Caffeinated\Menus\Facades\Menu'
        );

// Register Middleware
// 		if ( Module::exists('kenshu') ) {
// 			$kernel = $this->app->make('Illuminate\Contracts\Http\Kernel');
// 			$kernel->pushMiddleware('App\Modules\Menus\Http\Middleware\MenuMiddleware');
// 		}

    }


    /**
     * add Prvoiders
     *
     * @return void
     */
    private function registerProviders()
    {
        $app = $this->app;

        $app->register('App\Modules\Menus\Providers\RouteServiceProvider');
//		$app->register('App\Modules\Menus\Providers\MenuEventServiceProvider');

        $app->register('App\Modules\Menus\Providers\WidgetServiceProvider');
        //$app->register('Caffeinated\Menus\MenusServiceProvider');
    }


}
