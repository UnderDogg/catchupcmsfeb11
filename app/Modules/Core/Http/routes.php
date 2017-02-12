<?php

/*
|--------------------------------------------------------------------------
| Core
|--------------------------------------------------------------------------
*/

// Resources
// Controllers

Route::group(['prefix' => 'core'], function() {
	Route::get('welcome', [
		'uses'=>'CoreController@welcome'
	]);
});

Route::get('/', array(
	'uses'=>'CoreController@index'
	));


Route::get('/sites', array(
	'uses'=>'SitesPublicController@index'
	));
Route::get('sites/{id}', array(
	'uses'=>'SitesPublicController@show'
	));

// API DATA

	Route::get('api/sites_public', array(
	//	'as'=>'api.sites',
		'uses'=>'SitesPublicController@data'
		));


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin'], function() {

	Route::pattern('key', '[0-9a-z]+');


	Route::get('/', array(
		'uses'=>'DashboardController@index'
		));

	Route::get('/dashboard', array(
		'uses'=>'DashboardController@index'
		));

// Resources

	Route::resource('locales', 'LocalesController');
	Route::resource('settings', 'SettingsController');
	Route::resource('sites', 'SitesController');
	Route::resource('statuses', 'StatusesController');
	Route::resource('user_preferences', 'UserPreferenceController');

	Route::get('settings/{key}', array(
		'uses'=>'SettingsController@edit'
		));
	Route::post('settings/{key}', array(
		'uses'=>'SettingsController@update'
		));

// Controllers
// API DATA

	Route::get('api/sites', array(
	//	'as'=>'api.sites',
		'uses'=>'SitesController@data'
		));

});
// --------------------------------------------------------------------------
