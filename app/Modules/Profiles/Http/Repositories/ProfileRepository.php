<?php

namespace App\Modules\Profiles\Http\Repositories;

use App\Modules\Kagi\Http\Models\User;
use App\Modules\Profiles\Http\Models\Profile;

use Auth;
use DateTime;
use DB;
use Hash;


class ProfileRepository extends BaseRepository {


	/**
	 * The User instance.
	 *
	 * @var App\Modules\Kagi\Http\Models\User
	 */
	protected $user;


	/**
	 * The Role instance.
	 *
	 * @var App\Modules\Profiles\Http\Models\Profile
	 */
	protected $profile;


	/**
	 * Create a new UserRepository instance.
	 *
   	 * @param  App\Modules\Kagi\Http\Models\User $user
	 * @param  App\Modules\Profiles\Http\Models\Profile $profile
	 * @return void
	 */
	public function __construct(
		User $user,
		Profile $profile
		)
	{
		$this->user = $user;
		$this->profile = $profile;
	}


	/**
	 * Get user collection.
	 *
	 * @param  string  $slug
	 * @return Illuminate\Support\Collection
	 */
	public function show($id)
	{
		$profile = $this->getUserProfile($id);
		return $profile;
	}


	/**
	 * Get user collection.
	 *
	 * @param  int  $id
	 * @return Illuminate\Support\Collection
	 */
	public function edit($id)
	{
//dd($id);
//		$profile = $this->profile->find($id);
		$profile = $this->getUserProfile($id);
//dd($profile);
		return $profile;
//		return compact('profile');
	}


	/**
	 * Get all models.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function store($input)
	{
//dd($input);
		$this->model = new User;
		$this->model->create($input);
	}


	/**
	 * Update a role.
	 *
	 * @param  array  $inputs
	 * @param  int    $id
	 * @return void
	 */
	public function update($input, $id)
	{
//dd($input);

		$profile = Profile::find($id);
		$profile->update($input);

		$user = User::find($profile->user_id);

		$email = $input['email_1'];
		$user->email = $email;
		$user->password =  Hash::make($email);

		$user->update();

//		$user = $this->getById($id);
// 		$user_id = $this->getUserID($id);
// 		$user = User::find($user_id);
//
// 		if ( isset($input['name']) ) {
// 			$user->name = $input['name'];
// 		}
// 		if ( isset($input['email']) ) {
// 			$user->email = $input['email'];
// 		}
//
// 		if ( $input['password'] != null ) {
// 			$user->password = Hash::make($input['password']);
// 		}
//
// 		if ( isset($input['blocked']) ) {
// //			$user->blocked = $input['blocked'];
// 			$user->blocked = 1;
// 		} else {
// 			$user->blocked = 0;
// 		}
// 		if ( isset($input['banned']) ) {
// //			$user->banned = $input['banned'];
// 			$user->banned = 1;
// 		} else {
// 			$user->banned = 0;
// 		}
// 		if ( isset($input['confirmed']) ) {
// //			$user->confirmed = $input['confirmed'];
// 			$user->confirmed = 1;
// 		} else {
// 			$user->confirmed = 0;
// 		}
// 		if ( isset($input['activated']) ) {
// //			$user->activated = $input['activated'];
// 			$user->activated = 1;
// 			$user->activated_at = date("Y-m-d H:i:s");
//
// 		} else {
// 			$user->activated = 0;
// 			$user->activated_at = null;
// 		}
// //dd($user);
//
// 		$user->update();
//
// 		$user->syncRoles($input['roles']);
	}

	public function updateProfileEmail($data)
	{
//dd($data->email);

		$profile = Profile::find($data->id);
		$profile->email_1 = $data->email;
		$profile->update();
	}

// Functions ---------------------------------------------------------------


	public function checkProfileExists($email)
	{
//dd($email);
		$profile = DB::table('profiles')
			->where('email_1', '=', $email)
			->first();
//dd($profile);

		return $profile;
	}


	public function createEmployeeProfile($data)
	{
//dd($data);
		$email						= $data['email_1'];

		$check = $this->checkProfileExists($email);

		if ($check != null) {
//dd($check);
			$profile = Profile::find($check->id);
			$profile->update($data);
		} else {
			Flash::error( trans('kotoba::hr.error.employee_create') );
			return redirect('/admin/employees/create');
		}

	}


	/**
	 * @param $data
	 * @return static
	 */
	public function CreateProfile($data)
	{
//dd($data);
		$check = $this->checkProfileExists($data->email);
		if ($check == null) {
//dd($data->id);
			return Profile::create([
				'user_id'						=> $data->id,
				'email_1'						=> $data->email
			]);
		}
	}


	/**
	 * @param $data
	 * @return static
	 */
	public function DeleteProfile($data)
	{
//dd($data);

		$check = $this->checkProfileExists($data->email);
		$profile_id = $this->getProfile($data->id);
//dd($profile_id);

		if ($check != null) {
			$profile = Profile::find($profile_id);
//dd($profile);
			$profile->delete();
			return;
		}
	}


	public function getProfile($id)
	{
		$profile = DB::table('profiles')
			->where('user_id', '=', $id)
			->pluck('id');
//dd($profile);

		return $profile;
	}


	public function getUserProfile($id)
	{
		$profile = DB::table('profiles')
			->where('user_id', '=', $id)
			->first();

		return $profile;
	}


	public function getUserID($id)
	{
		$user_id = DB::table('profiles')
			->where('id', '=', $id)
			->pluck('user_id');
//dd($profile);

		return $user_id;
	}


}
