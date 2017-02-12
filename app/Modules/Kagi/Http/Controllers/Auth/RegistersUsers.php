<?php

namespace App\Modules\Kagi\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Config;
use Flash;
use Theme;

trait RegistersUsers
{

	use RedirectsUsers;

	/**
	 * Show the application registration form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getRegister()
	{
		return Theme::View('modules.kagi.auth.register');
	}


	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postRegister(Request $request)
	{
		if ( Config::get('kagi_services.open_registration', true) === true ) {
			$validator = $this->validator($request->all());
//dd($validator);

			if ($validator->fails()) {
				$this->throwValidationException(
					$request, $validator
				);
			}

			$this->user_repo->store($request->all());

			Flash::success(trans('kotoba::email.success.sent'));
			return Theme::View('modules.kagi.auth.login');
		}

		return Theme::View('modules.kagi.auth.login');
	}

/*
|--------------------------------------------------------------------------
| Confirm Users
|--------------------------------------------------------------------------
*/

	/**
	 * Attempt to confirm account with code
	 *
	 * @param  string $code
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function getConfirm($code)
	{
//dd($code);

		$confirmedCode = $this->registrar_repo->confirmCode($code);
//dd($confirmedCode);

		if ( $confirmedCode != null ) {
			Flash::success( trans('kotoba::auth.success.confirmation') );
			return Theme::View('modules.kagi.auth.confirm')->with(compact('code'));
		} else {
			Flash::error( trans('kotoba::auth.error.confirmation') );
			return Theme::View('modules.kagi.auth.login');
		}
	}


	/**
	 * Attempt to confirm account with email and then change confirmed status
	 *
	 * @param  string $code
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function postConfirm(
		Request $request,
		$code
		)
	{
//dd($code);
		$user = $this->registrar_repo->confirmEmail($request->email);
//dd($user);

		if ( $user != null) {
			$this->registrar_repo->confirmUser($user);
			$this->registrar_repo->activateUser($user);

			Flash::success( trans('kotoba::auth.success.confirmed') );
			return Theme::View('modules.kagi.auth.login');
		} else {

			Flash::error( trans('kotoba::auth.error.email') );
			return redirect('auth/confirm/'.$code)
				->withInput($request->only('email'));
		}

	}

}
