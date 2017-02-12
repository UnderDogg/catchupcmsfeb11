<?php

namespace App\Modules\Menus\Handlers\Events;

use App\Modules\Menus\Events\MenuWasCreated;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

use Cache;


class CreateMenu {


	/**
	 * Handle the event.
	 *
	 * @param  TicketWasCreated  $email
	 * @return void
	 */
	public function handle(MenuWasCreated $data)
	{
		Cache::flush();
	}


}
