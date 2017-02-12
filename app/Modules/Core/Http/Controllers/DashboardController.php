<?php

namespace App\Modules\Core\Http\Controllers;

//use App\Modules\Kagi\Http\Models\User;
use App\Http\Models\User;

use Auth;
use Theme;

class DashboardController extends CoreController {

	public function __construct(
			User $user
// 			RoleRepository $role
		)
	{
		$this->user = $user;
// 		$this->role = $role;
// middleware
// 		parent::__construct();
// middleware
		$this->middleware('auth');
		$this->middleware('admin');
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
//dd(Auth::user());

		if ( Auth::user() != null) {
			if ( Auth::user()->can('manage_admin') ) {
//dd(Auth::user());
				return Theme::View('modules.core.dashboard');
			}
//			return Theme::View('modules.core.dashboard');
		}

		return Theme::View('modules.core.landing');

	}

}
