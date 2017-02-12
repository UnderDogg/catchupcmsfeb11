<?php

namespace App\Modules\Menus\Handlers\Events;

use App\Modules\Menus\Events\MenuWasUpdated;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

use Cache;


class UpdateMenu {


	/**
	 * Handle the event.
	 *
	 * @param  TicketWasCreated  $email
	 * @return void
	 */
	public function handle(MenuWasUpdated $data)
	{
//dd($data);
		Cache::flush();
	}


}
