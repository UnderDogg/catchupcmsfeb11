<?php

namespace App\Modules\Core\Http\Controllers;

use App\Modules\Core\Http\Repositories\LocaleRepository;
use App\Modules\Core\Http\Repositories\StatusRepository;

use App\Modules\Core\Http\Models\Site;
use App\Modules\Core\Http\Repositories\SiteRepository;
use App\Modules\Filex\Http\Repositories\ImageRepository;

use App\Modules\Shisan\Http\Models\Asset;
use App\Modules\Jinji\Http\Models\Employee;
use App\Modules\Shisan\Http\Models\Room;

use Illuminate\Http\Request;
use App\Modules\Core\Http\Requests\DeleteRequest;
use App\Modules\Core\Http\Requests\SiteCreateRequest;
use App\Modules\Core\Http\Requests\SiteUpdateRequest;

use Auth;
use Config;
use Datatables;
use File;
use Flash;
use Image;
use Lang;
use Session;
use Theme;


class SitesController extends CoreController
{

	/**
	 * Site Repository
	 *
	 * @var Site
	 */
	protected $request;
	protected $site;

	public function __construct(
			Request $request,
			LocaleRepository $locale_repo,
			StatusRepository $status_repo,
			Site $site,
			SiteRepository $site_repo,
			ImageRepository $image_repo
		)
	{
		$this->request = $request;
		$this->locale_repo = $locale_repo;
		$this->status_repo = $status_repo;
		$this->site = $site;
		$this->site_repo = $site_repo;
		$this->image_repo = $image_repo;
// middleware
//		$this->middleware('guest');
//		$this->middleware('admin', ['only' => 'create', 'edit', 'destroy']);
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Theme::View('core::sites.index');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		$lang = Session::get('locale');
		$locale_id = $this->locale_repo->getLocaleID($lang);
//dd($locale_id);

		$contacts = $this->site_repo->getContacts();
		$contacts = array('' => trans('kotoba::general.command.select_a') . '&nbsp;' . trans('kotoba::general.contact')) + $contacts;

		$statuses = $this->status_repo->getStatuses($locale_id);
		$statuses = array('' => trans('kotoba::general.command.select_a') . '&nbsp;' . Lang::choice('kotoba::general.status', 1) ) + $statuses;

		$get_images = $this->site_repo->getImages();

		return Theme::View('modules.core.sites.create',
			compact(
				'contacts',
				'get_images',
				'statuses'
		));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(
		SiteCreateRequest $request
		)
	{
		$this->site_repo->store($request->all());

		Flash::success( trans('kotoba::hr.success.site_create') );
		return redirect('sites');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

		$lang = Session::get('locale');
		$locale_id = $this->locale_repo->getLocaleID($lang);
//dd($locale_id);

		$site = $this->site->find($id);
//		$site = $this->site->with('rooms', 'employees', 'assets')->find($id);
//dd($site);
//dd($site->employees);

// 		$assets = Asset::where('site_id', $id)->get();
		$assets = $this->site_repo->getAssets($id);
//		$employees = $this->site_repo->getEmployees($id);
		$employees = Employee::where('site_id', $id)->get();
//dd($employees);
//		$rooms = Room::where('site_id', $id)->get();
		$rooms = $this->site_repo->getRooms($id);
//dd($rooms);

//dd($site->division_id);
//		$division = $site->present()->divisionName($site->division_id);
//		$contact = $site->present()->contactName($site->user_id);
		$image = $this->image_repo->getImageByID($site->image_id);

		if ( Auth::user() ) {
			if ( (Auth::user()->can('manage_admin')) || (Auth::user()->can('manage_jinji')) ) {
			} else {
			}
			if ( (Auth::user()->can('manage_admin')) || (Auth::user()->can('manage_shisan')) ) {
			} else {
			}
		}

		return Theme::View('core::sites.show',
			compact(
				'locale_id',
				'contact',
				'assets',
				'employees',
				'rooms',
				'image',
				'site'
			));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$lang = Session::get('locale');
		$locale_id = $this->locale_repo->getLocaleID($lang);
//dd($locale_id);

//		$site = $this->site->with('images')->find($id);
		$site = $this->site->find($id);

		$image = $this->image_repo->getImageByID($site->image_id);
//dd($image);

		$contacts = $this->site_repo->getContacts();
		$contacts = array('' => trans('kotoba::general.command.select_a') . '&nbsp;' . trans('kotoba::general.contact')) + $contacts;

		$statuses = $this->status_repo->getStatuses($locale_id);
		$statuses = array('' => trans('kotoba::general.command.select_a') . '&nbsp;' . Lang::choice('kotoba::general.status', 1) ) + $statuses;

		$get_images = $this->site_repo->getImages();

		$modal_title = trans('kotoba::general.command.delete');
		$modal_body = trans('kotoba::general.ask.delete');
		$modal_route = 'admin.sites.destroy';
		$modal_id = $id;
		$model = '$site';

		return Theme::View('core::sites.edit',
			compact(
				'contacts',
				'logo',
				'site',
				'statuses',
				'image',
				'get_images',
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
		SiteUpdateRequest $request,
		$id
		)
	{
		$this->site_repo->update($request->all(), $id);

		Flash::success( trans('kotoba::hr.success.site_update') );
		return redirect('/admin/sites');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->site_repo->find($id)->delete();

		return Redirect::route('admin.sites.index');
	}


	/**
	* Datatables data
	*
	* @return Datatables JSON
	*/
	public function data()
	{
//		$query = Site::select(array('sites.id','sites.name','sites.description'))
//			->orderBy('sites.name', 'ASC');
//		$query = Site::select('id', 'name' 'description', 'updated_at');
//			->orderBy('name', 'ASC');
		$query = Site::select('id', 'name', 'phone_1', 'address', 'website');
//			->where('staus_id', '=', 1);
//dd($query);

// 		$query = Site::select([
// 			'sites.id', 'sites.name', 'sites.phone_1', 'sites.website',
// 			'profiles.first_name', 'profiles.last_name',
// //			'divisions.description',
// 		])
// 		->leftJoin('profiles', 'profiles.id', '=', 'sites.user_id');
// //		->leftJoin('divisions','divisions.id','=','sites.division_id');


		$query = Site::select([
				'id', 'name', 'phone_1', 'address', 'website', 'status_id'
				])
			->where('status_id', '=', 1);



		if ( Auth::user() ) {
			if ( (Auth::user()->can('manage_admin')) || (Auth::user()->can('manage_core')) ) {
				return Datatables::of($query)
//			->remove_column('id')

// 			-> edit_column(
// 				'division_id',
// 				'{{ $query->present()->divisionName(division_id) }}'
// 				)
// 			-> edit_column(
// 				'blocked',
// 				'@if ($blocked=="1") <span class="glyphicon glyphicon-ok text-success"></span> @else <span class=\'glyphicon glyphicon-remove text-danger\'></span> @endif'
// 				)

					->addColumn(
						'actions',
						'
							<a href="{{ URL::to(\'admin/sites/\' . $id . \'/\' ) }}" class="btn btn-info btn-sm" >
								<span class="glyphicon glyphicon-search"></span>  {{ trans("kotoba::button.view") }}
							</a>
							<a href="{{ URL::to(\'/admin/sites/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
								<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
							</a>
						'
						)

					->make(true);
			}
		} else {
			return Datatables::of($query)
				->addColumn(
					'actions',
					'
						<a href="{{ URL::to(\'admin/sites/\' . $id . \'/\' ) }}" class="btn btn-info btn-sm" >
							<span class="glyphicon glyphicon-search"></span>  {{ trans("kotoba::button.view") }}
						</a>
					'
					)
				->make(true);
		}
	}

}
