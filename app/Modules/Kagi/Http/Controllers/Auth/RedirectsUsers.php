<?php

namespace App\Modules\Kagi\Http\Controllers\Auth;

use Config;

trait RedirectsUsers
{

	/**
	 * Get the post register / login redirect path.
	 *
	 * @return string
	 */
	public function redirectPath()
	{
		if (property_exists($this, 'redirectPath')) {
			return $this->redirectPath;
		}

		return property_exists($this, 'redirectTo') ? $this->redirectTo : Config::get('kagi.auth_login_path', '/auth/login');
	}

}
