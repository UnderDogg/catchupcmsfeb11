<?php

namespace App\Modules\Core\Http\Controllers;

use App\Modules\Core\Http\Models\Locale;
use App\Modules\Core\Http\Repositories\LocaleRepository;

use Illuminate\Http\Request;
use App\Modules\Core\Http\Requests\DeleteRequest;
use App\Modules\Core\Http\Requests\LocaleCreateRequest;
use App\Modules\Core\Http\Requests\LocaleUpdateRequest;

use Cache;
use Flash;
use Theme;

class LocalesController extends CoreController {

	/**
	 * Locale Repository
	 *
	 * @var Locale
	 */
	protected $locale;

	public function __construct(
			Locale $locale,
			LocaleRepository $locale_repo
		)
	{
		$this->locale = $locale;
		$this->locale_repo = $locale_repo;
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
		$locales = $this->locale_repo->all();
//dd($locales);

		return Theme::View('core::locales.index', compact('locales'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return Theme::View('core::locales.create',  $this->locale_repo->create());
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(
		LocaleCreateRequest $request
		)
	{
		Cache::forget('languages');
		$this->locale_repo->store($request->all());

		Flash::success( trans('kotoba::cms.success.locale_create') );
		return redirect('admin/locales');
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
		$locale = $this->locale->find($id);

		$modal_title = trans('kotoba::general.command.delete');
		$modal_body = trans('kotoba::general.ask.delete');
		$modal_route = 'admin.locales.destroy';
		$modal_id = $id;
		$model = '$locale';
//dd($modal_body);

		return Theme::View('core::locales.edit',
			compact(
				'locale',
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
		LocaleUpdateRequest $request,
		$id
		)
	{
		Cache::forget('languages');
		$this->locale_repo->update($request->all(), $id);

		Flash::success( trans('kotoba::cms.success.locale_update') );
		return redirect('admin/locales');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->locale_repo->find($id)->delete();

		return Redirect::route('admin.locales.index');
	}

}
