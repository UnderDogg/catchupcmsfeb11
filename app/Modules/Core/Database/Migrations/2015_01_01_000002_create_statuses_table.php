<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStatusesTable extends Migration
{

	public function __construct()
	{
		// Get the prefix
		$this->prefix = Config::get('core.core_db.prefix', '');
	}


	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
/*
		Schema::create($this->prefix . 'statuses', function(Blueprint $table) {

			$table->engine = 'InnoDB';
			$table->increments('id');

			$table->string('name')->nullable();
			$table->string('description')->nullable();

			$table->softDeletes();
			$table->timestamps();

		});
*/
		Schema::create($this->prefix . 'statuses', function(Blueprint $table) {

			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

// 			$table->string('name');
// 			$table->string('class')->nullable();

			$table->softDeletes();
			$table->timestamps();

		});

		Schema::create($this->prefix . 'status_translations', function(Blueprint $table) {

			$table->engine = 'InnoDB';
			$table->increments('id')->unsigned();

			$table->string('name')->nullable();
			$table->string('description')->nullable();

			$table->integer('status_id')->unsigned()->index();
			$table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');

			$table->integer('locale_id')->unsigned()->index();
			$table->foreign('locale_id')->references('id')->on('locales')->onDelete('cascade');

			$table->unique(['status_id', 'locale_id']);

			$table->softDeletes();
			$table->timestamps();

		});

	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		Schema::drop($this->prefix . 'status_translations');
		Schema::drop($this->prefix . 'statuses');

		if (Schema::hasTable('menulink_translations')) {
			$link_id = DB::table('menulink_translations')
				->where('url', '=', '/admin/statuses')
				->pluck('menulink_id');

			if ( $link_id != null ) {
				Menulink::find($link_id)->delete();
			}
		}

	}

}
