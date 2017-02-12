<?php

namespace App\Modules\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CoreDatabaseSeeder extends Seeder
{


	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

// 		$this->call('App\Modules\Core\Database\Seeds\LocaleTableSeeder');
// 		$this->call('App\Modules\Core\Database\Seeds\ModulePermissionsSeeder');
// 		$this->call('App\Modules\Core\Database\Seeds\ModuleLinksSeeder');
// 		$this->call('App\Modules\Core\Database\Seeds\SettingsTableSeeder');
// 		$this->call('App\Modules\Core\Database\Seeds\StatusesSeeder');
		$this->call('App\Modules\Core\Database\Seeds\PreferencesTableSeeder');

	}


}
