<?php

namespace App\Modules\Menus\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Providers\EventServiceProvider;

use App\Modules\Menus\Events\MenuWasCreated;
use App\Modules\Menus\Handlers\Events\CreateMenu;
use App\Modules\Menus\Events\MenuWasUpdated;
use App\Modules\Menus\Handlers\Events\UpdateMenu;

use App\Modules\Menus\Http\Models\Menu;
use App\Modules\Menus\Http\Models\Menulink;

use App;
use Event;


class MenuEventServiceProvider extends EventServiceProvider {


	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [

		MenuWasCreated::class => [
			CreateMenu::class,
		],

		MenuWasUpdated::class => [
			UpdateMenu::class,
		],

	];


	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);

		Menu::created(function ($asset) {
			\Event::fire(new MenuWasCreated($asset));
		});
		Menu::updated(function ($asset) {
			\Event::fire(new MenuWasUpdated($asset));
		});


		Menulink::created(function ($asset) {
			\Event::fire(new MenuWasCreated($asset));
		});
		Menulink::updated(function ($asset) {
			\Event::fire(new MenuWasUpdated($asset));
		});

	}

	public function register()
	{

		$loader = \Illuminate\Foundation\AliasLoader::getInstance();
		$loader->alias('MenuWasCreated', 'App\Modules\Menus\Events\MenuWasCreated');

		$loader = \Illuminate\Foundation\AliasLoader::getInstance();
		$loader->alias('MenuWasUpdated', 'App\Modules\Menus\Events\MenuWasUpdated');

	}


}
