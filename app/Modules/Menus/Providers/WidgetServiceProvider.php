<?php

namespace App\Modules\Menus\Providers;

use Illuminate\Support\ServiceProvider;

//use Caffeinated\Modules\Facades\Module;
use Widget;
use Plugin;

class WidgetServiceProvider extends ServiceProvider {


	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}


	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{


// ALL
//		Widget::register('App\\Widgets');

// Individually
//		Widget::register('MenuAdmin', 'App\Widgets\MenuAdmin');
		Widget::register('MenuFooter', 'App\Widgets\MenuFooter');
//		Plugin::register('plugin_navigation', 'App\Modules\Menus\Http\Plugins\MenuNavigation');

	}


}
