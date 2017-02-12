<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

//use Config;

class CreateLocalesTable extends Migration
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
        Schema::create($this->prefix . 'locales', function (Blueprint $table) {

            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();

            $table->string('locale', 7);
            $table->string('name', 30);
            $table->string('script', 30);
            $table->string('native', 30);
            $table->boolean('active')->default(0);
            $table->boolean('default')->default(0);

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

        Schema::drop($this->prefix . 'locales');

        if (Schema::hasTable('menulink_translations')) {
            $link_id = DB::table('menulink_translations')
                ->where('url', '=', '/admin/locales')
                ->pluck('menulink_id');

            if ($link_id != null) {
                Menulink::find($link_id)->delete();
            }
        }

    }

}
