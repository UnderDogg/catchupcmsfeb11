<?php

namespace App\Modules\Menus\Http\Repositories;

//use App\Modules\Menus\Http\Models\Locale;
use App\Modules\Menus\Http\Models\Menu;
use App\Modules\Menus\Http\Models\Menulink;

use Illuminate\Support\Collection;

use App;
use Cache;
use Config;
use DB;
use Session;
use Lang;


class MenuLinkRepository extends BaseRepository {


	/**
	 * The Module instance.
	 *
	 * @var App\Modules\ModuleManager\Http\Models\Module
	 */
	protected $menulink;


	/**
	 * Create a new ModuleRepository instance.
	 *
   	 * @param  App\Modules\ModuleManager\Http\Models\Module $module
	 * @return void
	 */
	public function __construct(
		Menu $menu,
		Menulink $menulink
		)
	{
		$this->menu = $menu;
		$this->menulink = $menulink;
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
//		$menu = $this->menulink->find($id);
//		$links = Menulink::all();
		$links = $this->menulink->where('menu_id', '=', $id)->get();
//		$links = Menulink::has('menu')->get();
		$lang = Session::get('locale');

		$create_id = $id;

		return compact(
			'create_id',
			'lang',
			'links'
			);
	}


	/**
	 * Get user collection.
	 *
	 * @param  int  $id
	 * @return Illuminate\Support\Collection
	 */
	public function edit($id)
	{
		$link = $this->menulink->find($id);
		$lang = Session::get('locale');

		return compact(
			'lang',
			'link'
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
// 		$this->menulink = new Menulink;
// 		$this->menulink->create($input);

		$menu = Menu::find($input['menu_id']);
//		Cache::forget('widget_' . $menu->name);

		$values = [
			'class'			=> $input['class'],
			'menu_id'		=> $input['menu_id'],
			'position'		=> $input['position']
		];
		$menulink = Menulink::create($values);

		$locales = Cache::get('languages');
		$original_locale = Session::get('locale');
//dd($original_locale);

		foreach($locales as $locale => $properties)
		{

			App::setLocale($properties->locale);

			if ( isset($input['status_'.$properties->id]) ) {
				$status = $input['status_'.$properties->id];
			} else {
				$status = 0;
			}

			$values = [
				'status'	=> $status,
				'title'		=> $input['title_'.$properties->id],
				'url'		=> $input['url_'.$properties->id]
			];
			$menulink->update($values);

			if ($properties->locale === Config::get('app.fallback_locale') ) {
				$menu_values = [
					'status_id'		=> $status
				];
				$menulink->update($menu_values);
			}

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

		$menu = Menu::find($input['menu_id']);
//		Cache::forget('widget_' . $menu->name);

		$menulink = Menulink::find($id);
		$values = [
			'class'			=> $input['class'],
			'menu_id'		=> $input['menu_id'],
			'position'		=> $input['position']
		];
		$menulink->update($values);

		$locales = Cache::get('languages');
		$original_locale = Session::get('locale');

		foreach($locales as $locale => $properties)
		{

			App::setLocale($properties->locale);

			if ( isset($input['status_'.$properties->id]) ) {
				$status = $input['status_'.$properties->id];
			} else {
				$status = 0;
			}

			$values = [
				'status'	=> $status,
				'title'		=> $input['title_'.$properties->id],
				'url'		=> $input['url_'.$properties->id]
			];
			$menulink->update($values);

			if ($properties->locale === Config::get('app.fallback_locale') ) {
				$menu_values = [
					'status_id'		=> $status
				];
				$menulink->update($menu_values);
			}

		}

		App::setLocale($original_locale, Config::get('app.fallback_locale'));
		return;
	}


// Functions --------------------------------------------------

// 	public function getMenus()
// 	{
// 		$sites = DB::table('menus')->lists('name', 'id');
// 		return $sites;
// 	}


	public function changeParentById($data)
	{
		foreach($data as $k => $v)
		{
			$item = $this->find($v['id']);
			$item->parent_id = $v['parentID'];
			$item->position = $k + 1;
			$item->save();
		}
	}


	public function generateMenu($menu, $parentId = 0) {
		$result = null;
		foreach ($menu as $item)
		{
			if ($item->parent_id == $parentId) {

				$imageName = ($item->is_published) ? "publish_16x16.png" : "not_publish_16x16.png";

				$result .= '
				<li class="dd-item" data-id="' . $item->id . '">
				<button type="button" data-action="collapse">Collapse</button>
				<button type="button" data-action="expand" style="display: none;">Expand</button>
				<div class="dd-handle"></div>
					<div class="dd-content">
						<span>' . $item->title . '</span>
						<div class="ns-actions">
							<a title="Publish Menu" id="' . $item->id . '" class="publish" href="#">
								<img id="publish-image-' . $item->id . '" alt="Publish" src="/assets/images/' . $imageName . '">
							</a>
							<a title="Edit Menu" class="edit-menu" href="admin.menu.edit/' . $item->id . '">
								<img alt="Edit" src="/assets/images/edit.png">
							</a>
							<a class="delete-menu" href="admin.menu.delete/' . $item->id . '">
								<img alt="Delete" src="/assets/images/cross.png">
							</a>
							<input type="hidden" value="1" name="menu_id">
						</div>
				</div>
				' . $this->generateMenu($menu, $item->id) . '</li>';
			}
		}

		return $result ? "\n<ol class=\"dd-list\">\n$result</ol>\n" : null;
	}


	public function getMenuHTML($items)
	{
		return $this->generateMenu($items);
	}


	public function parseJsonArray($jsonArray, $parentID = 0)
	{
//dd($jsonArray);

		$return = array();
		foreach ($jsonArray as $subArray)
		{
dd($subArray);
			$returnSubArray = array();
			if (isset($subArray['children'])) {
				$returnSubArray = $this->parseJsonArray($subArray['children'], $subArray['id']);
			}

			$return[] = array('id' => $subArray['id'], 'parentID' => $parentID);
			$return = array_merge($return, $returnSubArray);
		}

		return $return;
	}



	// Recursive function that builds the menu from an array or object of items
	// In a perfect world some parts of this function would be in a custom Macro or a View
	public function buildMenu($items, $locale, $parentid = 0)
	{
//dd($items);

		$result = null;

		foreach ($items as $item)
		{
//			if ($item->parent_id == $parentid) {

		$result .= '<li>' . $item->{'title:'.$locale};
		$result .= '<a href="' . $item->url . '">' . $item->{'title:'.$locale} . '</a>';
//		" . $this->buildMenu($items, $item->id)
		$result .= '</li>';

//			}
		}
//dd($result);

			return $result ?  $result : null;
	}

	// Getter for the HTML menu builder
	public function getHTML($items, $locale)
	{
		return $this->buildMenu($items, $locale);
	}


	public function getLinks($menu_id, $locale)
	{
		$query = $this->menulink
//		->with('translations')
		->join('menulink_translations', 'menulinks.id', '=', 'menulink_translations.menulink_id')
		->where('menulinks.menu_id', '=', $menu_id)
		->where('menulink_translations.status', '=', 1, 'AND')
		->where('menulink_translations.locale', '=', $locale)
		->orderBy('menulinks.position');
//dd($query);
//		$query->where('status', 1);
//dd($query);

		$models = $query->get();
//dd($models);

		return $models;
	}


}
