<?php

namespace App\Modules\Kagi\Http\Repositories;

use App\Modules\Kagi\Http\Models\Permission;
use Illuminate\Http\Request;


class PermissionRepository extends BaseRepository {

	/**
	 * The Role instance.
	 *
	 * @var App\Modules\Kagi\Http\Models\Permission
	 */
	protected $permission;

	/**
	 * Create a new PermissionRepository instance.
	 *
	 * @param  App\Modules\Kagi\Http\Models\Permission $permission
	 * @return void
	 */
	public function __construct(
		Permission $permission
		)
	{
		$this->model = $permission;
	}


	/**
	 * Get role collection.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function create()
	{
		//
	}


	/**
	 * Get user collection.
	 *
	 * @param  int  $id
	 * @return Illuminate\Support\Collection
	 */
	public function edit($id)
	{
		$permission = $this->getById($id);
		return compact('permission');
	}


	/**
	 * Get all models.
	 *
	 * @param  array  $input
	 * @return Illuminate\Support\Collection
	 */
	public function store($input)
	{
//dd($input);
		$this->model = new Permission;
		$this->model->create($input);
	}


	/**
	 * Update a permission.
	 *
	 * @param  array  $input
	 * @param  int    $id
	 * @return void
	 */
	public function update($input, $id)
	{
		$permission = $this->getById($id);
		$permission->update($input);
	}

}
