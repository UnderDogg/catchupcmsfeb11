<?php

namespace App\Modules\Kagi\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class KagiDatabaseSeeder extends Seeder
{


	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

// 		$this->call('App\Modules\Kagi\Database\Seeds\ModuleLinksSeeder');
// 		$this->call('App\Modules\Kagi\Database\Seeds\ModulePermissionsSeeder');
//
// 		$this->call('App\Modules\Kagi\Database\Seeds\UsersTableSeeder'); // broken
// 		$this->call('App\Modules\Kagi\Database\Seeds\UsersMainSeeder'); // admin only
// 		$this->call('App\Modules\Kagi\Database\Seeds\UsersSeeder'); // csv

		$this->call('App\Modules\Kagi\Database\Seeds\UsersExcel'); // csv

	}


}
