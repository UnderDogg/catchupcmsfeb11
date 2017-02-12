<?php

namespace App\Modules\Core\Http\Controllers;

use App\Modules\Core\Http\Repositories\LocaleRepository;

use App\Modules\Core\Http\Models\Status;
use App\Modules\Core\Http\Repositories\StatusRepository;

use Illuminate\Http\Request;
use App\Modules\Core\Http\Requests\DeleteRequest;
use App\Modules\Core\Http\Requests\StatusCreateRequest;
use App\Modules\Core\Http\Requests\StatusUpdateRequest;

use Datatables;
use Flash;
use Session;
use Theme;

class StatusesController extends CoreController {


	/**
	 * Status Repository
	 *
	 * @var Status
	 */
	protected $status;

	public function __construct(
			LocaleRepository $locale_repo,
			Status $status,
			StatusRepository $status_repo
		)
	{
		$this->locale_repo = $locale_repo;
		$this->status = $status;
		$this->status_repo = $status_repo;
// middleware
		parent::__construct();
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

		$lang = Session::get('locale');
		$locale_id = $this->locale_repo->getLocaleID($lang);
		$statuses = $this->status_repo->all();
//dd($statuses);

		return Theme::View('modules.core.statuses.index',
			compact(
				'lang',
				'statuses'
				));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return Theme::View('modules.core.statuses.create',  $this->status_repo->create());
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(
		StatusCreateRequest $request
		)
	{
		$this->status_repo->store($request->all());

		Flash::success( trans('kotoba::general.success.status_create') );
		return redirect('admin/statuses');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
// 		$status = $this->status->findOrFail($id);
//
// 		return View::make('HR::statuses.show', compact('status'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$status = $this->status->find($id);
		$lang = Session::get('locale');
//dd($lang);

		$modal_title = trans('kotoba::general.command.delete');
		$modal_body = trans('kotoba::general.ask.delete');
		$modal_route = 'admin.statuses.destroy';
		$modal_id = $id;
		$model = '$status';

		return Theme::View('modules.core.statuses.edit',
			compact(
				'status',
				'lang',
				'modal_title',
				'modal_body',
				'modal_route',
				'modal_id',
				'model'
		));
//		return View('modules.core.statuses.edit',  $this->status->edit($id));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		StatusUpdateRequest $request,
		$id
		)
	{
//dd($request);
		$this->status_repo->update($request->all(), $id);

		Flash::success( trans('kotoba::general.success.status_update') );
		return redirect('admin/statuses');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->status->find($id)->delete();

		return Redirect::route('admin.statuses.index');
	}


	/**
	* Datatables data
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//		$query = Status::select(array('statuses.id','statuses.name','statuses.description'))
//			->orderBy('statuses.name', 'ASC');
//		$query = Status::select('id', 'name' 'description', 'updated_at');
//			->orderBy('name', 'ASC');
		$query = Status::select('id', 'name', 'description', 'updated_at');
//dd($query);

		return Datatables::of($query)
//			->remove_column('id')

			->addColumn(
				'actions',
				'
					<a href="{{ URL::to(\'admin/statuses/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
						<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
					</a>
				'
				)

			->make(true);
	}


}
