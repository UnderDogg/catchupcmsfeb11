<?php

namespace App\Modules\Core\Database\Seeds;

use Illuminate\Database\Seeder;

Use DB;
use Schema;


class SitesSeeder extends Seeder
{


	public function run()
	{

		DB::table('sites')->delete();
			$statement = "ALTER TABLE sites AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

		$csv = dirname(__FILE__) . '/data/' . 'bam/sites.csv';
		$file_handle = fopen($csv, "r");

		while (!feof($file_handle)) {

			$line = fgetcsv($file_handle);
			if (empty($line)) {
				continue; // skip blank lines
			}

/*
id	user_id	lea_id	slug	name	asset_management_name	email	phone_1	phone_2	website	address	city	state	zipcode	logo	image_id	bld_number	status_id	theme_slug	notes	google_analytics	deleted_at	created_at	updated_at

0 ... id
1 ... user_id
2 ... lea_id
3 ... slug
4 ... name
5 ... asset_management_name
6 ... email
7 ... phone_1
8 ... phone_2
9 ... website
10 ... address
11 ... city
12 ... state
13 ... zipcode
14 ... logo
15 ... image_id
16 ... bld_number
17 ... status_id
18 ... theme_slug
19 ... notes
20 ... google_analytics
21 ... deleted_at
22 ... created_at
23 ... updated_at
*/

			$c = array();

//			$c['id']						= $line[0];
			$c['user_id']					= $line[1];
			$c['lea_id']					= $line[2];
			$c['slug']						= $line[3];
			$c['name']						= $line[4];
			$c['asset_management_name']		= $line[5];
			$c['email']						= $line[6];
			$c['phone_1']					= $line[7];
			$c['phone_2']					= $line[8];
			$c['website']					= $line[9];
			$c['address']					= $line[10];
			$c['city']						= $line[11];
			$c['state']						= $line[12];
			$c['zipcode']					= $line[13];
			$c['logo']						= $line[14];
			$c['image_id']					= $line[15];
			$c['bld_number']				= $line[16];
			$c['status_id']					= $line[17];
			$c['theme_slug']				= $line[18];
			$c['notes']						= $line[19];
			$c['google_analytics']			= $line[20];
			$c['deleted_at']				= $line[21];
			$c['created_at']				= $line[22];
			$c['updated_at']				= $line[23];


			DB::table('sites')->insert($c);

echo 'insert ' . $line[4];
echo PHP_EOL;

		}

		fclose($file_handle);

	}


}
