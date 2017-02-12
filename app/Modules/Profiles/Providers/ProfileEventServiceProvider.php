<?php

namespace App\Modules\Profiles\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Providers\EventServiceProvider;

use App\Modules\Profiles\Events\ProfileWasCreated;
use App\Modules\Profiles\Handlers\Events\CreateProfile;
use App\Modules\Profiles\Events\ProfileWasDeleted;
use App\Modules\Profiles\Handlers\Events\DeleteProfile;
use App\Modules\Profiles\Events\ProfileWasUpdated;
use App\Modules\Profiles\Handlers\Events\UpdateProfile;

use App\Modules\Kagi\Http\Models\User;

use App;
use Event;
use Module;


class ProfileEventServiceProvider extends EventServiceProvider {


	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [

		ProfileWasCreated::class => [
			CreateProfile::class,
		],

		ProfileWasDeleted::class => [
			DeleteProfile::class,
		],

		ProfileWasUpdated::class => [
			UpdateProfile::class,
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

		if (Module::exists('yubin')) {
			User::created(function ($user) {
				\Event::fire(new ProfileWasCreated($user));
			});

			User::deleted(function ($user) {
				\Event::fire(new ProfileWasDeleted($user));
			});
		}

		Event::listen('App\Modules\Profiles\Events\ProfileWasUpdated',
			'App\Modules\Profiles\Handlers\Events\UpdateProfile');


	}

	public function register()
	{

		if (Module::exists('yubin')) {
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('ProfileWasCreated', 'App\Modules\Profiles\Events\ProfileWasCreated');

			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('ProfileWasDeleted', 'App\Modules\Profiles\Events\ProfileWasDeleted');
		}

	}


}
