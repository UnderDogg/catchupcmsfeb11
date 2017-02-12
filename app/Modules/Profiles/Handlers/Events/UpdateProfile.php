<?php

namespace App\Modules\Profiles\Handlers\Events;

use App\Modules\Profiles\Events\ProfileWasUpdated;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

use App\Modules\Profiles\Http\Repositories\ProfileRepository;


class UpdateProfile {


	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct(
			ProfileRepository $profile_repo
		)
	{
		$this->profile_repo = $profile_repo;
	}


	/**
	 * Handle the event.
	 *
	 * @param  ProfileWasCreated  $email
	 * @return void
	 */
	public function handle(ProfileWasUpdated $data)
	{
		if ($data != null) {
			$this->profile_repo->updateProfileEmail($data);
		}
	}


}
