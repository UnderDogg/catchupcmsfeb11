<?php

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
/*
Route::pattern('comment', '[0-9]+');
Route::pattern('post', '[0-9]+');
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');
*/

// set pattern for overall
Route::pattern('id', '[0-9]+');
Route::pattern('lang', '[0-9a-z]+');


/*
|--------------------------------------------------------------------------
| Main
|--------------------------------------------------------------------------
*/

// Controllers

 Route::get('/welcome', function () {
     return Theme::view('bootstrap::modules.core.landing');
 });

Route::group(['prefix' => 'core', 'namespace', 'App\Modules\Core\Http\Controllers'], function () {

    Route::get('/', array(
        'uses' => 'CoreController@index'
    ));

    Route::get('welcome', [
        'uses' => 'CoreController@welcome'
    ]);

});




Route::get('/sites', array(
    'uses' => 'SitesPublicController@index'
));
Route::get('sites/{id}', array(
    'uses' => 'SitesPublicController@show'
));

// API DATA

Route::get('api/sites_public', array(
    //	'as'=>'api.sites',
    'uses' => 'SitesPublicController@data'
));



Route::get('/language/{lang}', 'LanguageController@language');

// Resources

// API DATA


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin'], function () {

    Route::pattern('id', '[0-9]+');

// Resources
// Controllers
// API DATA

});


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'namespace' => 'App\Modules\Core\Http\Controllers'], function () {

    Route::pattern('key', '[0-9a-z]+');


    Route::get('/', array(
        'uses' => 'DashboardController@index'
    ));

    Route::get('/dashboard', array(
        'uses' => 'DashboardController@index'
    ));

// Resources

    Route::resource('locales', 'LocalesController');
    Route::resource('settings', 'SettingsController');
    Route::resource('sites', 'SitesController');
    Route::resource('statuses', 'StatusesController');
    Route::resource('user_preferences', 'UserPreferenceController');

    Route::get('settings/{key}', array(
        'uses' => 'SettingsController@edit'
    ));
    Route::post('settings/{key}', array(
        'uses' => 'SettingsController@update'
    ));

// Controllers
// API DATA

    Route::get('api/sites', array(
        //	'as'=>'api.sites',
        'uses' => 'SitesController@data'
    ));

});


// --------------------------------------------------------------------------
