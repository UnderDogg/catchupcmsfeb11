<?php

namespace App\Modules\Core\Database\Seeds;

use Illuminate\Database\Seeder;

use DB;
use Schema;

class LocaleTableSeeder extends Seeder
{


	public function run()
	{
// Uncomment the below to wipe the table clean before populating

		DB::table('locales')->delete();
			$statement = "ALTER TABLE locales AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

		$csv = dirname(__FILE__) . '/Data/' . 'languages.csv';
		$file_handle = fopen($csv, "r");

$id = 1;
		while (!feof($file_handle)) {

			$line = fgetcsv($file_handle);
			if (empty($line)) {
				continue; // skip blank lines
			}

			$c = array();
			$c['id']			= $id;
			$c['locale']		= $line[0];
			$c['name']			= $line[1];
			$c['script']		= $line[2];
			$c['native']		= $line[3];
			$c['active']		= $line[4];
			$c['default']		= $line[5];

			DB::table('locales')->insert($c);

$id = $id + 1;

		}

		fclose($file_handle);

// Uncomment the below to run the seeder
//		DB::table('locales')->insert($seeds);
	}


}
