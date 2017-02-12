<?php

namespace App\Modules\Profiles\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Kagi\Http\Models\User;

use Laracasts\Presenter\PresentableTrait;


class Profile extends Model {


	use PresentableTrait;


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'profiles';


// Presenter ---------------------------------------------------------------
	protected $presenter = 'App\Modules\Kagi\Http\Presenters\Profile';


// Translation Model -------------------------------------------------------


// Hidden ------------------------------------------------------------------
//	protected $hidden = ['password', 'remember_token'];

// Fillable ----------------------------------------------------------------
	protected $fillable = [
		'user_id',
		'first_name',
		'middle_initial',
		'last_name',
		'prefix',
		'suffix',
		'email_1',
		'email_2',
		'phone_1',
		'phone_2',
		'phone_extension',
		'address',
		'city',
		'state',
		'zipcode',
		'avatar',
		'prefix',
		'notes'
		];


// Relationships -----------------------------------------------------------

// hasMany
// belongsTo
// belongsToMany


	public function user()
	{
		return $this->belongsTo('App\Modules\Kagi\Http\Models\User');
	}


// Functions ---------------------------------------------------------------


	public function getFullNameAttribute()
	{
		return $this->first_name . '' . $this->last_name;
	}

	public function getFullEmailAttribute()
	{
		return $this->first_name . ' ' . $this->last_name . ' :: ' . $this->email_1;
	}

	public function getBusinessNameAttribute()
	{
		return $this->last_name . ', ' . $this->first_name;
	}


}
