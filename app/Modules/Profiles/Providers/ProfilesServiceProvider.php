<?php

namespace App\Modules\Profiles\Providers;

use Illuminate\Support\ServiceProvider;

use App;
use Config;
use Lang;
use Theme;
use View;


class ProfilesServiceProvider extends ServiceProvider
{


	/**
	 * Register the Profiles module service provider.
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
		View::addNamespace('profiles', realpath(__DIR__.'/../Resources/Views'));
	}


	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{

		$this->publishes([
			__DIR__ . '/../Config/profile.php' => config_path('profile.php'),
			__DIR__ . '/../Resources/Assets/Images' => base_path('public/assets/images/'),
			__DIR__ . '/../Resources/Views/' => public_path('themes/') . Theme::getActive() . '/views/modules/profiles/',
		]);


		$this->publishes([
			__DIR__.'/../Config/profile.php' => config_path('profile.php'),
		], 'configs');

		$this->publishes([
			__DIR__ . '/../Resources/Assets/Images' => base_path('public/assets/images/'),
		], 'images');

		$this->publishes([
			__DIR__ . '/../Resources/Views/' => public_path('themes/') . Theme::getActive() . '/views/modules/profiles/',
		], 'views');

		$app = $this->app;

		$app->register('App\Modules\Profiles\Providers\ProfileEventServiceProvider');

// Register Middleware
// 		$kernel = $this->app->make('Illuminate\Contracts\Http\Kernel');
// 		$kernel->pushMiddleware('App\Modules\Profiles\Http\Middleware\AuthenticateProfiles');
	}


	/**
	* add Prvoiders
	*
	* @return void
	*/
	private function registerProviders()
	{
		$app = $this->app;

		$app->register('App\Modules\Profiles\Providers\RouteServiceProvider');
	}


}
