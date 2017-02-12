<?php

namespace App\Modules\Core\Http\Repositories;

use App\Modules\Core\Http\Models\UserPreference;
//use Illuminate\Support\Collection;

use DB;
use Session;

class UserPreferenceRepository extends BaseRepository {

	/**
	 * The Module instance.
	 *
	 * @var App\Modules\ModuleManager\Http\Models\Module
	 */
	protected $user_preference;

	/**
	 * Create a new ModuleRepository instance.
	 *
   	 * @param  App\Modules\ModuleManager\Http\Models\Module $module
	 * @return void
	 */
	public function __construct(
		UserPreference $user_preference
		)
	{
		$this->model = $user_preference;
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
		$user_preference = $this->model->find($id);
//dd($module);

		return compact('user_preference');
	}


	/**
	 * Get user collection.
	 *
	 * @param  int  $id
	 * @return Illuminate\Support\Collection
	 */
	public function edit()
	{
		//
	}


	/**
	 * Get all models.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function store($input)
	{
// 		$this->model = new UserPreference;
// 		$this->model->create($input);
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
//dd($input['enabled']);
		$user_preference = UserPreference::find($id);
		$user_preference->update($input);
	}

	public function getKeyValues($key)
	{

		$values = DB::table('user_preferences')
			->where('key', '=', $key)
			->first();

		return $values;
	}

}
