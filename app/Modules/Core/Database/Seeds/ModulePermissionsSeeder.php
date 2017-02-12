<?php

namespace App\Modules\Core\Database\Seeds;

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
				'name'				=> 'Manage Core',
				'slug'				=> 'manage_core',
				'description'		=> 'Give permission to user to manage Core Items'
			],
		 );

		if (Schema::hasTable('permissions'))
		{
			DB::table('permissions')->insert( $permissions );
		}

	} // run


}
