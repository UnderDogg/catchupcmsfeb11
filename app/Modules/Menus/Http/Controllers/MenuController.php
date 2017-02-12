<?php

namespace App\Modules\Menus\Http\Controllers;

use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Bus\DispatchesJobs;
// use Illuminate\Foundation\Validation\ValidatesRequests;
// use Illuminate\Routing\Controller as BaseController;

use Theme;


class MenuController extends Controller
{


// 	use DispatchesJobs, ValidatesRequests;

	/**
	 * Initializer.
	 *
	 * @return \MenusController
	 */
	public function __construct()
	{
// middleware
		$this->middleware('auth');
		$this->middleware('admin');
	}


	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function welcome()
	{
		return Theme::View('modules.menus.welcome.menus');
	}


}
