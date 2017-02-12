<?php

namespace App\Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;

use App\Modules\Core\Http\Models\Locale;

use DB;
use Cache;
use View;

class ViewComposerServiceProvider extends ServiceProvider
{


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function boot()
    {
        /*$languages = $this->getLocales();
        View::share('languages', $languages);*/

        $settings = $this->getSettings();
        View::share('settings', $settings);
    }


    public function register()
    {
        //
    }


    public function getLocales()
    {
        $languages = Cache::get('languages');
//dd($languages);

        if ($languages == null) {
//dd('languages');
            $languages = Cache::rememberForever('languages', function () {
                return DB::table('locales')
                    ->where('active', '=', 1)
                    ->get();
            });
        }
//dd($languages);

        return $languages;

    }


    public function getSettings()
    {
        $settings = Cache::get('settings');
//dd($settings);

        if ($settings == null) {
//dd('settings');
            $settings = Cache::rememberForever('settings', function () {
                return DB::table('settings')
                    ->get();
            });
        }
//dd($settings);

        return $settings;

    }


}
