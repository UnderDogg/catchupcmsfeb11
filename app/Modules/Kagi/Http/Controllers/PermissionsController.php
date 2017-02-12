<?php

namespace App\Modules\Kagi\Http\Controllers;

use App\Modules\Kagi\Http\Models\Permission;
use App\Modules\Kagi\Http\Repositories\PermissionRepository;

use Illuminate\Http\Request;
use App\Modules\Kagi\Http\Requests\PermissionCreateRequest;
use App\Modules\Kagi\Http\Requests\PermissionUpdateRequest;
use App\Modules\Kagi\Http\Requests\DeleteRequest;

use Datatables;
use DB;
use Flash;
use Form;
use Theme;


class PermissionsController extends KagiController {

	/**
	 * The UserRepository instance.
	 *
	 * @var App\Modules\Kagi\Http\Repositories\PermissionRepository
	 */
	protected $permissions;

	/**
	 * Create a new PermissionsController instance.
	 *
	 * @param  App\Modules\Kagi\Http\Repositories\PermissionRepository $permission
	 * @return void
	 */
	public function __construct(
			PermissionRepository $permission
		)
	{
		$this->permission = $permission;
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
		return Theme::View('modules.kagi.permissions.index');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return Theme::View('modules.kagi.permissions.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  App\Modules\Kagi\Http\Requests\PermissionCreateRequest $request
	 *
	 * @return Response
	 */
	public function store(
		PermissionCreateRequest $request
		)
	{
		$this->permission->store($request->all());

		Flash::success( trans('kotoba::permission.success.create') );
		return redirect('admin/permissions');
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
		$permission = Permission::find($id);

		$modal_title = trans('kotoba::general.command.delete');
		$modal_body = trans('kotoba::general.ask.delete');
		$modal_route = 'admin.permissions.destroy';
		$modal_id = $id;
		$model = '$permission';
//dd($modal_body);

		return Theme::View('modules.kagi.permissions.edit',
			compact(
				'permission',
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
	 * @param  App\Modules\Kagi\Http\Requests\PermissionUpdateRequest $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		PermissionUpdateRequest $request,
		$id
		)
	{
//dd("update");
		$this->permission->update($request->all(), $id);

		Flash::success( trans('kotoba::permission.success.update') );
		return redirect('admin/permissions');
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
		$this->permission->destroy($id);

		Flash::success( trans('kotoba::permission.success.delete') );
		return redirect('admin/permissions');
	}


	/**
	* Datatables data
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//		$query = Permission::select(array('permissions.id','permissions.name','permissions.slug','permissions.description','permissions.updated_at'))
//			->orderBy('permissions.name', 'ASC');
//		$query = Permission::select('id', 'name', 'slug', 'description', 'updated_at')
//			->orderBy('name', 'ASC');
		$query = Permission::select('id', 'name', 'slug', 'description', 'updated_at');
//dd($query);

		return Datatables::of($query)
//			->remove_column('id')

			->addColumn(
				'actions',
				'
					<a href="{{ URL::to(\'admin/permissions/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
						<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
					</a>
				'
				)

			->make(true);
	}

}
