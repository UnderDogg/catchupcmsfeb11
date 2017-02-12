<?php

/*
|--------------------------------------------------------------------------
| Menus
|--------------------------------------------------------------------------
*/


// Resources
// Controllers


Route::group(['prefix' => 'menus'], function() {
	Route::get('welcome', [
		'uses'=>'MenuController@welcome'
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

	Route::resource('menus', 'MenusController');
	Route::resource('menulinks', 'MenuLinksController');

// Controllers

	Route::get('menulinks/create/{id}', array(
		'uses'=>'MenuLinksController@create'
		));

// API DATA

});
// --------------------------------------------------------------------------
