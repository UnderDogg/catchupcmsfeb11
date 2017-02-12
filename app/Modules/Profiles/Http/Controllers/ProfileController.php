<?php

namespace App\Modules\Profiles\Http\Controllers;

use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Bus\DispatchesJobs;
// use Illuminate\Foundation\Validation\ValidatesRequests;
// use Illuminate\Routing\Controller as BaseController;

use Theme;


class ProfileController extends Controller
{


// 	use DispatchesJobs, ValidatesRequests;


	/**
	 * Initializer.
	 *
	 * @return \CoreController
	 */
	public function __construct()
	{
// middleware
		//$this->middleware('auth');
		//$this->middleware('admin');
	}


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function welcome()
	{
		return Theme::View('modules.profiles.welcome.profiles');
	}


}
