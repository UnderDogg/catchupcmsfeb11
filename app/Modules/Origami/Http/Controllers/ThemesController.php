<?php

namespace App\Modules\Origami\Http\Controllers;

use App\Modules\Origami\Http\Requests\DeleteRequest;
use App\Modules\Origami\Http\Requests\ThemeUpdateRequest;

use Cache;
use Config;
use Flash;
use Theme;


class ThemesController extends OrigamiController {


	public function __construct()
	{
		parent::__construct();
// middleware
// 		$this->middleware('auth');
// 		$this->middleware('admin');
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$activeTheme				= Theme::getActive();
		$themes						= Theme::all();
//dd($activeTheme);

		$collection = new \Illuminate\Support\Collection();
		foreach ($themes as $theme) {
			$json_string = Config::get('themes.path', public_path('themes')) . '/' . $theme . '/theme.json';
			$jsondata = file_get_contents($json_string);
			$collection[$theme] = json_decode($jsondata, true);
		}

		return Theme::View('origami::themes.index',
			compact(
				'activeTheme',
				'collection',
				'themes'
			));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  App\requests\UserCreateRequest $request
	 *
	 * @return Response
	 */
	public function store(
		UserCreateRequest $request
		)
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($theme)
	{

		$activeTheme				= Theme::getActive();
		$slug						= Theme::getProperty( $theme . '::slug', trans('kotoba::general.error.no_data') . ':' . trans('kotoba::general.slug'));
		$name						= Theme::getProperty( $theme . '::name', trans('kotoba::general.error.no_data') . ':' . trans('kotoba::general.name'));
		$author						= Theme::getProperty( $theme . '::author', trans('kotoba::general.error.no_data') . ':' . trans('kotoba::general.author'));
		$description				= Theme::getProperty( $theme . '::description', trans('kotoba::general.error.no_data') . ':' . trans('kotoba::general.description'));
		$version					= Theme::getProperty( $theme . '::version', trans('kotoba::general.error.no_data') . ':' . trans('kotoba::general.version'));
//dd($slug);

		if ($activeTheme == $slug ) {
			$checked = 'checked';
		} else {
			$checked = null;
		}
//dd($checked);

		return Theme::View('origami::themes.edit',
			compact(
				'activeTheme',
				'checked',
				'slug',
				'name',
				'author',
				'description',
				'version'
			));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  App\requests\UserUpdateRequest $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		ThemeUpdateRequest $request,
		$slug
		)
	{
//dd($request);

//		$activeTheme				= $request->activeTheme;
		$activeTheme				= Theme::getActive();
		$slug						= $request->slug;
		$name						= $request->name;
		$author						= $request->author;
		$description				= $request->description;
		$version					= $request->version;
		$enabled					= $request->enabled;

		if ( ($slug != $activeTheme) && ($enabled == 1) ) {
			Cache::forget('theme');
			Theme::setActive($slug);
			Cache::forever('theme', $slug);
		}

		Theme::setProperty( $slug . '::slug', $slug);
		Theme::setProperty( $slug . '::name', $name);
		Theme::setProperty( $slug . '::author', $author);
		Theme::setProperty( $slug . '::description', $description);
		Theme::setProperty( $slug . '::version', $version);

		Flash::success( trans('kotoba::cms.success.theme_update') );
		return redirect('admin/themes');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(
		DeleteRequest $request,
		$id
		)
	{
		//
	}


}
