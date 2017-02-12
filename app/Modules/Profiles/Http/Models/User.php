<?php

namespace App\Modules\Profiles\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Kagi\Http\Models\User;


class User extends \App\Modules\Kagi\Http\Models\User {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';


// Presenter ---------------------------------------------------------------
// Translation Model -------------------------------------------------------
// Hidden ------------------------------------------------------------------
// Fillable ----------------------------------------------------------------


// Relationships -----------------------------------------------------------

// hasMany
// belongsTo
// belongsToMany


	public function profile()
	{
		return $this->hasOne('App\Modules\Profiles\Http\Models\Profile');
	}


// Functions ---------------------------------------------------------------


}
