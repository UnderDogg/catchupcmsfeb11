<?php

namespace App\Modules\Profiles\Database\Seeds;

use Illuminate\Database\Seeder;

use DB;
use Schema;


class ProfilesTableSeeder extends Seeder
{


	public function run()
	{

// Create Profiles
		DB::table('profiles')->delete();
			$statement = "ALTER TABLE profiles AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

		$users = DB::table('users')->get();

		foreach ($users as $user)
		{

			$profiles = array(
				'user_id'				=> $user->id,
				'first_name'			=> $user->name,
				'email_1'				=> $user->email
			);

			DB::table('profiles')->insert( $profiles );

		}

	} // run


}
