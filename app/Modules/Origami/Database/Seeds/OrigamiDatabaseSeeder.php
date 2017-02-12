<?php
namespace App\Modules\Origami\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class OrigamiDatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('App\Modules\Origami\Database\Seeds\ModulePermissionsSeeder');
		$this->call('App\Modules\Origami\Database\Seeds\ModuleLinksSeeder');

	}

}
