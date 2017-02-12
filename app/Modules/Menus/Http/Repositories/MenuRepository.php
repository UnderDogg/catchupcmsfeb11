<?php

namespace App\Modules\Menus\Http\Repositories;

//use App\Modules\Menus\Http\Models\Locale;
use App\Modules\Menus\Http\Models\Menu;
use Illuminate\Support\Collection;

use App;
use Cache;
use DB;
use Session;


class MenuRepository extends BaseRepository {


	/**
	 * The Module instance.
	 *
	 * @var App\Modules\ModuleManager\Http\Models\Module
	 */
	protected $menu;


	/**
	 * Create a new ModuleRepository instance.
	 *
   	 * @param  App\Modules\ModuleManager\Http\Models\Module $module
	 * @return void
	 */
	public function __construct(
		Menu $menu
		)
	{
		$this->model = $menu;
	}


	/**
	 * Get role collection.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function create()
	{
		$lang = Session::get('locale');

		return compact('lang');
	}


	/**
	 * Get user collection.
	 *
	 * @param  string  $slug
	 * @return Illuminate\Support\Collection
	 */
	public function show($id)
	{
		$menu = $this->model->find($id);
		$links = Menu::find($id)->menulinks;

		return compact('menu', 'links');
	}


	/**
	 * Get user collection.
	 *
	 * @param  int  $id
	 * @return Illuminate\Support\Collection
	 */
	public function edit($id)
	{
		$menu = $this->model->find($id);
		$lang = Session::get('locale');
//dd($menu->enable);

		$modal_title = trans('kotoba::general.command.delete');
		$modal_body = trans('kotoba::general.ask.delete');
		$modal_route = 'admin.menus.destroy';
		$modal_id = $id;
		$model = '$menu';

		return compact(
			'lang',
			'menu',
			'modal_title',
			'modal_body',
			'modal_route',
			'modal_id',
			'model'
			);
	}


	/**
	 * Get all models.
	 *
	 * @return Illuminate\Support\Collection
	 */
	public function store($input)
	{
//dd($input);

		$values = [
			'name'			=> $input['name'],
			'class'			=> $input['class']
		];

		$menu = Menu::create($values);

		$locales = Cache::get('languages');
//dd($locales);
		$original_locale = Session::get('locale');

		foreach($locales as $locale => $properties)
		{
			App::setLocale($properties->locale);

			if ( !isset($input['status_' . $properties->id]) ) {
				$status = 0;
			} else {
				$status = $input['status_' . $properties->id];
			}

			$values = [
				'status'	=> $status,
				'title'		=> $input['title_' . $properties->id]
			];

			$menu->update($values);
		}

		App::setLocale($original_locale);
//		App::setLocale('en');
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

		$menu = Menu::find($id);

		$values = [
			'status'		=> $input['status'],
			'name'			=> $input['name'],
			'class'			=> $input['class']
		];

		$menu->update($values);

		$locales = Cache::get('languages');
		$original_locale = Session::get('locale');

		foreach($locales as $locale)
		{
			App::setLocale($locale->locale);

			$values = [
//				'status'	=> $input['status_' . $locale->id],
				'title'		=> $input['title_' . $locale->id]
			];

			$menu->update($values);
		}

		App::setLocale($original_locale);
		return;
	}


}
