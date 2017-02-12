<?php

/*
|--------------------------------------------------------------------------
| Profiles
|--------------------------------------------------------------------------
*/


// Controllers


Route::group(['prefix' => 'profiles'], function() {
	Route::get('welcome', [
		'uses'=>'ProfileController@welcome'
	]);
});


// Resources

Route::resource('profiles', 'ProfilesController');

Route::delete('profiles/{id}', array(
	'as'=>'profiles.destroy',
	'uses'=>'ProfilesController@destroy'
	));


// API DATA
Route::get('api/profiles', array(
//	'as'=>'api.profiles',
	'uses'=>'ProfilesController@data'
	));


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin'], function() {

// Resources
// Controllers
// API DATA

});
// --------------------------------------------------------------------------
