<?php

namespace App\Modules\Kagi\Http\Models;

use Illuminate\Database\Eloquent\Model;

use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Laracasts\Presenter\PresentableTrait;


class Role extends Model {

	use PresentableTrait;
	use ShinobiTrait;

	protected $table = 'roles';

// Presenter ---------------------------------------------------------------
	protected $presenter = 'App\Modules\Kagi\Http\Presenters\Kagi';

// Translation Model -------------------------------------------------------
// Hidden ------------------------------------------------------------------
//	protected $hidden = ['password', 'remember_token'];

// Fillable ----------------------------------------------------------------
	protected $fillable = ['name', 'slug', 'description'];

// Translated Columns ------------------------------------------------------
// Relationships -----------------------------------------------------------

// hasMany
// belongsTo
// belongsToMany

// Functions ---------------------------------------------------------------


}
