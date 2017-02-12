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


class SitesPublicController extends CoreController
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
		$sites = $this->site_repo->getSites();
//dd($sites);

		return Theme::View('core::sites_public.index', compact('sites'));
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
	 * @return Response
	 */
	public function store()
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

		return Theme::View('core::sites_public.show',
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
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


	/**
	* Datatables data
	*
	* @return Datatables JSON
	*/
	public function data()
	{

		$query = Site::select([
				'id', 'name', 'phone_1', 'address', 'website', 'status_id'
				])
			->where('status_id', '=', 1);

		return Datatables::of($query)
			->addColumn(
				'actions',
				'
					<a href="{{ URL::to(\'/sites/\' . $id . \'/\' ) }}" class="btn btn-info btn-sm" >
						<span class="glyphicon glyphicon-search"></span>  {{ trans("kotoba::button.view") }}
					</a>
				'
				)
			->make(true);
	}

}
