<?php

namespace App\Modules\Profiles\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class ProfilesDatabaseSeeder extends Seeder
{


	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

// 		$this->call('App\Modules\Profiles\Database\Seeds\ModulePermissionsSeeder');
// 		$this->call('App\Modules\Profiles\Database\Seeds\ModuleLinksSeeder');
// 		$this->call('App\Modules\Profiles\Database\Seeds\ProfilesTableSeeder');

		$this->call('App\Modules\Profiles\Database\Seeds\ProfilesSeeder');

	}


}
