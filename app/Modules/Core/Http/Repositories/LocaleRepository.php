<?php

namespace App\Modules\Core\Http\Repositories;

use App\Modules\Core\Http\Models\Locale;

//use Illuminate\Support\Collection;

//use App;
use DB;
use Session;

class LocaleRepository extends BaseRepository
{


    /**
     * The Module instance.
     *
     * @var App\Modules\ModuleManager\Http\Models\Module
     */
    protected $locale;


    /**
     * Create a new ModuleRepository instance.
     *
     * @param  App\Modules\ModuleManager\Http\Models\Module $module
     * @return void
     */
    public function __construct(
        Locale $locale
    )
    {
        $this->model = $locale;
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
     * @param  string $slug
     * @return Illuminate\Support\Collection
     */
    public function show($id)
    {
        $locale = $this->model->find($id);
//dd($module);

        return compact('locale');
    }


    /**
     * Get user collection.
     *
     * @param  int $id
     * @return Illuminate\Support\Collection
     */
    public function edit($id)
    {
        $locale = $this->model->find($id);
//dd($locale);

        return compact('locale');
    }


    /**
     * Get all models.
     *
     * @return Illuminate\Support\Collection
     */
    public function store($input)
    {
//dd($input);

        if (!isset($input['active'])) {
            $input['active'] = 0;
        }
        if (!isset($input['default'])) {
            $input['default'] = 0;
        }

        $this->model = new Locale;
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

        if (!isset($input['active'])) {
            $input['active'] = 0;
        }
        if (!isset($input['default'])) {
            $input['default'] = 0;
        }

        $locale = Locale::find($id);
        $locale->update($input);
    }


    public function getLocaleID($lang)
    {

        $locale_id = DB::table('locales')
            ->where('locale', '=', $lang)
            ->pluck('id');

        return $locale_id;
    }


}
