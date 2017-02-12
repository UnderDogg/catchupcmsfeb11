<?php


/*
|--------------------------------------------------------------------------
| Origami
|--------------------------------------------------------------------------
*/


// Resources
// Controllers


Route::group(['prefix' => 'origami'], function() {
	Route::get('welcome', [
		'uses'=>'OrigamiController@welcome'
	]);
});


// API DATA


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin'], function() {

// Resources
// Controllers

	Route::get('themes/', array(
//		'as'=>'themes.edit',
		'uses'=>'ThemesController@index'
		));
	Route::get('themes/{slug}', array(
//		'as'=>'themes/{slug}',
		'uses'=>'ThemesController@edit'
		));
	Route::post('themes/{slug}', array(
		'as'=>'themes.update',
		'uses'=>'ThemesController@update'
		));

// API DATA

});
// --------------------------------------------------------------------------
