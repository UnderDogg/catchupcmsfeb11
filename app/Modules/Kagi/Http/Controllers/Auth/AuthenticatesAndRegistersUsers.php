<?php

namespace App\Modules\Kagi\Http\Controllers\Auth;

trait AuthenticatesAndRegistersUsers
{

	use AuthenticatesUsers, RegistersUsers {
		AuthenticatesUsers::redirectPath insteadof RegistersUsers;
	}

}
