<?php

namespace App\Modules\Kagi\Http\Controllers\Social;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use Caffeinated\Shinobi\Traits\ShinobiTrait;

use App\Modules\Kagi\Http\Repositories\RegistrarRepository;
use App\Modules\Kagi\Http\Models\User;
use App\Modules\Kagi\Http\Repositories\UserRepository;

use Auth;
use Config;
use Flash;
use Socialite;
use Validator;

use Theme;


class SocialAuthController extends Controller
{


	use ShinobiTrait;

	private $auth;

	public function __construct(
			RegistrarRepository $registrar_repo,
			User $user,
			UserRepository $user_repo
		)
	{
		$this->registrar_repo = $registrar_repo;
		$this->user = $user;
		$this->user_repo = $user_repo;
// middleware
		$this->middleware('guest');
	}

	public function getLogin()
	{
		return Theme::View('modules.kagi.social.login');
	}


	/**
	 * Redirect the user to the GitHub authentication page.
	 *
	 * @return Response
	 */
	public function redirectToProvider()
	{
		return Socialite::driver(Config::get('kagi_services.outh_provider'))->with(['hd' => Config::get('kagi_services.oauth_domain_limiter'), ''])->redirect();
	}


	/**
	 * Obtain the user information from GitHub.
	 *
	 * @return Response
	 */
	public function handleProviderCallback()
	{
		$user = Socialite::driver(Config::get('kagi_services.outh_provider'))->user();
//dd($user);

// OAuth Two Providers
		$token = $user->token;

/*
// OAuth One Providers
		$token = $user->token;
		$tokenSecret = $user->tokenSecret;

// All Providers
		$social_id = $user->getId();
		$social_nick = $user->getNickname();
		$social_name = $user->getName();
		$social_email = $user->getEmail();
		$social_avatar = $user->getAvatar();
*/

		$check = $this->user_repo->getUserInfo($user->email);
//dd($check->id);

		if ( Config::get('kagi_services.open_registration', true) === true ) {
			if ($check->id == null) {
				$this->user_repo->createSocialUser($user);
				$new_user = $this->user_repo->getUserInfo($user->email);
				$new_user = $this->user->find($new_user->id);
				$new_user->syncRoles([Config::get('kagi.default_role')]);
			}
		}

		if ($check->password == null) {
			if ( Config::get('kagi_services.semi_registration', true) === true ) {
				$this->user_repo->updateSocialUser($user);
			}
		}

		$login_user = $this->user_repo->getUserInfo($user->email);
//dd( Str::lower($login_user->email) );
//dd(Auth::attempt(['email' => $login_user->email, 'password' => Str::lower($login_user->email)]));

		$login_return_path = Config::get('kagi.login_return_path', '/');
//dd($login_return_path);

		if ( Auth::attempt(['email' => $login_user->email, 'password' => $login_user->email]) ) {
//		if ( Auth::attempt(['email' => $login_user->email, 'password' => Str::lower($login_user->email)]) ) {
//dd('checked');
			Auth::loginUsingId($login_user->id);
			$this->registrar_repo->touchLastLogin($login_user->email);

			Flash::success(trans('kotoba::auth.success.login'));
			return redirect($login_return_path);
		}

//dd('huh??');
		return redirect(Config::get('kagi.auth_fail_redirect', '/login'));

	}

}
