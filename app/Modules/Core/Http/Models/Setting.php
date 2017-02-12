<?php

namespace App\Modules\Core\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Setting extends Model {

	use PresentableTrait;

/**
 * The database table used by the model.
 *
 * @var string
 */
	protected $table = 'settings';

// Presenter ---------------------------------------------------------------
	protected $presenter = 'App\Modules\Core\Http\Presenters\Core';

// Translation Model -------------------------------------------------------
// Hidden ------------------------------------------------------------------
/**
 * The attributes excluded from the model's JSON form.
 *
 * @var array
 */
//	protected $hidden = ['password', 'remember_token'];

// Fillable ----------------------------------------------------------------
/*
			$table->string('name',100)->index();
			$table->string('description')->nullable();
*/
	protected $fillable = [
		'key',
		'value'
		];

// Relationships -----------------------------------------------------------

// hasMany
// belongsTo
// belongsToMany

// Functions ---------------------------------------------------------------


}
