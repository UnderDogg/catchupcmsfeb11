<?php

namespace App\Modules\Core\Database\Seeds;

use Illuminate\Database\Seeder;
Use DB;
use Schema;

class ModuleLinksSeeder extends Seeder
{


	public function run()
	{

		$admin_id = DB::table('menus')
			->where('name', '=', 'admin')
			->pluck('id');

		$preferences_id = DB::table('menus')
			->where('name', '=', 'preferences')
			->pluck('id');

		$settings_id = DB::table('menus')
			->where('name', '=', 'settings')
			->pluck('id');

		if ($admin_id == null) {
			$admin_id = 1;
		}
		if ($preferences_id == null) {
			$preferences_id = 1;
		}
		if ($settings_id == null) {
			$settings_id = 1;
		}

		$locale_id = DB::table('locales')
			->where('name', '=', 'English')
			->where('locale', '=', 'en', 'AND')
			->pluck('id');

// Links -------------------------------------------------------------------
// Locales

		$link_names = array([
			'menu_id'				=> $settings_id,
			'status_id'				=> 1,
			'position'				=> 7
		]);

		if (Schema::hasTable('menulinks'))
		{
			DB::table('menulinks')->insert( $link_names );
		}

		$last_insert_id = DB::getPdo()->lastInsertId();

		$ink_name_trans = array([
			'title'					=> 'Locales',
			'status'				=> 1,
			'url'					=> '/admin/locales',
			'menulink_id'			=> $last_insert_id,
			'locale_id'				=> $locale_id // English ID
		]);

		if (Schema::hasTable('menulinks'))
		{
			DB::table('menulink_translations')->insert( $ink_name_trans );
		}

// Settings
		$link_names = array([
			'menu_id'				=> $admin_id,
			'status_id'				=> 1,
			'position'				=> 7
		]);

		if (Schema::hasTable('menulinks'))
		{
			DB::table('menulinks')->insert( $link_names );
		}

		$last_insert_id = DB::getPdo()->lastInsertId();

		$ink_name_trans = array([
			'title'					=> 'Settings',
			'status'				=> 1,
			'url'					=> '/admin/settings',
			'menulink_id'			=> $last_insert_id,
			'locale_id'				=> $locale_id // English ID
		]);

		if (Schema::hasTable('menulinks'))
		{
			DB::table('menulink_translations')->insert( $ink_name_trans );
		}

// Sites
		$link_names = array([
			'menu_id'				=> $settings_id,
			'status_id'				=> 1,
			'position'				=> 7
		]);

		if (Schema::hasTable('menulinks'))
		{
			DB::table('menulinks')->insert( $link_names );
		}

		$last_insert_id = DB::getPdo()->lastInsertId();
		$locale_id = DB::table('locales')
			->where('name', '=', 'English')
			->where('locale', '=', 'en', 'AND')
			->pluck('id');

		$ink_name_trans = array([
			'title'					=> 'Sites',
			'status'				=> 1,
			'url'					=> '/admin/sites',
			'menulink_id'			=> $last_insert_id,
			'locale_id'				=> $locale_id // English ID
		]);

		if (Schema::hasTable('menulinks'))
		{
			DB::table('menulink_translations')->insert( $ink_name_trans );
		}

	} // run

// Statuses
		$link_names = array([
			'menu_id'				=> $settings_id,
			'status_id'				=> 1,
			'position'				=> 7
		]);

		if (Schema::hasTable('menulinks'))
		{
			DB::table('menulinks')->insert( $link_names );
		}

		$last_insert_id = DB::getPdo()->lastInsertId();

		$ink_name_trans = array([
			'title'					=> 'Statuses',
			'status'				=> 1,
			'url'					=> '/admin/statuses',
			'menulink_id'			=> $last_insert_id,
			'locale_id'				=> $locale_id // English ID
		]);

		if (Schema::hasTable('menulinks'))
		{
			DB::table('menulink_translations')->insert( $ink_name_trans );
		}

// user preferences
		$link_names = array([
			'menu_id'				=> $preferences_id,
			'status_id'				=> 1,
			'position'				=> 7
		]);

		if (Schema::hasTable('menulinks'))
		{
			DB::table('menulinks')->insert( $link_names );
		}

		$last_insert_id = DB::getPdo()->lastInsertId();

		$ink_name_trans = array([
			'title'					=> 'Preferences',
			'status'				=> 1,
			'url'					=> '/admin/user_preferences',
			'menulink_id'			=> $last_insert_id,
			'locale_id'				=> $locale_id // English ID
		]);

		if (Schema::hasTable('menulinks'))
		{
			DB::table('menulink_translations')->insert( $ink_name_trans );
		}

	} // run


}
