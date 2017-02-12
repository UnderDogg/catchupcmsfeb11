<?php

namespace App\Modules\Kagi\Database\Seeds;

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
				'name'				=> 'Manage Admin',
				'slug'				=> 'manage_admin',
				'description'		=> 'Give permission to user to access the admin area.'
			],
			[
				'name'				=> 'Manage Users',
				'slug'				=> 'manage_kagi',
				'description'		=> 'Give permission to user to Manage Users.'
			],
			[
				'name'				=> 'Manage Own Data',
				'slug'				=> 'manage_own',
				'description'		=> 'Allow users to manage their own data.'
			],
		 );

		if (Schema::hasTable('permissions'))
		{
			DB::table('permissions')->insert( $permissions );
		}

	} // run


}
