<?php

namespace App\Modules\Profiles\Http\Controllers;

use App\Modules\Profiles\Http\Models\Profile;
use App\Modules\Profiles\Http\Repositories\ProfileRepository;
use App\Modules\Kagi\Http\Models\User;
use App\Modules\Kagi\Http\Repositories\UserRepository;

use Illuminate\Http\Request;
use App\Modules\Profiles\Http\Requests\ProfileCreateRequest;
use App\Modules\Profiles\Http\Requests\ProfileUpdateRequest;
use App\Modules\Profiles\Http\Requests\DeleteRequest;

use Auth;
use Datatables;
use Flash;
use Setting;
use Theme;


class ProfilesController extends ProfileController {


	/**
	 * The UserRepository instance.
	 *
	 * @var App\Modules\Kagi\Http\Repositories\UserRepository
	 */
	protected $user;


	/**
	 * The RoleRepository instance.
	 *
	 * @var App\Modules\Profiles\Http\Repositories\ProfileRepository
	 */
	protected $profile;


	/**
	 * Create a new UserController instance.
	 *
	 * @param  App\Modules\Kagi\Http\Repositories\UserRepository $user
	 * @param  App\Modules\Profiles\Http\Repositories\ProfileRepository $profile
	 * @return void
	 */
	public function __construct(
			Profile $profile,
			ProfileRepository $profile_repo,
			UserRepository $user
		)
	{
		$this->profile = $profile;
		$this->profile_repo = $profile_repo;
		$this->user = $user;
// middleware
		//$this->middleware('auth');
//		$this->middleware('profiles');
// 		$this->middleware('admin', ['only' => 'destroy']);
//		$this->middleware('ajax', ['only' => 'updateSeen']);
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Theme::View('profiles::profiles.index');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return Theme::View('profiles::profiles.create');
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
//dd("store");
		$this->user->store($request->all());

		return redirect('user')->with('ok', trans('back/users.created'));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

		if ( (Auth::id() == $id) || (Auth::user()->can('manage_admin')) || (Auth::user()->can('manage_profiles')) ) {

			$profile = $this->profile_repo->show($id);

			$modal_title = trans('kotoba::general.command.delete');
			$modal_body = trans('kotoba::general.ask.delete');
			$modal_route = 'profiles.destroy';
			$modal_id = $id;
			$model = '$profile';

			return Theme::View('profiles::profiles.show',
					compact(
						'profile',
						'modal_title',
						'modal_body',
						'modal_route',
						'modal_id',
						'model'
				));
		} else {
			return redirect('directory');
		}
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
//dd($id);
//dd(Auth::id());
		if ( ( Auth::id() != null ) && ((Auth::id() == $id) || (Auth::user()->can('manage_admin')) || (Auth::user()->can('manage_profiles'))) ) {
//dd("edit");
			$profile = $this->profile_repo->edit($id);
//dd($profile);

		$allow_user_edits = Setting::get('allow_user_edits');
//dd($allow_user_edits);

			$modal_title = trans('kotoba::general.command.delete');
			$modal_body = trans('kotoba::general.ask.delete');
			$modal_route = 'profiles.destroy';
			$modal_id = $id;
			$model = '$profile';

			return View('profiles::profiles.edit',
//				$this->profile_repo->edit($id),
					compact(
						'allow_user_edits',
						'profile',
						'modal_title',
						'modal_body',
						'modal_route',
						'modal_id',
						'model'
				));
//			return View('profiles::profiles.edit',  $this->profile_repo->edit($id));
		} else {
			return Theme::View('profiles::profiles.index');
		}
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  App\requests\UserUpdateRequest $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		ProfileUpdateRequest $request,
		$id
		)
	{
//dd($request->password);
		$this->profile_repo->update($request->all(), $id);
		Flash::success( trans('kotoba::account.success.update') );

		if (Auth::user()->can('manage_admin')) {
			return redirect('admin/employees');
		} else {
//			return redirect('profiles/' . $id);
			return redirect('staff/dashboard/' . $id);
		}

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
//dd('destroy');
//		$this->profile_repo->destroy($id);
		$profile= Profile::find($id);
//		$profile->roles()->detach();
		$profile->delete();

//		$this->user->destroy($id);
//		return redirect('user')->with('ok', trans('back/users.destroyed'));
		Flash::success( trans('kotoba::account.success.delete') );
		return redirect('profiles');
	}


	/**
	* Datatables data
	*
	* @return Datatables JSON
	*/
	public function data()
	{

		$query = Profile::select(
			'id',
			'user_id',
			'first_name',
			'last_name',
			'email_1',
			'email_2'
			)
			->orderBy('profiles.last_name', 'ASC');
/*
		$query = Employee::join('profiles','employees.profile_id','=','profiles.id')
			->join('sites','employees.site_id','=','sites.id')
			->where('employees.status_id', '=', 1)
			->select([
				'employees.id',
				'profiles.first_name',
				'profiles.last_name',
				'profiles.email_1',
				'sites.name',
				]);
*/
//dd($query);

if (Auth::user()->can('manage_profiles')) {
		return Datatables::of($query)
			->addColumn(
				'actions',
				'
					<a href="{{ URL::to(\'profiles/\' . $user_id . \'/\' ) }}" class="btn btn-info btn-sm" >
						<span class="glyphicon glyphicon-search"></span>  {{ trans("kotoba::button.view") }}
					</a>
					<a href="{{ URL::to(\'profiles/\' . $user_id . \'/edit\' ) }}" class="btn btn-success btn-sm" >
						<span class="glyphicon glyphicon-pencil"></span>  {{ trans("kotoba::button.edit") }}
					</a>
				'
				)
			->make(true);
} else {
		return Datatables::of($query)
			->addColumn(
				'actions',
				'
					<a href="{{ URL::to(\'profiles/\' . $user_id . \'/\' ) }}" class="btn btn-info btn-sm" >
						<span class="glyphicon glyphicon-search"></span>  {{ trans("kotoba::button.view") }}
					</a>
				'
				)
			->make(true);
}
	}


}
