<?php

namespace App\Modules\Kantoku\Database\Seeds;

use Illuminate\Database\Seeder;
Use DB;
use Schema;


class ModulePermissionsSeeder extends Seeder
{


	public function run()
	{

// Permissions -------------------------------------------------------------
		$permissions = array(
			[
				'name'				=> 'Manage Modules',
				'slug'				=> 'manage_kantoku',
				'description'		=> 'Give permission to user to access the Module Management area.'
			],
		 );

		if (Schema::hasTable('permissions'))
		{
			DB::table('permissions')->insert( $permissions );
		}


	} // run


}
