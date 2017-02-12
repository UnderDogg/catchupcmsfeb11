<?php

namespace App\Modules\Kagi\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Modules\Kagi\Http\Controllers\Auth\ThrottlesLogins;
use App\Modules\Kagi\Http\Controllers\Auth\AuthenticatesAndRegistersUsers;

use App\Modules\Kagi\Http\Repositories\RegistrarRepository;
use App\Modules\Kagi\Http\Models\User;
use App\Modules\Kagi\Http\Repositories\UserRepository;

use Validator;


class AuthController extends Controller
{

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers, ThrottlesLogins;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct(
			RegistrarRepository $registrar_repo,
			UserRepository $user_repo
		)
	{
		$this->registrar_repo = $registrar_repo;
		$this->user_repo = $user_repo;

// middleware
		$this->middleware('guest', ['except' => 'getLogout']);
	}


	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		]);
	}


	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
/*
	protected function create(array $data)
	{
		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
		]);
	}
*/

}
