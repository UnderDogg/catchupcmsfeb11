<?php

namespace App\Modules\Profiles\Handlers\Events;

use App\Modules\Profiles\Events\ProfileWasCreated;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

use App\Modules\Profiles\Http\Models\Profile;
use App\Modules\Profiles\Http\Repositories\ProfileRepository;

use App\Modules\Kagi\Http\Models\User;
use App\Modules\Kagi\Http\Repositories\UserRepository;


class CreateProfile {


	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct(
			ProfileRepository $profile_repo,
			User $user,
			UserRepository $user_repo
		)
	{
		$this->profile_repo = $profile_repo;
		$this->user = $user;
		$this->user_repo = $user_repo;
	}


	/**
	 * Handle the event.
	 *
	 * @param  ProfileWasCreated  $email
	 * @return void
	 */
	public function handle(ProfileWasCreated $data)
	{
		if ($data != null) {

			$new_user = $this->user_repo->getUserInfo($data->email);
//dd($new_user);
			$new_user = $this->user->find($new_user->id);

			$this->profile_repo->CreateProfile($new_user);
		}
	}


}
