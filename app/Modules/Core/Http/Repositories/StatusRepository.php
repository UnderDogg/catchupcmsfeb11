<?php

namespace App\Modules\Core\Http\Repositories;

use App\Modules\Core\Http\Models\Status;
use Illuminate\Support\Collection;

use App;
use Cache;
use Config;
use DB;
use Session;

class StatusRepository extends BaseRepository {


	/**
	 * The Module instance.
	 *
	 * @var App\Modules\ModuleManager\Http\Models\Module
	 */
	protected $status;


	/**
	 * Create a new ModuleRepository instance.
	 *
   	 * @param  App\Modules\ModuleManager\Http\Models\Module $module
	 * @return void
	 */
	public function __construct(
		Status $status
		)
	{
		$this->model = $status;
	}


	/**
	 * Get role collection.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function create()
	{
//		$allPermissions =  $this->permission->all()->lists('name', 'id');
//dd($allPermissions);

		return compact('');
	}


	/**
	 * Get user collection.
	 *
	 * @param  string  $slug
	 * @return Illuminate\Support\Collection
	 */
	public function show($id)
	{
		$status = $this->model->find($id);
		return compact('status');
	}


	/**
	 * Get user collection.
	 *
	 * @param  int  $id
	 * @return Illuminate\Support\Collection
	 */
	public function edit($id)
	{
		$status = $this->model->find($id);
//dd($status);
		return compact('status');
	}


	/**
	 * Get all models.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function store($input)
	{
//dd($input);
// 		$this->model = new Status;
// 		$this->model->create($input);

		$status = Status::create($values);

		$locales = Cache::get('languages');
		$original_locale = Session::get('locale');
//dd($original_locale);

		foreach($locales as $locale => $properties)
		{

			App::setLocale($properties->locale);

			$values = [
				'name'				=> $input['name_'.$properties->id],
				'description'		=> $input['description_'.$properties->id]
			];

			$status->update($values);

		}

		App::setLocale($original_locale, Config::get('app.fallback_locale'));
		return;
	}


	/**
	 * Update a role.
	 *
	 * @param  array  $inputs
	 * @param  int    $id
	 * @return void
	 */
	public function update($input, $id)
	{
//dd($input);
// 		$status = Status::find($id);
// 		$status->update($input);

		$status = Status::find($id);

		$locales = Cache::get('languages');
		$original_locale = Session::get('locale');
//dd($locales);

		foreach($locales as $locale => $properties)
		{

			App::setLocale($properties->locale);

			$values = [
				'name'				=> $input['name_'.$properties->id],
				'description'		=> $input['description_'.$properties->id]
			];

			$status->update($values);

		}

		App::setLocale($original_locale, Config::get('app.fallback_locale'));
		return;
	}



// Functions ---------------------------------------------------------------


// lists

	public function listStatuses($locale_id)
	{
		$statuses = DB::table('status_translations')
			->where('locale_id', '=', $locale_id)
			->orderBy('id')
			->lists('name', 'id');

		return $statuses;
	}

// get

	public function getStatuses($locale_id)
	{
		$statuses = DB::table('status_translations')
			->where('locale_id', '=', $locale_id)
			->orderBy('id')
			->lists('name', 'id');

		return $statuses;
	}
/*
	public function getStatuses()
	{
		$statuses = DB::table('statuses')->lists('name', 'id');
		return $statuses;
	}
*/


}
