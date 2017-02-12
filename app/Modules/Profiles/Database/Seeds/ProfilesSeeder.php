<?php

namespace App\Modules\Profiles\Database\Seeds;

use Illuminate\Database\Seeder;

use DB;
use Schema;


class ProfilesSeeder extends Seeder
{


    public function run()
    {

        /*
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

                    $table->string('address',100)->nullable();
                    $table->string('city',100)->nullable();
                    $table->string('state',60)->nullable();
                    $table->string('zipcode',20)->nullable();

        //			$table->string('avatar',100)->nullable();
                    $table->text('notes')->nullable();


        first_name	1
        middle_name	2
        last_name	3


        email_primary	4

        phone_primary	5

        address	6
        city	7
        state	8
        zipcode	9

        */


// Create Profiles
        DB::table('profiles')->delete();
        $statement = "ALTER TABLE profiles AUTO_INCREMENT = 1;";
        DB::unprepared($statement);

        $profiles = array(
            'user_id' => 1,
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email_1' => 'admin@admin.com'
        );

        DB::table('profiles')->insert($profiles);


        $csv = dirname(__FILE__) . '/data/' . 'shorter.csv';
        $file_handle = fopen($csv, "r");

        while (!feof($file_handle)) {

            $line = fgetcsv($file_handle);
            if (empty($line)) {
                continue; // skip blank lines
            }

            $c = array();
            $c['id'] = $line[0];
            $c['user_id'] = $line[0];

            $c['first_name'] = $line[1];
//			$c['middle_initial']	= $line[2];
            $c['last_name'] = $line[2];

            $c['email_1'] = $line[3];
            $c['phone_1'] = $line[4];
            $c['phone_2'] = $line[5];

// 			$c['address']			= $line[6];
// 			$c['city']				= $line[7];
// 			$c['state']				= $line[8];
// 			$c['zipcode']			= $line[9];
//
// 			$c['notes']				= $line[15];

            DB::table('profiles')->insert($c);

        }

        fclose($file_handle);

    } // run


}
