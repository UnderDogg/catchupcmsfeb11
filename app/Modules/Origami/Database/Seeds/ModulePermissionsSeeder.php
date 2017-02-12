<?php

namespace App\Modules\Origami\Database\Seeds;

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
				'name'				=> 'Manage Themes',
				'slug'				=> 'manage_origami',
				'description'		=> 'Give permission to user to access the Theme Management area.'
			],
		 );

		if (Schema::hasTable('permissions'))
		{
			DB::table('permissions')->insert( $permissions );
		}

	} // run


}
