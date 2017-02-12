<?php

namespace App\Modules\Kantoku\Http\Controllers;

use App\Http\Controllers\Controller;

use Theme;


class KantokuController extends Controller
{


	/**
	 * Initializer.
	 *
	 * @return \CoreController
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
		return Theme::View('modules.kantoku.welcome.kantoku');
	}


}
