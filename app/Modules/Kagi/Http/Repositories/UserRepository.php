<?php

namespace App\Modules\Kagi\Http\Repositories;

use Caffeinated\Shinobi\Models\Role as shinobiRole;
use App\Modules\Kagi\Http\Models\Role;
use App\Modules\Kagi\Http\Models\User;
use App\Modules\Kagi\Http\Repositories\RegistrarRepository;

use App\Modules\Profiles\Events\ProfileWasUpdated;

use Auth;
use Config;
use DateTime;
use DB;
use Eloquent;
use Event;
use Hash;
use Setting;


class UserRepository extends BaseRepository {


	/**
	 * The User instance.
	 *
	 * @var App\Models\User
	 */
	protected $user;

	/**
	 * The Role instance.
	 *
	 * @var App\Models\Role
	 */
	protected $role;

	/**
	 * Create a new UserRepository instance.
	 *
	 * @param  App\Modules\Kagi\Http\Models\Role $role
	 * @param  App\Modules\Kagi\Http\Models\User $user
	 * @return void
	 */
	public function __construct(
		RegistrarRepository $registrar_repo,
		Role $role,
		shinobiRole $shinobiRole,
		User $user
		)
	{
		$this->registrar_repo = $registrar_repo;
		$this->role = $role;
		$this->shinobiRole = $shinobiRole;
		$this->user = $user;
	}


	/**
	 * Get user collection.
	 *
	 * @param  string  $slug
	 * @return Illuminate\Support\Collection
	 */
	public function show($id)
	{
		$user = $this->user->findOrFail($id);
//dd($user);

//		$roles = $this->getRoles();
//		$allRoles =  $this->role->all()->lists('name', 'id');
		$roles = $this->getUserRoles($user->id);
//dd($roles);

		return compact('user', 'roles');
	}


	/**
	 * Get user collection.
	 *
	 * @param  int  $id
	 * @return Illuminate\Support\Collection
	 */
	public function edit($id)
	{
		$user = $this->user->find($id);
//dd($user);
		$roles = $user->roles->lists('name', 'id');
//		$roles = $this->shinobiRole->lists('name', 'id');
		$allRoles =  $this->role->all()->lists('name', 'id');
//dd($roles);
		return compact('user', 'roles', 'allRoles');
	}


	/**
	 * Get all models.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function store($userData)
	{
//dd($userData);

		$date = date("Y-m-d H:i:s");

		$name							= $userData['name'];
		$email							= $userData['email'];
		$password						= Hash::make($userData['password']);

/*
		if ( isset($userData['password']) ) {
			$password =Hash::make($userData['password']);
		} else {
			$blocked = 0;
		}
*/

		if ( isset($userData['blocked']) ) {
			$blocked = $userData['blocked'];
		} else {
			$blocked = 0;
		}

		if ( isset($userData['banned']) ) {
			$banned = $userData['banned'];
		} else {
			$banned = 0;
		}

		if ( isset($userData['confirmed']) ) {
			$confirmed = $userData['confirmed'];
//			$confirmation_code = md5(microtime().Config::get('app.key'));
			$confirmation_code = md5(uniqid(mt_rand(), true));
		} else {
			$confirmed = 0;
//			$confirmation_code = '';
			$confirmation_code = md5(uniqid(mt_rand(), true));
		}

		if ( isset($userData['allow_direct']) ) {
			$allow_direct = $userData['allow_direct'];
		} else {
			$allow_direct = 0;
		}

		if ( isset($userData['activated']) ) {
			$activated = $userData['activated'];
			$activated_at = $date;
		} else {
			$activated = 0;
			$activated_at = '';
		}

		User::create([
			'name'					=> $name,
			'email'					=> $email,
			'password'				=> $password,
			'blocked'				=> $blocked,
			'banned'				=> $banned,
			'confirmed'				=> $confirmed,
			'allow_direct'			=> $allow_direct,
			'activated'				=> $activated,
			'activated_at'			=> $activated_at,
			'confirmation_code'		=> $confirmation_code
		]);

		$check_again = $this->getUserInfo($email);
//dd($check_again->id);
		$user = $this->user->find($check_again->id);
		$user->syncRoles([Config::get('kagi.default_role')]);

		$this->registrar_repo->sendConfirmation($name, $email, $confirmation_code);

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
		$user = $this->user->find($id);

		if ( isset($input['name']) ) {
			$user->name = $input['name'];
		}
		if ( isset($input['email']) ) {
			$user->email = $input['email'];
		}

		if ( $input['password'] != null ) {
			$user->password = Hash::make($input['password']);
		}

