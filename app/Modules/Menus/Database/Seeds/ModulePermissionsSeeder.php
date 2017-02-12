<?php

namespace App\Modules\Menus\Database\Seeds;

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
				'name'				=> 'Manage Menus',
				'slug'				=> 'manage_menus',
				'description'		=> 'Give permission to user to manage Menus Items'
			],
		 );

		if (Schema::hasTable('permissions'))
		{
			DB::table('permissions')->insert( $permissions );
		}

	} // run


}
