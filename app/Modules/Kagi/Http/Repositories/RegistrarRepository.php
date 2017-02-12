<?php

namespace App\Modules\Kagi\Http\Repositories;

use App\Modules\Kagi\Http\Models\User;

use Auth;
use Config;
use DateTime;
use DB;
use Eloquent;
use Flash;
use Hash;
use Mail;


class RegistrarRepository extends BaseRepository {

	/**
	 * The User instance.
	 *
	 * @var App\Models\User
	 */
	protected $user;

/*
|---------------------------------------------------------------------------
| Register
|---------------------------------------------------------------------------
*/

	/**
	 * Send confirmation email to user
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function sendConfirmation($name, $email, $confirmation_code)
	{
//dd($user);
		Mail::send('kagi::emails.confirm', ['confirmation_code' => $confirmation_code], function($message) use ($name, $email)
		{
			$message->from(Config::get('kagi.site_email'), Config::get('kagi.site_name'));
			$message->to($email, $name);
			$message->subject(Config::get('kagi.site_name').Config::get('kagi.separator').trans('kotoba::email.confirmation.confirm'));
		});
	}

/*
|---------------------------------------------------------------------------
| Login
|---------------------------------------------------------------------------
*/

	/**
	 * Update user login timestamp
	 *
	 * @param  int  $email
	 * @return
	 */
	public function touchLastLogin($email)
	{
		return DB::table('users')
			->where('email', '=', $email)
			->update([
				'last_login' => date("Y-m-d H:i:s")
			]);
	}


	/**
	 * Check user if approved to access site
	 *
	 * @param  int  $email
	 * @return
	 */
	public function checkUserApproval($email)
	{
		$user = DB::table('users')
			->where('email', '=', $email)
			->first();

// Run authorization checks against user status
		$approved = false;
		if ($user != null) {
			if ( $user->confirmed == 1) {
				$approved = true;
			}
			if ( $user->activated == 1) {
				$approved = true;
			}
			if ( $user->blocked == 1) {
				$approved = false;
			}
			if ( $user->banned == 1) {
				$approved = false;
			}
		}
//dd($approved);

		return $approved;
	}


	/**
	 * Check user if approved to access site
	 *
	 * @param  int  $email
	 * @return
	 */
	public function checkAllowDirect($email)
	{
		$user = DB::table('users')
			->where('email', '=', $email)
			->first();

// Run authorization check to see if user is allowed to login directly
		$allow_direct = false;
		if ($user != null) {
			if ( $user->allow_direct == 1) {
				$allow_direct = true;
			}
		}
//dd($allow_direct);

		return $allow_direct;
	}

/*
|---------------------------------------------------------------------------
| Confirm
|---------------------------------------------------------------------------
*/

	/**
	 * check against db for code
	 *
	 * @param string $code
	 *
	 * @return
	 */
	public function confirmCode($code)
	{
		$confirmation = DB::table('users')
			->where('confirmation_code', '=', $code)
			->where('confirmed', '!=', 1, 'AND')
			->first();

		return $confirmation;
	}


	/**
	 * check against db for code
	 *
	 * @param string $code
	 *
	 * @return
	 */
	public function confirmEmail($email)
	{
		$user = DB::table('users')
			->where('email', '=', $email)
			->first();
//dd('loaded');

		return $user;
	}


	/**
	 * Change the user confirm status
	 *
	 * @param  $user
	 *
	 * @return
	 */
	public function confirmUser($user)
	{
		$user = User::findOrFail($user->id);
//dd($user);

		$user->confirmed = 1;
		return $user->update();
	}


	/**
	 * Change the user confirm status
	 *
	 * @param  $user
	 *
	 * @return
	 */
	public function activateUser($user)
	{
//dd($user);
		$user = User::find($user->id);

		if ($user != null) {
			$user->activated = 1;
			$user->activated_at = date("Y-m-d H:i:s");
			return $user->update();
		}

	}



/*
|---------------------------------------------------------------------------
| Create
|---------------------------------------------------------------------------
*/

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */

// 	public function create(array $data)
// 	{
// //dd($data['email']);
//
// 		$name = $data['name'];
// 		$email = $data['email'];
// 		$confirmation_code = md5(uniqid(mt_rand(), true));
// //		$confirmation_code = md5(microtime().Config::get('app.key'));
// //dd($confirmation_code);
//
// 		$user = User::create([
// 			'confirmation_code'	=> $confirmation_code,
// 			'name'				=> $name,
// 			'email'				=> $email,
// 			'password'			=>  Hash::make($data['password'])
// /*
// 			'activated_at'		=> date("Y-m-d H:i:s"),
// 			'blocked'			=> 0,
// 			'confirmed'			=> 1,
// 			'activated'			=> 1,
// 			'confirmation_code'	= md5(microtime().Config::get('app.key'))
// */
// 		]);
// //dd($user);
//
// 		$this->sendConfirmation($name, $email, $confirmation_code);
//
// 		return $user;
// 	}


