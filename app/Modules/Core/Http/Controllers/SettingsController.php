<?php

namespace App\Modules\Core\Http\Controllers;

//use App\Modules\Core\Http\Models\Setting;
use App\Modules\Core\Http\Repositories\SettingRepository;

use Illuminate\Http\Request;
use App\Modules\Core\Http\Requests\DeleteRequest;
use App\Modules\Core\Http\Requests\SettingCreateRequest;
use App\Modules\Core\Http\Requests\SettingUpdateRequest;

use Cache;
use Flash;
use Session;
use Setting;
use Theme;

class SettingsController extends CoreController {


	/**
	 * Setting Repository
	 *
	 * @var Setting
	 */
	protected $setting_repo;


	public function __construct(
//			Setting $setting,
			SettingRepository $setting_repo
		)
	{
//		$this->setting = $setting;
		$this->setting_repo = $setting_repo;
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
		$settings = $this->setting_repo->all();
//		$settings = Setting::all();

		return Theme::View('core::settings.index', compact('settings'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return Theme::View('modules.core.settings.create',  $this->setting_repo->create());
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(
		SettingCreateRequest $request
		)
	{
//dd($request);

		Cache::forget('settings');

//		$this->setting_repo->store($request);
		Setting::set( $request->key, $request->value );
		Setting::save();

		Flash::success( trans('kotoba::cms.success.setting_create') );
		return redirect('admin/settings');
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

		$setting = $this->setting_repo->getKeyValues($key);

		$key = $setting->key;
		$value = $setting->value;
//dd($key);

		$modal_title = trans('kotoba::general.command.delete');
		$modal_body = trans('kotoba::general.ask.delete');
		$modal_route = 'admin.settings.destroy';
		$modal_id = $key;
		$model = '$setting';
//dd($modal_body);

		return Theme::View('core::settings.edit',
			compact(
				'lang',
				'key',
				'value',
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
		SettingUpdateRequest $request,
		$key
		)
	{
//dd($request);

		Cache::forget('settings');

//		$this->setting_repo->update($request->all(), $id);
		Setting::set( $request->key, $request->value );
		Setting::save();

		Flash::success( trans('kotoba::cms.success.setting_update') );
		return redirect('admin/settings');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->setting_repo->find($id)->delete();

		return Redirect::route('admin.settings.index');
	}

}
