<?php

namespace App\Modules\Menus\Http\Controllers;

use App\Modules\Menus\Http\Models\Menu;
use App\Modules\Menus\Http\Repositories\MenuRepository;

use Illuminate\Http\Request;
use App\Modules\Menus\Http\Requests\DeleteRequest;
use App\Modules\Menus\Http\Requests\MenuCreateRequest;
use App\Modules\Menus\Http\Requests\MenuUpdateRequest;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;

use Cache;
use Flash;
use Theme;


class MenusController extends MenuController {


	/**
	 * Menu Repository
	 *
	 * @var Menu
	 */
	protected $menu;

	public function __construct(
			MenuRepository $menu_repo
		)
	{
		$this->menu_repo = $menu_repo;
// middleware
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
		$menus = $this->menu_repo->all();

		return Theme::View('menus::menus.index', compact('menus'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return Theme::View('menus::menus.create',  $this->menu_repo->create());
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(
		MenuCreateRequest $request
		)
	{
//dd($request);

		$this->menu_repo->store($request->all());
		Cache::flush();

		Flash::success( trans('kotoba::cms.success.menu_create') );
		return redirect('admin/menus');
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
	public function edit($id)
	{
//dd($this->menu_repo->edit($id));
		return Theme::View('menus::menus.edit',
			$this->menu_repo->edit($id));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		MenuUpdateRequest $request,
		$id
		)
	{
//dd($request);

		$this->menu_repo->update($request->all(), $id);
		Cache::flush();

		Flash::success( trans('kotoba::cms.success.menu_update') );
		return redirect('admin/menus');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
//dd($id);
		Menu::find($id)->delete();
		Cache::flush();

		Flash::success( trans('kotoba::cms.success.menu_delete') );
		return redirect('admin/menus');
	}


}