	/**
	 * @param $userData
	 * @return static
	 */
/*
	public function findByUsernameOrCreateGithub($userData)
	{
dd('findByUsernameOrCreateGithub');
//dd($userData);
//	protected $fillable = ['name', 'email', 'password', 'blocked', 'banned', 'confirmed', 'activated', "avatar'];
//dd($userData->email);

		if ($userData->name == null) {
			$userData->name = $userData->nickname;
		}
		if ($userData->email == null) {
			$userData->email = $userData->nickname;
		}
		if ($userData->avatar == null) {
			$userData->avatar = Config::get('kagi.kagi_avatar', 'assets/images/usr.png');
		}
		$date = date("Y-m-d H:i:s");

		$name							= $userData->name;
		$email							= $userData->email;
		$avatar							= $userData->avatar;

		$check = $this->checkUserExists($name, $email);
		if ($check == null) {
			User::create([
				'name'					=> $name,
				'email'					=> $email,
				'avatar'				=> $avatar,
				'blocked'				=> 0,
				'banned'				=> 0,
				'confirmed'				=> 1,
				'activated'				=> 1,
				'activated_at'			=> $date,
				'last_login'			=> $date,
				'avatar'				=> $avatar,
				'confirmation_code'		=> md5(microtime().Config::get('app.key'))
			]);

			$check_again = $this->checkUserExists($name, $email);
//dd($check_again->id);
			$user = $this->user->find($check_again->id);
			$user->syncRoles([Config::get('kagi.default_role')]);

			\Event::fire(new \ProfileWasCreated($check_again));
			\Event::fire(new \EmployeeWasCreated($check_again));

			return $user;

		} else {
//dd($check);
			$this->touchLastLogin($check->id);

			return User::firstOrCreate([
				'name'					=> $name,
				'email'					=> $email,
			]);
		}

	}

	public function findByUsernameOrCreateGoogle($userData)
	{
dd('findByUsernameOrCreateGoogle');
//dd($userData);
//	protected $fillable = ['name', 'email', 'password', 'blocked', 'banned', 'confirmed', 'activated'];

		if ($userData->name == null) {
			$userData->name = $userData->nickname;
		}
		if ($userData->email == null) {
			$userData->email = $userData->nickname;
		}
		if ($userData->avatar == null) {
			$userData->avatar = Config::get('kagi.kagi_avatar', 'assets/images/usr.png');
		}
		$date = date("Y-m-d H:i:s");

		$name							= $userData->name;
		$email							= $userData->email;
		$avatar							= $userData->avatar;

		$check = $this->checkUserExists($name, $email);
//dd($check);
		if ($check == null) {
			User::firstOrCreate([
				'name'					=> $name,
				'email'					=> $email,
				'avatar'				=> $avatar,
				'activated_at'			=> date("Y-m-d H:i:s"),
				'blocked'				=> 0,
				'banned'				=> 0,
				'confirmed'				=> 1,
				'activated'				=> 1,
				'activated_at'			=> $date,
				'last_login'			=> $date,
				'avatar'				=> $avatar,
				'confirmation_code'		=> md5(microtime().Config::get('app.key'))
			]);

			$check_again = $this->checkUserExists($name, $email);
//dd($check_again->id);
			$user = $this->user->find($check_again->id);
			$user->syncRoles([Config::get('kagi.default_role')]);

			\Event::fire(new \ProfileWasCreated($check_again));
			\Event::fire(new \EmployeeWasCreated($check_again));

			return User::firstOrCreate([
				'name'					=> $name,
				'email'					=> $email,
			]);

		} else {
//dd($check);
			$this->touchLastLogin($check->id);

			return User::firstOrCreate([
				'name'					=> $name,
				'email'					=> $email,
			]);
		}
	}
*/

}
