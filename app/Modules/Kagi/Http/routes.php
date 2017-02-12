<?php

/*
|--------------------------------------------------------------------------
| Kagi
|--------------------------------------------------------------------------
*/

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
/*
Route::model('user', 'User');
Route::model('comment', 'Comment');
Route::model('post', 'Post');
Route::model('role', 'Role');
*/

// Resources

// Controllers

Route::group(['prefix' => 'kagi'], function() {
	Route::get('welcome', [
		'uses'=>'KagiController@welcome'
	]);
});

Route::get('login', 'Social\SocialAuthController@getLogin');


/*
|--------------------------------------------------------------------------
| /auth/
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'auth'], function() {

// Authentication
	Route::get('login', 'Auth\AuthController@getLogin');
	Route::post('login', 'Auth\AuthController@postLogin');
	Route::get('logout', 'Auth\AuthController@getLogout');

// Confirmation
	Route::get('confirm/{code}', 'Auth\AuthController@getConfirm');
	Route::post('confirm/{code}', 'Auth\AuthController@postConfirm');

// Registration
	Route::get('register', 'Auth\AuthController@getRegister');
	Route::post('register', 'Auth\AuthController@postRegister');

});

/*
|--------------------------------------------------------------------------
| /password/
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'password'], function() {

// Password reset link request routes...
	Route::get('email', 'Auth\PasswordController@getEmail');
	Route::post('email', 'Auth\PasswordController@postEmail');

// Password reset routes...
	Route::get('reset/{token}', 'Auth\PasswordController@getReset');
	Route::post('reset', 'Auth\PasswordController@postReset');

// Password reset link request
	Route::get('email', 'Auth\PasswordController@getEmail');
	Route::post('email', 'Auth\PasswordController@postEmail');

// Password reset
	Route::get('reset/{token}', 'Auth\PasswordController@getReset');
	Route::post('reset', 'Auth\PasswordController@postReset');

});

// Social
Route::get('social/login', 'Social\SocialAuthController@redirectToProvider');
Route::get('social/login/callback', 'Social\SocialAuthController@handleProviderCallback');

/*
Route::get('social/login', 'SocialAuthController@login');

Route::get('auth/github', 'Auth\AuthController@redirectToProvider');
Route::get('auth/github/callback', 'Auth\AuthController@handleProviderCallback');

Route::controllers([
	'password' => 'Auth\AuthController',
]);

*/

// API DATA

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin'], function() {

// Resources

# Users
	Route::resource('users', 'UsersController');
	Route::get('getDelete/{id}', 'UsersController@getDelete');
# Roles
	Route::resource('roles', 'RolesController');
# Permissions
	Route::resource('permissions', 'PermissionsController');

// Controllers
// API DATA
	Route::get('api/users', array(
	//	'as'=>'api.users',
		'uses'=>'UsersController@data'
		));
	Route::get('api/roles', array(
	//	'as'=>'api.roles',
		'uses'=>'RolesController@data'
		));
	Route::get('api/permissions', array(
	//	'as'=>'api.permissions',
		'uses'=>'PermissionsController@data'
		));

});
// --------------------------------------------------------------------------
