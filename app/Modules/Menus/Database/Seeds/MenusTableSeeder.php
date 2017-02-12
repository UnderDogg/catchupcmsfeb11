<?php

namespace App\Modules\Menus\Database\Seeds;

use Illuminate\Database\Seeder;

Use Auth;
use Config;
use DB;
use Eloquent;
use Model;


class MenusTableSeeder extends Seeder
{


	public function run()
	{

		$locale_id = DB::table('locales')
			->where('name', '=', 'English')
			->where('locale', '=', 'en', 'AND')
			->pluck('id');


		$menu_names = array(
		[
			'id'					=> 1,
			'status'				=> 1,
			'name'					=> 'admin',
			'class'					=> 'nav-menu'
		],
		[
			'id'					=> 2,
			'status'				=> 1,
			'name'					=> 'footer',
			'class'					=> 'nav-menu'
		]
		);
		$menu_name_trans = array(
		[
			'status'				=> 1,
			'title'					=> 'Admin',
			'menu_id'				=> 1,
			'locale_id'				=> $locale_id
		],
		[
			'status'				=> 1,
			'title'					=> 'Footer',
			'menu_id'				=> 2,
			'locale_id'				=> $locale_id
		]
		);

// Create Menus
		DB::table('menus')->delete();
			$statement = "ALTER TABLE menus AUTO_INCREMENT = 1;";
			DB::unprepared($statement);
		DB::table('menus')->insert( $menu_names );

// Create Menu Translations
		DB::table('menu_translations')->delete();
			$statement = "ALTER TABLE menu_translations AUTO_INCREMENT = 1;";
			DB::unprepared($statement);
		DB::table('menu_translations')->insert( $menu_name_trans );

	} // run


}
