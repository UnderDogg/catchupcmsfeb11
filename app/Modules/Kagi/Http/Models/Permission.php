<?php

namespace App\Modules\Kagi\Http\Models;

use Illuminate\Database\Eloquent\Model;

use Laracasts\Presenter\PresentableTrait;


class Permission extends Model {

	use PresentableTrait;

	protected $table = 'permissions';

// Presenter ---------------------------------------------------------------
	protected $presenter = 'App\Modules\Kagi\Http\Presenters\Kagi';

// Translation Model -------------------------------------------------------

// Hidden ------------------------------------------------------------------
//	protected $hidden = ['_token'];

// Fillable ----------------------------------------------------------------
	protected $fillable = ['name', 'slug', 'description'];

// Translated Columns ------------------------------------------------------
// Relationships -----------------------------------------------------------

// hasMany
// belongsTo
// belongsToMany

// Functions ---------------------------------------------------------------


}
