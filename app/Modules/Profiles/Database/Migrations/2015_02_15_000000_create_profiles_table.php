<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateProfilesTable extends Migration {


	public function __construct()
	{
		// Get the prefix
		$this->prefix = Config::get('kagi.kagi_db.prefix', '');
	}


	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create($this->prefix . 'profiles', function(Blueprint $table)
		{

			$table->engine = 'InnoDB';
			$table->increments('id');

			$table->integer('user_id')->index();
			$table->string('first_name',100)->nullable();
			$table->string('middle_initial',4)->nullable();
			$table->string('last_name',100)->nullable();
			$table->string('prefix',20)->nullable();
			$table->string('suffix',20)->nullable();

			$table->string('email_1',100)->nullable();
			$table->string('email_2',100)->nullable();

			$table->string('phone_1',20)->nullable();
			$table->string('phone_2',20)->nullable();
			$table->string('phone_extension',8)->nullable();

			$table->string('address',100)->nullable();
			$table->string('city',100)->nullable();
			$table->string('state',60)->nullable();
			$table->string('zipcode',20)->nullable();

//			$table->string('avatar',100)->nullable();
			$table->text('notes')->nullable();

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
		Schema::drop($this->prefix . 'profiles');
	}


}
