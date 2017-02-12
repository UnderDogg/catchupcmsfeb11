<?php

return [

//vendor:publish --provider="App\Modules\ModuleManager\Providers\ModuleManagerServiceProvider" --tag="config"

/*
|--------------------------------------------------------------------------
| db settings
|--------------------------------------------------------------------------
*/
'profiles_db' => array(
	'prefix'					=> '',
),

'auth_fail_redirect'			=> '/admin/dashboard',

];
