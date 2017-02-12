<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

//use Config;

class CreateUserPreferencesTable extends Migration
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
        Schema::create($this->prefix . 'user_preferences', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->string('key');
            $table->text('value');

            $table->primary('key');

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        if (Schema::hasTable('menulink_translations')) {
            $link_id = DB::table('menulink_translations')
                ->where('url', '=', '/admin/user_preferences')
                ->pluck('menulink_id');

            if ($link_id != null) {
                Menulink::find($link_id)->delete();
            }
        }

        Schema::drop($this->prefix . 'user_preferences');

    }

}
