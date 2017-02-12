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


Route::group(['prefix' => '', 'namespace', 'App\Modules\Kagi\Http\Controllers'], function () {


Auth::routes();

});


/*
|--------------------------------------------------------------------------
| Main
|--------------------------------------------------------------------------
*/

// Controllers

 Route::get('/welcome', function () {
     return Theme::view('bootstrap::modules.core.landing');
 });



// Controllers
//'namespace', 'App\Modules\Core\Http\Controllers'
/*Route::group(['prefix' => 'kagi'], function () {
    Route::get('welcome', [
        'uses' => 'LanguageController@welcome'
    ]);
});*/

//Route::get('login', 'Social\SocialAuthController@getLogin');


/*
|--------------------------------------------------------------------------
| /auth/
|--------------------------------------------------------------------------
*/
/*Route::group(['prefix' => 'auth', 'namespace', 'App\Modules\Kagi\Http\Controllers'], function () {

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


// Social
    Route::get('social/login', 'Social\SocialAuthController@redirectToProvider');
    Route::get('social/login/callback', 'Social\SocialAuthController@handleProviderCallback');
});*/

/*
|--------------------------------------------------------------------------
| /password/
|--------------------------------------------------------------------------
*/
/*Route::group(['prefix' => 'password', 'namespace', 'App\Modules\Kagi\Http\Controllers\Auth'], function () {

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

});*/

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
Route::group(['prefix' => 'admin', 'namespace' => 'App\Modules\Kagi\Http\Controllers'], function () {

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
        'uses' => 'UsersController@data'
    ));
    Route::get('api/roles', array(
        //	'as'=>'api.roles',
        'uses' => 'RolesController@data'
    ));
    Route::get('api/permissions', array(
        //	'as'=>'api.permissions',
        'uses' => 'PermissionsController@data'
    ));

});




Route::group(['prefix' => 'core', 'namespace', 'App\Modules\Core\Http\Controllers'], function () {

    Route::get('/', array(
        'uses' => 'CoreController@index'
    ));

    Route::get('welcome', [
        'uses' => 'CoreController@welcome'
    ]);
});






Route::group(['prefix' => 'core', 'namespace', 'App\Modules\Core\Http\Controllers'], function () {

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

});


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

Route::group(['prefix' => 'kantoku'], function () {
    Route::get('welcome', [
        'uses' => 'KantokuController@welcome'
    ]);
});

// API DATA

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin'], function () {

// Resources
// Controllers

    Route::get('modules/', array(
//		'as'=>'modules.edit',
        'uses' => 'ModulesController@index'
    ));
    Route::get('modules/{slug}', array(
//		'as'=>'modules/{slug}',
        'uses' => 'ModulesController@edit'
    ));
    Route::post('modules/{slug}', array(
        'as' => 'modules.update',
        'uses' => 'ModulesController@update'
    ));

// API DATA

});

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


/*
|--------------------------------------------------------------------------
| Origami
|--------------------------------------------------------------------------
*/


// Resources
// Controllers


Route::group(['prefix' => 'origami'], function () {
    Route::get('welcome', [
        'uses' => 'OrigamiController@welcome'
    ]);
});


// API DATA


/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin'], function () {

// Resources
// Controllers

    Route::get('themes/', array(
//		'as'=>'themes.edit',
        'uses' => 'ThemesController@index'
    ));
    Route::get('themes/{slug}', array(
//		'as'=>'themes/{slug}',
        'uses' => 'ThemesController@edit'
    ));
    Route::post('themes/{slug}', array(
        'as' => 'themes.update',
        'uses' => 'ThemesController@update'
    ));

// API DATA

});
// --------------------------------------------------------------------------


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