		if ( isset($input['blocked']) ) {
			$user->blocked = 1;
		} else {
			$user->blocked = 0;
		}
		if ( isset($input['banned']) ) {
			$user->banned = 1;
		} else {
			$user->banned = 0;
		}
		if ( isset($input['confirmed']) ) {
			$user->confirmed = 1;
		} else {
			$user->confirmed = 0;
		}
		if ( isset($input['allow_direct']) ) {
			$user->allow_direct = 1;
		} else {
			$user->allow_direct = 0;
		}
		if ( isset($input['activated']) ) {
			$user->activated = 1;
			$user->activated_at = date("Y-m-d H:i:s");

		} else {
			$user->activated = 0;
			$user->activated_at = null;
		}
//dd($user);

		$user->update();

		$user->syncRoles($input['roles']);

		Event::fire(new ProfileWasUpdated($user));

	}


// Functions --------------------------------------------------


	public function getRoles()
	{
//		$roles = $this->role->all();
		if (! is_null($this->shinobiRole)) {
//dd($this->shinobiRole->lists('name'));
			return $this->shinobiRole->lists('name');
		}

		return null;
	}


	public function getUserRoles($user_id)
	{
		$user = DB::table('role_user')
			->leftJoin('roles', 'roles.id', '=', 'role_user.role_id')
			->where('user_id', '=', $user_id)
			->get();
//dd($user);

		return $user;
	}


	public function getUserInfo($email)
	{
		$user = DB::table('users')
			->where('email', '=', $email)
			->first();
//dd($user);

		return $user;
	}


	public function getUserByIdTag($id)
	{
		$user = DB::table('users')
//			->where('id_tag', '=', $id)
			->where('id', '=', $id)
			->pluck('id');
//dd($user);

		return $user;
	}


	public function getUserByEmail($email)
	{
		$user = DB::table('users')
			->where('email', '=', $email)
			->pluck('id');
//dd($user);

		return $user;
	}


	public function createEmployee($userData)
	{
//dd($userData);

		$date = date("Y-m-d H:i:s");

		$name						= $userData['name'];
//		$email						= $userData['email'] . '@' . Str::lower(Setting::get('email_domain'));
		$email						= $userData['email'];

		$password					= Hash::make($email);

		$blocked					= Config::get('kagi.blocked', '0');
		$banned						= Config::get('kagi.banned', '0');
		$confirmed					= Config::get('kagi.confirmed', '1');
		$confirmation_code			= null;
		$activated					= Config::get('kagi.activated', '1');
		$activated_at				= $date;

		$check = $this->checkEmailExists($email);
		if ($check == null) {
			User::create([
				'name'					=> $name,
				'email'					=> $email,
				'password'				=> $password,
				'blocked'				=> $blocked,
				'banned'				=> $banned,
				'confirmed'				=> $confirmed,
				'activated'				=> $activated,
				'activated_at'			=> $activated_at,
				'confirmation_code'		=> $confirmation_code
			]);
		} else {
			Flash::error( trans('kotoba::hr.error.employee_create') );
			return redirect('/admin/employees/create');
		}

		$check_again = $this->getUserInfo($email);
//dd($check_again->id);
		$user = $this->user->find($check_again->id);
		$user->syncRoles([Config::get('kagi.default_role')]);

//		$this->registrar_repo->sendConfirmation($name, $email, $confirmation_code);

		$user_id = $user->id;

		return $user_id;
	}


	public function createSocialUser($user)
	{
		$name							= $user->name;
		$email							= $user->email;
		$avatar							= $user->avatar;

		if ( ($name == null) || ($name == '') ) {
			$name = $email;
		}

		if ( ($avatar == null) || ($avatar == '') ) {
			$avatar = Config::get('kagi.kagi_avatar', 'assets/images/usr.png');
		}

		$date = date("Y-m-d H:i:s");

		User::create([
			'name'					=> $name,
			'email'					=> $email,
			'password'				=> Hash::make($email),
			'avatar'				=> $avatar,
			'blocked'				=> 0,
			'banned'				=> 0,
			'confirmed'				=> 1,
			'activated'				=> 1,
			'activated_at'			=> $date,
			'last_login'			=> $date,
			'avatar'				=> $avatar,
			'confirmation_code'		=> md5( microtime() . Config::get('app.key') )
		]);
	}


	public function updateSocialUser($user)
	{
		$email							= $user->email;
		$avatar							= $user->avatar;

		if ( ($avatar == null) || ($avatar == '') ) {
			$avatar = Config::get('kagi.kagi_avatar', 'assets/images/usr.png');
		}

		$date = date("Y-m-d H:i:s");


		$user_info = $this->getUserInfo($email);
		$user = User::find($user_info->id);

		$values = [
			'password'				=> Hash::make($email),
			'blocked'				=> 0,
			'banned'				=> 0,
			'confirmed'				=> 1,
			'activated'				=> 1,
			'activated_at'			=> $date,
			'last_login'			=> $date,
			'avatar'				=> $avatar,
			'confirmation_code'		=> md5( microtime() . Config::get('app.key') )
		];

		$user->update($values);
	}


	public function checkEmailExists($email)
	{
//dd($email);
		$user = DB::table('users')
			->where('email', '=', $email)
			->first();
//dd($user);

		return $user;
	}


}
