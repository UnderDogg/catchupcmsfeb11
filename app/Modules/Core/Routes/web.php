<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => ''], function () {


    Route::get('/', array(
        'uses' => 'CoreController@welcome'
    ));



    Route::get('welcome', [
        'uses' => 'CoreController@welcome'
    ]);
    Route::get('/sites', array(
        'uses' => 'SitesPublicController@index'
    ));
    Route::get('sites/{id}', array(
        'uses' => 'SitesPublicController@show'
    ));
});




/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin'], function () {

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
});
