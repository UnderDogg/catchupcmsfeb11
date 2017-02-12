<?php

namespace App\Modules\Core\Database\Seeds;

use Illuminate\Database\Seeder;
Use DB, Eloquent, Model, Schema;

class StatusesSeeder extends Seeder
{


	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
//		DB::table('statuses')->truncate();

		$locale_id = DB::table('locales')
			->where('name', '=', 'English')
			->where('locale', '=', 'en', 'AND')
			->pluck('id');

		$statuses = array(
		[
			'id'					=> 1
		],
		[
			'id'					=> 2
		]
		);
		$status_translations = array(
		[
			'name'					=> 'Enabled',
			'description'			=> 'Set to On',
			'status_id'				=> 1,
			'locale_id'				=> $locale_id
		],
		[
			'name'					=> 'Disabled',
			'description'			=> 'Set to Off',
			'status_id'				=> 2,
			'locale_id'				=> $locale_id
		]
		);

		// Uncomment the below to run the seeder
//		DB::table('statuses')->insert($seeds);

// Create Menus
		DB::table('statuses')->delete();
			$statement = "ALTER TABLE statuses AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

// Create Menu Translations
		DB::table('status_translations')->delete();
			$statement = "ALTER TABLE status_translations AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

// Insert Data
		DB::table('statuses')->insert( $statuses );
		DB::table('status_translations')->insert( $status_translations );

	} // run


}
