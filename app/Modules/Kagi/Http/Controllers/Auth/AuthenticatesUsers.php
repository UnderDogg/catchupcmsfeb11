<?php

namespace App\Modules\Kagi\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use Config;
use Flash;
use Theme;

trait AuthenticatesUsers
{

	use RedirectsUsers;

	/**
	 * Show the application login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogin()
	{
		return Theme::View('modules.kagi.auth.login');
	}


	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postLogin(Request $request)
	{
		$this->validate($request, [
			$this->loginUsername() => 'required', 'password' => 'required',
		]);

		// If the class is using the ThrottlesLogins trait, we can automatically throttle
		// the login attempts for this application. We'll key this by the username and
		// the IP address of the client making these requests into this application.
		$throttles = $this->isUsingThrottlesLoginsTrait();

		if ($throttles && $this->hasTooManyLoginAttempts($request)) {
			return $this->sendLockoutResponse($request);
		}

		$credentials = $this->getCredentials($request);

		$check_if_allow_direct = $this->registrar_repo->checkAllowDirect($credentials['email']);
		if ( $check_if_allow_direct == true ) {

			$check_if_no_bans = $this->registrar_repo->checkUserApproval($credentials['email']);
			if ( $check_if_no_bans == true ) {

				if (Auth::attempt($credentials, $request->has('remember'))) {
					return $this->handleUserWasAuthenticated($request, $throttles);
				}

				// If the login attempt was unsuccessful we will increment the number of attempts
				// to login and redirect the user back to the login form. Of course, when this
				// user surpasses their maximum number of attempts they will get locked out.
				if ($throttles) {
					$this->incrementLoginAttempts($request);
				}

			}

		}

			return redirect($this->loginPath())
				->withInput($request->only($this->loginUsername(), 'remember'))
				->withErrors([
					$this->loginUsername() => $this->getFailedLoginMessage(),
				]);

	}


	/**
	 * Send the response after the user was authenticated.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  bool  $throttles
	 * @return \Illuminate\Http\Response
	 */
	protected function handleUserWasAuthenticated(Request $request, $throttles)
	{

		if ($throttles) {
			$this->clearLoginAttempts($request);
		}

		if (method_exists($this, 'authenticated')) {
			return $this->authenticated($request, Auth::user());
		}

		$check = $this->registrar_repo->touchLastLogin($request->email);
		Flash::success(trans('kotoba::auth.success.login'));

		return redirect()->intended($this->redirectPath());
	}


	/**
	 * Get the needed authorization credentials from the request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	protected function getCredentials(Request $request)
	{
		return $request->only($this->loginUsername(), 'password');
	}


	/**
	 * Get the failed login message.
	 *
	 * @return string
	 */
	protected function getFailedLoginMessage()
	{
//		return 'These credentials do not match our records.';
		Flash::error(trans('kotoba::auth.error.not_approved'));
	}


	/**
	 * Log the user out of the application.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogout()
	{
		Auth::logout();

		Flash::error(trans('kotoba::auth.success.logout'));
		return redirect( property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : Config::get('kagi.logout_return_path', '/login') );
	}


	/**
	 * Get the path to the login route.
	 *
	 * @return string
	 */
	public function loginPath()
	{
		return property_exists($this, 'loginPath') ? $this->loginPath : Config::get('kagi.auth_login_path', '/auth/login');
	}


	/**
	 * Get the login username to be used by the controller.
	 *
	 * @return string
	 */
	public function loginUsername()
	{
		return property_exists($this, 'username') ? $this->username : 'email';
	}


	/**
	 * Determine if the class is using the ThrottlesLogins trait.
	 *
	 * @return bool
	 */
	protected function isUsingThrottlesLoginsTrait()
	{
		return in_array(
			ThrottlesLogins::class, class_uses_recursive(get_class($this))
		);
	}

}
