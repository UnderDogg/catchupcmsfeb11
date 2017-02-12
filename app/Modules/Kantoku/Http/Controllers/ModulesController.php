<?php

namespace App\Modules\Kantoku\Http\Controllers;

use App\Modules\Kantoku\Http\Requests\DeleteRequest;
use App\Modules\Kantoku\Http\Requests\ModuleUpdateRequest;

use Cache;
use Config;
use Flash;
use Module;
use Theme;


class ModulesController extends KantokuController {

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

//		$activeModule				= Module::getActive();
		$modules					= Module::all();

		return Theme::View('kantoku::modules.index',
			compact(
// 				'activeModule',
				'modules'
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
	public function edit($module)
	{

//		$activeModule				= Module::getActive();
		$name						= Module::getProperty( $module . '::name', trans('kotoba::general.error.no_data') . ':' . trans('kotoba::general.name'));
		$slug						= Module::getProperty( $module . '::slug', trans('kotoba::general.error.no_data') . ':' . trans('kotoba::general.slug'));
		$version					= Module::getProperty( $module . '::version', trans('kotoba::general.error.no_data') . ':' . trans('kotoba::general.version'));
		$description				= Module::getProperty( $module . '::description', trans('kotoba::general.error.no_data') . ':' . trans('kotoba::general.description'));
		$enabled					= Module::getProperty( $module . '::enabled', trans('kotoba::general.error.no_data') . ':' . trans('kotoba::general.enabled'));
		$order						= Module::getProperty( $module . '::order', trans('kotoba::general.error.no_data') . ':' . trans('kotoba::general.order'));
//dd($slug);

		if ($enabled == true ) {
			$checked = 'checked';
		} else {
			$checked = null;
		}
//dd($checked);

		return Theme::View('kantoku::modules.edit',
			compact(
// 				'activeModule',
				'checked',
				'name',
				'slug',
				'description',
				'version',
				'enabled',
				'order'
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
		ModuleUpdateRequest $request,
		$slug
		)
	{
//dd($slug);

// 		$activeModule				= Module::getActive();
		$name						= $request->name;
		$slug						= $request->slug;
		$description				= $request->description;
		$version					= $request->version;
		$enabled					= $request->enabled;
		$order						= $request->order;

		if ( (Module::isDisabled($slug)) && ($enabled == 1)) {
			Module::enable($slug);
//			Cache::forever('module', $slug);
		} else {
			Module::disable($slug);
		}

		Module::setProperty( $slug . '::name', $name);
		Module::setProperty( $slug . '::slug', $slug);
		Module::setProperty( $slug . '::description', $description);
		Module::setProperty( $slug . '::version', $version);
		Module::setProperty( $slug . '::order', $order);
		Module::setProperty( $slug . '::enabled', $enabled);

		Flash::success( trans('kotoba::cms.success.module_update') );
		return redirect('admin/modules');
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
