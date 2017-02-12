<?php

namespace App\Modules\Kagi\Database\Seeds;

use Illuminate\Database\Seeder;

use Caffeinated\Shinobi\Models\Role as Role;
use App\Modules\Kagi\Http\Models\User as User;

use Config;
use DB;
use Hash;


class UsersTableSeeder extends Seeder
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

		$admin = array(
			'name'					=> 'admin',
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
// 		$user = array(
// 			'name'					=> 'user',
// 			'email'					=> 'user@user.com',
// 			'password'				=> bcrypt('kagiuser'),
// 			'activated_at'			=> date("Y-m-d H:i:s"),
// 			'created_at'			=> date("Y-m-d H:i:s"),
// 			'blocked'				=> 0,
// 			'banned'				=> 0,
// 			'confirmed'				=> 1,
// 			'activated'				=> 1,
// 			'confirmation_code'		=> md5(microtime().Config::get('app.key')),
// 			'avatar'				=> 'assets/images/usr.png'
// 		);

		$permissions = array(
			[
				'name'				=> 'Manage Admin',
				'slug'				=> 'manage_admin',
				'description'		=> 'Give permission to user to access the admin area.'
			],
			[
				'name'				=> 'Manage Own Data',
				'slug'				=> 'manage_own',
				'description'		=> 'Allow users to manage their own data.'
			],
		 );

		$roles = array(
			[
				'name'				=> 'Admin',
				'slug'				=> 'admin',
				'description'		=> 'Give user full permission to site functions.'
			],
			[
				'name'				=> 'User',
				'slug'				=> 'user',
				'description'		=> 'Standard User'
			],
		 );

// Create Permissions
// 		DB::table('permissions')->delete();
// 			$statement = "ALTER TABLE permissions AUTO_INCREMENT = 1;";
// 			DB::unprepared($statement);
		DB::table('permissions')->insert( $permissions );

// Create Roles
		DB::table('roles')->delete();
			$statement = "ALTER TABLE roles AUTO_INCREMENT = 1;";
			DB::unprepared($statement);
		DB::table('roles')->insert( $roles );

// Clear relationships
		DB::table('permission_role')->delete();
			$statement = "ALTER TABLE permission_role AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

		DB::table('role_user')->delete();
			$statement = "ALTER TABLE role_user AUTO_INCREMENT = 1;";
			DB::unprepared($statement);

// Create Users
		DB::table('users')->delete();
			$statement = "ALTER TABLE users AUTO_INCREMENT = 1;";
			DB::unprepared($statement);
		DB::table('users')->insert($admin);
//		DB::table('users')->insert($user);

// Attach permission to role
		$role = $this->role->find(1);
		$role->syncPermissions([1]);
		$role = $this->role->find(2);
		$role->syncPermissions([2]);

// Attach role to user
		$user = User::find(1);
		$user->roles()->attach(1);
		$user = User::find(2);
		$user->roles()->attach(2);

	} // run

}
