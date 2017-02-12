<?php

namespace App\Modules\Menus\Http\Controllers;

use App\Modules\Menus\Http\Models\Menu;
use App\Modules\Menus\Http\Repositories\MenuRepository;
use App\Modules\Menus\Http\Models\Menulink;
use App\Modules\Menus\Http\Repositories\MenuLinkRepository;

use Illuminate\Http\Request;
use App\Modules\Menus\Http\Requests\DeleteRequest;
use App\Modules\Menus\Http\Requests\MenuLinkCreateRequest;
use App\Modules\Menus\Http\Requests\MenuLinkUpdateRequest;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;

use Cache;
//use Datatables;
use Flash;
use Lang;
use Session;
use Theme;


class MenuLinksController extends MenuController {


	/**
	 * MenuLink Repository
	 *
	 * @var Menu
	 */
	protected $menulink;

	public function __construct(
			Menulink $menulink,
			MenuLinkRepository $menulink_repo,
			MenuRepository $menu_repo
		)
	{
		$this->menulink = $menulink;
		$this->menulink_repo = $menulink_repo;
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
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		$lang = Session::get('locale');

		$return_id = $id;

		$menus = $this->menu_repo->all()->lists('name', 'id');

/*
		$all_menus = $this->menu->all()->lists('name', 'id');
$menus = array_add($all_menus, '', trans('kotoba::general.command.select_a') . '&nbsp;' . Lang::choice('kotoba::cms.menu', 1));

		$menu = array('' => trans('kotoba::general.command.select_a') . '&nbsp;' . Lang::choice('kotoba::cms.menu', 1));
		$menu = new Collection($menu);
//dd($menu);
		$menus = $menu->merge($all_menus);
dd($menus);
*/
		return Theme::View('menus::menulinks.create',
			compact(
				'lang',
				'menus',
				'return_id'
			));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(
		MenuLinkCreateRequest $request
		)
	{
//dd($request);
		$this->menulink_repo->store($request->all());
		Cache::flush();

		Flash::success( trans('kotoba::cms.success.menulink_create') );
		return redirect('admin/menulinks/' . $request->menu_id);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Theme::View('menus::menulinks.index',  $this->menulink_repo->show($id));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$link = Menulink::find($id);
		$lang = Session::get('locale');
//dd($link);

		$modal_title = trans('kotoba::general.command.delete');
		$modal_body = trans('kotoba::general.ask.delete');
		$modal_route = 'admin.menulinks.destroy';
		$modal_id = $id;
		$model = '$menulink';

		$return_id = $link->menu_id;
//dd($return_id);

		$menus = $this->menu_repo->all()->lists('name', 'id');
// 		$menu = array('' => trans('kotoba::general.command.select_a') . '&nbsp;' . Lang::choice('kotoba::cms.menu', 1));
// 		$menu = new Collection($menu);
// 		$menus = $menu->merge($all_menus);
//dd($menus);

		return Theme::View('menus::menulinks.edit',
			compact(
				'lang',
				'link',
				'menus',
				'return_id',
				'modal_title',
				'modal_body',
				'modal_route',
				'modal_id',
				'model'
		));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		MenuLinkUpdateRequest $request,
		$id
		)
	{
//dd($request->menu_id);
		$this->menulink_repo->update($request->all(), $id);
		Cache::flush();

		Flash::success( trans('kotoba::cms.success.menulink_update') );
		return redirect('admin/menulinks/' . $request->menu_id);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->menulink->find($id)->delete();
		Cache::flush();


		Flash::success( trans('kotoba::cms.success.menulink_delete') );
		return redirect('admin/menus');
	}


}
