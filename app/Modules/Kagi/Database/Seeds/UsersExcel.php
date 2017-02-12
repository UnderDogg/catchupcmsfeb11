<?php

namespace App\Modules\Kagi\Database\Seeds;

use Illuminate\Database\Seeder;

use Caffeinated\Shinobi\Models\Role as Role;
use App\Modules\Kagi\Http\Models\User as User;
use App\Modules\Gakko\Http\Models\Grade;
use App\Modules\Gakko\Http\Repositories\GradeRepository;
use App\Modules\Jinji\Http\Models\Employee;
use App\Modules\Jinji\Http\Repositories\EmployeeRepository;

use Config;
use DB;
use Hash;


class UsersExcel extends Seeder
{

	public function __construct(
			User $user,
			Role $role,
			Grade $grade,
			GradeRepository $grade_repo,
			Employee $employee,
			EmployeeRepository $employee_repo
		)
	{
		$this->user = $user;
		$this->role = $role;
		$this->grade = $grade;
		$this->grade_repo = $grade_repo;
		$this->employee = $employee;
		$this->employee_repo = $employee_repo;
	}

	public function run()
	{

echo PHP_EOL;
echo '------------------------------------------ Start ------------------------------------------';
echo PHP_EOL;

// clear out all contents
		DB::table('content_translations')->delete();
			$statement = "ALTER TABLE content_translations AUTO_INCREMENT = 1;";
			DB::unprepared($statement);
		DB::table('contents')->delete();
			$statement = "ALTER TABLE contents AUTO_INCREMENT = 1;";
			DB::unprepared($statement);
		DB::table('content_site')->delete();
			$statement = "ALTER TABLE content_site AUTO_INCREMENT = 1;";
			DB::unprepared($statement);
		DB::table('content_image')->delete();
			$statement = "ALTER TABLE content_image AUTO_INCREMENT = 1;";
			DB::unprepared($statement);
		DB::table('content_document')->delete();
			$statement = "ALTER TABLE content_document AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

// clear out all news
		DB::table('news_translations')->delete();
			$statement = "ALTER TABLE news_translations AUTO_INCREMENT = 1;";
			DB::unprepared($statement);
		DB::table('news')->delete();
			$statement = "ALTER TABLE news AUTO_INCREMENT = 1;";
			DB::unprepared($statement);
		DB::table('news_site')->delete();
			$statement = "ALTER TABLE news_site AUTO_INCREMENT = 1;";
			DB::unprepared($statement);
		DB::table('image_news')->delete();
			$statement = "ALTER TABLE image_news AUTO_INCREMENT = 1;";
			DB::unprepared($statement);
		DB::table('document_news')->delete();
			$statement = "ALTER TABLE document_news AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

// clear out all seminars
		DB::table('seminar_translations')->delete();
			$statement = "ALTER TABLE seminar_translations AUTO_INCREMENT = 1;";
			DB::unprepared($statement);
		DB::table('seminars')->delete();
			$statement = "ALTER TABLE seminars AUTO_INCREMENT = 1;";
			DB::unprepared($statement);
		DB::table('seminars_users')->delete();
			$statement = "ALTER TABLE seminars_users AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

// clear out assets
		DB::table('assets')->delete();
			$statement = "ALTER TABLE assets AUTO_INCREMENT = 1;";
			DB::unprepared($statement);
		DB::table('tickets')->delete();
			$statement = "ALTER TABLE tickets AUTO_INCREMENT = 1;";
			DB::unprepared($statement);


// Delete users
		DB::table('users')->delete();
			$statement = "ALTER TABLE users AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

// delete role_user
		DB::table('role_user')->delete();
			$statement = "ALTER TABLE role_user AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

// delete profiles
		DB::table('profiles')->delete();
			$statement = "ALTER TABLE profiles AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

// delete employees
		DB::table('employees')->delete();
			$statement = "ALTER TABLE employees AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

// delete grade_user
		DB::table('grade_user')->delete();
			$statement = "ALTER TABLE grade_user AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

// delete subject_user
		DB::table('subject_user')->delete();
			$statement = "ALTER TABLE subject_user AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

// delete subjects
// 		DB::table('subjects')->delete();
// 			$statement = "ALTER TABLE subjects AUTO_INCREMENT = 1;";
// 			DB::unprepared($statement);
// 		DB::table('subject_translations')->delete();
// 			$statement = "ALTER TABLE subject_translations AUTO_INCREMENT = 1;";
// 			DB::unprepared($statement);


echo PHP_EOL;
echo '------------------------------------------ Truncate Tables ------------------------------------------';
echo PHP_EOL;

		$locale_id = DB::table('locales')
			->where('name', '=', 'English')
			->where('locale', '=', 'en', 'AND')
			->pluck('id');

		$csv = dirname(__FILE__) . '/data/' . 'employee_master.csv';

		$file_handle = fopen($csv, "r");

echo PHP_EOL;
echo '------------------------------------------ create admin user ------------------------------------------';
echo PHP_EOL;


		$admin = array(
			'name'					=> 'ADMIN',
			'email'					=> 'admin@admin.com',
			'password'				=> Hash::make('kagiadmin'),
			'activated_at'			=> date("Y-m-d H:i:s"),
			'created_at'			=> date("Y-m-d H:i:s"),
			'blocked'				=> 0,
			'banned'				=> 0,
			'confirmed'				=> 1,
			'activated'				=> 1,
			'confirmation_code'		=> md5(microtime().Config::get('app.key')),
			'avatar'				=> 'assets/images/usr.png'
		);

// Create Admin
		DB::table('users')->insert($admin);

// Attach role to admin
		$user = User::find(1);
		$user->roles()->attach(1);
		$user->roles()->attach(4);

// update profile for admin
		$admin_profile = array(
			'user_id'				=> 1,
			'first_name'			=> 'Admin',
			'last_name'				=> 'Admin',
			'email_1'				=> 'admin@admin.com'
		);

		DB::table('profiles')->insert( $admin_profile );


		$admin_employee = array(
			'user_id'							=> 1,
			'profile_id'						=> 1,
			'status_id'							=> 1
//			'communication_type_id'				=> 1
		);

		DB::table('employees')->insert( $admin_employee );

/*
id	first_name	last_name	email	employee_type_id	department_id	job_title_id	secondary_job_title_id	supervisor_id	isSupervisor	site_id	school_lea_Number	state_ID	phone_1	address	city	state	zipcode	grade	course_1	course_2	course_3	course_4

		$admin = array(
			'name'					=> 'admin',
			'email'					=> 'admin@admin.com',
			'password'				=> bcrypt('kagiadmin'),
			'activated_at'			=> date("Y-m-d H:i:s"),
			'created_at'			=> date("Y-m-d H:i:s"),
			'blocked'				=> 0,
			'banned'				=> 0,
			'confirmed'				=> 1,
			'activated'				=> 1,
			'confirmation_code'		=> md5(microtime().Config::get('app.key')),
			'avatar'				=> 'assets/images/usr.png'
		);
*/


/*
	0 ... id
	1 ... first_name
	2 ... last_name
	3 ... email

	4 ... employee_type_id
	5 ... department_id
	6 ... job_title_id
	7 ... secondary_job_title_id
	8 ... supervisor_id
	9 ... isSupervisor

	10 ... site_id
	11 ... school_lea_Number
	12 ... state_ID

	13 ... phone_1
	14 ... address
	15 ... city
	16 ... state
	17 ... zipcode

	18 ... grade
	19 ... course_1
	20 ... course_2
	21 ... course_3
	22 ... course_4
*/



echo PHP_EOL;
echo '------------------------------------------ open file ------------------------------------------';
echo PHP_EOL;


		$datasv = dirname(__FILE__) . '/data/' . 'employee_master.csv';
		$file_handle = fopen($datasv, "r");

		while (!feof($file_handle)) {

			$line = fgetcsv($file_handle);
			if (empty($line)) {
				continue; // skip blank lines
			} // if


// User Data
			$data = array();
			$data['id']							= $line[0];
			$data['name']						= $line[2];
			$data['email']						= $line[3];
			$data['password']					= Hash::make($line[3]);
			$data['activated_at']				= date("Y-m-d H:i:s");
			$data['created_at']					= date("Y-m-d H:i:s");
			$data['blocked']					= 0;
			$data['banned']						= 0;
			$data['confirmed']					= 1;
			$data['activated']					= 1;
			$data['confirmation_code']			= md5(microtime().Config::get('app.key'));

			DB::table('users')->insert($data);

// Attach role to user
			$user = User::find($line[0]);
			$user->roles()->attach(2);

echo 'users -- ' . $line[0];
echo PHP_EOL;


// update user profile
			$c = array();
			$c['id']				= $line[0];
			$c['user_id']			= $line[0];

			$c['first_name']		= $line[1];
			$c['last_name']			= $line[2];

			$c['email_1']			= $line[3];
			$c['phone_1']			= $line[13];
			$c['address']			= $line[14];
			$c['city']				= $line[15];
			$c['state']				= $line[16];
			$c['zipcode']			= $line[17];

			DB::table('profiles')->insert($c);

echo 'profiles -- ' . $line[0];
echo PHP_EOL;


/*
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`user_id` int(11) NOT NULL,
`profile_id` int(11) NOT NULL,
`employee_type_id` int(11) DEFAULT NULL,
`department_id` int(11) DEFAULT NULL,

		`position_id` int(11) DEFAULT NULL,
		`secondary_position_id` int(11) DEFAULT NULL,

`job_title_id` int(11) DEFAULT NULL,
`secondary_job_title_id` int(11) DEFAULT NULL,
`isTeacher` int(11) DEFAULT NULL,
`supervisor_id` int(11) DEFAULT NULL,
`isSupervisior` int(11) NOT NULL DEFAULT '0',
`status_id` int(11) NOT NULL DEFAULT '1',
`site_id` int(11) NOT NULL DEFAULT '1',
  `notes` text COLLATE utf8_unicode_ci,
		`deleted_at` timestamp NULL DEFAULT NULL,
		`created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
		`updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
`staff_id` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
`primary_grade_id` int(11) DEFAULT NULL,
`primary_site_id` int(11) DEFAULT NULL,
`primary_subject_id` int(11) DEFAULT NULL,
*/

// update employee info
			$c = array();
			$c['id']						= $line[0];
			$c['user_id']					= $line[0];
			$c['profile_id']				= $line[0];
			$c['employee_type_id']			= $line[4];
			$c['department_id']				= $line[5];
			$c['job_title_id']				= $line[6];
			$c['secondary_job_title_id']	= $line[7];
			$c['isSupervisior']				= $line[9];
			$c['supervisor_id']				= $line[8];

//			$c['site_number_id']			= $line[11];
			$c['staff_id']					= $line[12];

			$c['primary_grade_id']			= $line[18];
			$c['primary_subject_id']		= $line[19];

			$c['status_id']					= 1;

// grade / course check for teacher
			if ( $line[18] != '' || $line[19] != '' ) {
				$c['isTeacher']				= 1;
			} else {
				$c['isTeacher']				= 0;
			}

			$c['site_id']					= $line[10];
			$c['primary_site_id']			= $line[10];

			$site_ID = 4;
			if ( $line[10] != '' ) {

				if ( $line[10] == 1 ) {
					$site_ID = 2;
				}
				if ( $line[10] == 2 ) {
					$site_ID = 5;
				}
				if ( $line[10] == 3 ) {
					$site_ID = 20;
				}
				if ( $line[10] == 4 ) {
					$site_ID = 9;
				}
				if ( $line[10] == 5 ) {
					$site_ID = 10;
				}
				if ( $line[10] == 6 ) {
					$site_ID = 11;
				}
				if ( $line[10] == 7 ) {
					$site_ID = 12;
				}
				if ( $line[10] == 8 ) {
					$site_ID = 13;
				}
				if ( $line[10] == 11 ) {
					$site_ID = 3;
				}
				if ( $line[10] == 12 ) {
					$site_ID = 16;
				}
				if ( $line[10] == 13 ) {
					$site_ID = 17;
				}
				if ( $line[10] == 14 ) {
					$site_ID = 7;
				}
				if ( $line[10] == 15 ) {
					$site_ID = 21;
				}
				if ( $line[10] == 16 ) {
					$site_ID = 22;
				}
				if ( $line[10] == 17 ) {
					$site_ID = 23;
				}
				if ( $line[10] == 18 ) {
					$site_ID = 24;
				}

			}


			DB::table('employees')->insert($c);

echo 'employees -- ' . $line[0];
echo PHP_EOL;


// attach user to site
			$d = array();
			$d['site_id']				= $site_ID;
			$d['user_id']				= $line[0];
			DB::table('site_user')->insert($d);

echo 'site_user -- ' . $line[0];
echo PHP_EOL;


// attach user to grade
			if ( $line[18] != '' ) {
				$d = array();
				$d['grade_id']				= $line[18];
				$d['user_id']				= $line[0];
				DB::table('grade_user')->insert($d);
			}

echo 'grade_user -- ' . $line[0];
echo PHP_EOL;


// attach user to subject
			if ( $line[19] != '' ) {
				$d = array();
				$d['subject_id']			= $line[19];
				$d['user_id']				= $line[0];
				DB::table('subject_user')->insert($d);
			}
			if ( $line[20] != '' ) {
				$d = array();
				$d['subject_id']			= $line[20];
				$d['user_id']				= $line[0];
				DB::table('subject_user')->insert($d);
			}
			if ( $line[21] != '' ) {
				$d = array();
				$d['subject_id']			= $line[21];
				$d['user_id']				= $line[0];
				DB::table('subject_user')->insert($d);
			}
			if ( $line[22] != '' ) {
				$d = array();
				$d['subject_id']			= $line[22];
				$d['user_id']				= $line[0];
				DB::table('subject_user')->insert($d);
			}

echo 'subject_user -- ' . $line[0];
echo PHP_EOL;



		} // while

		fclose($file_handle);

echo PHP_EOL;
echo '------------------------------------------ close file ------------------------------------------';
echo PHP_EOL;


	} // run

}
