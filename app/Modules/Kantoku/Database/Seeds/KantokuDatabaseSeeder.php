<?php
namespace App\Modules\Kantoku\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class KantokuDatabaseSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('App\Modules\Kantoku\Database\Seeds\ModuleLinksSeeder');
        $this->call('App\Modules\Kantoku\Database\Seeds\ModulePermissionsSeeder');

    }


}
