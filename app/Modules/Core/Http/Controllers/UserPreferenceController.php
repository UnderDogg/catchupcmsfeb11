<?php

namespace App\Modules\Core\Http\Controllers;

//use App\Modules\Core\Http\Models\UserPreference;
use App\Modules\Core\Http\Repositories\UserPreferenceRepository;

use Illuminate\Http\Request;
use App\Modules\Core\Http\Requests\DeleteRequest;
use App\Modules\Core\Http\Requests\UserPreferenceCreateRequest;
use App\Modules\Core\Http\Requests\UserPreferenceUpdateRequest;

use Cache;
use Flash;
use Session;
use UserPreference;
use Theme;

class UserPreferenceController extends CoreController {


	/**
	 * UserPreference Repository
	 *
	 * @var UserPreference
	 */
	protected $user_preference_repo;


	public function __construct(
//			UserPreference $user_preference,
			UserPreferenceRepository $user_preference_repo
		)
	{
//		$this->user_preference = $user_preference;
		$this->user_preference_repo = $user_preference_repo;
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
		$user_preferences = $this->user_preference_repo->all();
//		$user_preferences = UserPreference::all();

		return Theme::View('core::user_preferences.index', compact('user_preferences'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return Theme::View('modules.core.user_preferences.create',  $this->user_preference_repo->create());
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(
		UserPreferenceCreateRequest $request
		)
	{
//dd($request);

		Cache::forget('user_preferences');

//		$this->user_preference_repo->store($request);
		UserPreference::set( $request->key, $request->value );
		UserPreference::save();

		Flash::success( trans('kotoba::cms.success.user_preference_create') );
		return redirect('admin/user_preferences');
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
	public function edit($key)
	{
		$lang = Session::get('locale');
//dd($lang);

		$user_preference = $this->user_preference_repo->getKeyValues($key);
//dd($user_preference);

		$modal_title = trans('kotoba::general.command.delete');
		$modal_body = trans('kotoba::general.ask.delete');
		$modal_route = 'admin.user_preferences.destroy';
		$modal_id = $key;
		$model = '$user_preference';
//dd($modal_body);

		return Theme::View('core::user_preferences.edit',
			compact(
				'lang',
				'user_preference',
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
		UserPreferenceUpdateRequest $request,
		$id
		)
	{
//dd($request);

//UserPreference::set('foo.bar', $value)

		Cache::forget('user_preferences');

//		$this->user_preference_repo->update($request->all(), $id);
		UserPreference::set( $request->key, $request->value );
		UserPreference::save();

		Flash::success( trans('kotoba::cms.success.user_preference_update') );
		return redirect('admin/user_preferences');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->user_preference_repo->find($id)->delete();

		return Redirect::route('admin.user_preferences.index');
	}

}
