<?php

namespace App\Modules\Kagi\Database\Seeds;

use Illuminate\Database\Seeder;

use Caffeinated\Shinobi\Models\Role as Role;
use App\Modules\Kagi\Http\Models\User as User;

use Config;
use DB;
use Hash;

class UsersSeeder extends Seeder
{

	public function __construct(
			User $user,
			Role $role
		)
	{
		$this->user = $user;
		$this->role = $role;
	}

	public function run()
	{


		$csv = dirname(__FILE__) . '/data/' . 'shorter.csv';
		$file_handle = fopen($csv, "r");

		while (!feof($file_handle)) {

			$line = fgetcsv($file_handle);
			if (empty($line)) {
				continue; // skip blank lines
			}

			$c = array();
			$c['id']				= $line[0];
			$c['name']				= $line[2];
			$c['email']				= $line[3];
			$c['password']			= Hash::make($line[3]);
//			$c['password']			= bcrypt($line[3]);
// 			$c['confirmed']			= 1;
// 			$c['activated']			= 1;

			DB::table('users')->insert($c);

			$d = array();
			$d['site_id']				= $line[6];
			$d['user_id']				= $line[0];
			DB::table('site_user')->insert($d);

			if ( $line[7] != null ) {
				$d = array();
				$d['site_id']				= $line[7];
				$d['user_id']				= $line[0];
				DB::table('site_user')->insert($d);
			}

			if ( $line[8] != null ) {
				$d = array();
				$d['site_id']				= $line[8];
				$d['user_id']				= $line[0];
				DB::table('site_user')->insert($d);
			}

			if ( $line[9] != null ) {
				$d = array();
				$d['site_id']				= $line[9];
				$d['user_id']				= $line[0];
				DB::table('site_user')->insert($d);
			}

			if ( $line[10] != null ) {
				$d = array();
				$d['site_id']				= $line[10];
				$d['user_id']				= $line[0];
				DB::table('site_user')->insert($d);
			}

			if ( $line[11] != null ) {
				$d = array();
				$d['site_id']				= $line[11];
				$d['user_id']				= $line[0];
				DB::table('site_user')->insert($d);
			}

			if ( $line[12] != null ) {
				$d = array();
				$d['site_id']				= $line[12];
				$d['user_id']				= $line[0];
				DB::table('site_user')->insert($d);
			}

			if ( $line[13] != null ) {
				$d = array();
				$d['site_id']				= $line[13];
				$d['user_id']				= $line[0];
				DB::table('site_user')->insert($d);
			}

			if ( $line[14] != null ) {
				$d = array();
				$d['site_id']				= $line[14];
				$d['user_id']				= $line[0];
				DB::table('site_user')->insert($d);
			}

			if ( $line[15] != null ) {
				$d = array();
				$d['site_id']				= $line[15];
				$d['user_id']				= $line[0];
				DB::table('site_user')->insert($d);
			}

			if ( $line[16] != null ) {
				$d = array();
				$d['site_id']				= $line[16];
				$d['user_id']				= $line[0];
				DB::table('site_user')->insert($d);
			}

			if ( $line[17] != null ) {
				$d = array();
				$d['site_id']				= $line[17];
				$d['user_id']				= $line[0];
				DB::table('site_user')->insert($d);
			}





// Attach role to user
		$user = User::find($line[0]);
		$user->roles()->attach(2);


		}

		fclose($file_handle);

	}

}
