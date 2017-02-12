<?php

namespace App\Modules\Core\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;


class Site extends Model
{

    use PresentableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sites';

// Presenter ---------------------------------------------------------------
    protected $presenter = 'App\Modules\Core\Http\Presenters\Core';


// revisionable ------------------------------------------------------------
    public function identifiableName()
    {
        return $this->name;
    }

// Translation Model -------------------------------------------------------
// Hidden ------------------------------------------------------------------
// Fillable ----------------------------------------------------------------
    /*

                $table->integer('user_id')->default(1);

                $table->integer('lea_id')->nullable()->index();
                $table->string('slug', 255)->nullable()->index();

                $table->string('name',100)->index();
                $table->string('email',100)->nullable();
                $table->string('phone_1',20)->nullable();
                $table->string('phone_2',20)->nullable();
                $table->string('website',100)->nullable();
                $table->string('address',100)->nullable();
                $table->string('city',100)->nullable();
                $table->string('state',60)->nullable();
                $table->string('zipcode',20)->nullable();
                $table->string('logo',100)->nullable();

    //			$table->integer('division_id')->nullable();
    //			$table->string('ad_code',10)->nullable();
                $table->string('bld_number',10)->nullable();

                $table->integer('status_id')->default(1);
                $table->string('theme_slug')->default('default');

                $table->text('notes')->nullable();
    */
    protected $fillable = [
        'lea_id',
        'slug',
        'name',
        'asset_management_name',
        'email',
        'phone_1',
        'phone_2',
        'website',
        'address',
        'city',
        'state',
        'zipcode',
        'logo',
        'user_id',
        'image_id',
//		'division_id',
        'ad_code',
        'bld_number',
        'status_id',
        'theme_slug',
        'notes',
        'google_analytics'
    ];

// Relationships -----------------------------------------------------------

// hasMany

// 	public function employees()
// 	{
// 		return $this->hasMany('App\Modules\jinji\Http\Models\Employee');
// 	}

    public function assets()
    {
        return $this->hasMany('App\Modules\Shisan\Http\Models\Asset');
    }

    public function rooms()
    {
        return $this->hasMany('App\Modules\Shisan\Http\Models\Room');
    }

    public function users()
    {
        return $this->hasMany('App\Modules\Kagi\Http\Models\User');
    }

// belongsTo

// 	public function images()
// 	{
// 		return $this->belongsTo('App\Modules\Filex\Http\Models\Image');
// 	}

    public function user()
    {
        return $this->belongsTo('User');
    }

// 	public function profile()
// 	{
// 		return $this->belongsTo('App\Modules\Profiles\Http\Models\Profile');
// 	}

// belongsToMany

// 	public function employees()
// 	{
// 		return $this->belongsToMany('App\Modules\Core\Http\Models\Site', 'site_id', 'user_id');
// 	}
    public function employees()
    {
        return $this->belongsToMany('App\Modules\Kagi\Http\Models\User', 'site_user');
    }

// Functions ---------------------------------------------------------------


}
