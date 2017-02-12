<?php

namespace App\Modules\Core\Http\Repositories;

use App\Modules\Core\Http\Repositories\BaseRepository;
use App\Modules\Core\Http\Models\Site;

use Illuminate\Support\Collection;
use Config;
use DB;
use Image;
use Input;
use Lang;
use Request;


class SiteRepository extends BaseRepository
{


    /**
     * The Module instance.
     *
     * @var App\Modules\ModuleManager\Http\Models\Module
     */
    protected $site;


    /**
     * Create a new ModuleRepository instance.
     *
     * @param  App\Modules\ModuleManager\Http\Models\Module $module
     * @return void
     */
    public function __construct(
        Site $site
    )
    {
        $this->model = $site;
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
     * @param  string $slug
     * @return Illuminate\Support\Collection
     */
    public function show($id)
    {
        $site = $this->model->find($id);
//		$site = $this->model->with('employees')->find($id);
//		$site = $this->model->with('users')->find($id);
//dd($site);

        if ($site->logo != NULL) {
            $logo = $site->logo;
        } else {
            $logo = null;
        }

//dd($site->division_id);
//		$division = $site->present()->divisionName($site->division_id);
        $contact = $site->present()->contactName($site->user_id);

        return compact(
            'contact',
//			'division',
            'logo',
            'site'
        );
    }


    /**
     * Get user collection.
     *
     * @param  int $id
     * @return Illuminate\Support\Collection
     */
    public function edit($id)
    {
// 		$site = $this->model->find($id);
// 		return compact(
// 			'site'
// 		);
    }


    /**
     * Get all models.
     *
     * @return Illuminate\Support\Collection
     */
    public function store($input, $file, $show_path)
    {
//dd($input);

        $this->model = new Site;

        if ($file != NULL) {
            $input['logo'] = $show_path . $file;
        }
//			$input['division_id'] = null;
        $input['logo'] = null;

        $this->model->create($input);
    }


    /**
     * Update a role.
     *
     * @param  array $inputs
     * @param  int $id
     * @return void
     */
    public function update($input, $id)
    {
//dd($input);


        if ($input['image_id'] == null) {

            $input['image_id'] = Config::get('core.default_image_id');

            if (isset($input['previous_image_id'])) {
                $input['image_id'] = $input['previous_image_id'];
            }
        }

        $site = Site::find($id);
        $site->update($input);
    }


// Functions --------------------------------------------------


// list

    public function getSiteList()
    {
        $sites = DB::table('sites')->lists('name', 'id');
        return $sites;
    }


// get

    public function getSites()
    {
        $sites = DB::table('sites')
            ->where('status_id', '=', 1)
            ->get();

        return $sites;
    }

    public function getSite($barcode)
    {
        $site = DB::table('sites')
            ->where('barcode', '=', $barcode)
            ->get();

        return $site;
    }


    public function getRooms($site_id)
    {
        $rooms = DB::table('rooms')
            ->where('rooms.site_id', '=', $site_id)
            ->leftJoin('profiles', 'profiles.id', '=', 'rooms.user_id')
            ->get();
//dd($rooms);
        return $rooms;
    }


    public function getAssets($site_id)
    {
        $assets = DB::table('assets')
            ->where('assets.site_id', '=', $site_id)
            ->leftJoin('items', 'items.id', '=', 'assets.item_id')
            ->leftJoin('rooms', 'rooms.id', '=', 'assets.room_id')
            ->leftJoin('profiles', 'profiles.id', '=', 'assets.user_id')
            ->get();
//dd($assets);
        return $assets;
    }


    public function getEmployees($site_id)
    {
        $employees = DB::table('employees')
            ->where('site_id', '=', $site_id)
            ->get();

        return $employees;
    }


    public function getContacts()
    {
        $contacts = DB::table('users')->lists('name', 'id');
//		$contacts = DB::table('profiles')->lists('email', 'user_id');
//		$contacts = DB::table('profiles')->lists('first_name' . '&nbsp;' . 'last_name', 'user_id');
// 		if ( empty($contacts) ) {
// 			$contacts = DB::table('users')->lists('email', 'id');
// 		}
        return $contacts;
    }

// 	public function getDivisions()
// 	{
// 		$divisions = DB::table('divisions')->lists('name', 'id');
// 		return $divisions;
// 	}

    /*
        public function getContactUser($id)
        {
            $user = DB::table('profiles')
                ->where('user_id', '=', $id)
                ->first();
            return $user;
        }
    */

    public function getImages()
    {
        $images = DB::table('images')->get();
        return $images;
    }


}
