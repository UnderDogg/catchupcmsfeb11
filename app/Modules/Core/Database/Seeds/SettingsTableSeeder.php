<?php

namespace App\Modules\Core\Database\Seeds;

use Illuminate\Database\Seeder;

use DB;
use Schema;

class SettingsTableSeeder extends Seeder
{


	public function run()
	{
// Uncomment the below to wipe the table clean before populating

		DB::table('settings')->delete();
			$statement = "ALTER TABLE settings AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

		$csv = dirname(__FILE__) . '/Data/' . 'settings.csv';
		$file_handle = fopen($csv, "r");

		while (!feof($file_handle)) {

			$line = fgetcsv($file_handle);
			if (empty($line)) {
				continue; // skip blank lines
			}

			$c = array();
			$c['key']			= $line[0];
			$c['value']			= $line[1];

			DB::table('settings')->insert($c);

		}

		fclose($file_handle);

// Uncomment the below to run the seeder
//		DB::table('locales')->insert($seeds);
	}


}
