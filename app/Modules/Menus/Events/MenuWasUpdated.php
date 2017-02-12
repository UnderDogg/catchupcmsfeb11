<?php

namespace App\Modules\Menus\Events;

use App\Modules\Menus\Events\Event;
use Illuminate\Queue\SerializesModels;


class MenuWasUpdated extends Event {


	use SerializesModels;

	public $data;


	public function __construct($data)
	{
//dd($data);
	}


}
