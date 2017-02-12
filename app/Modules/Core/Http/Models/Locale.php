<?php

namespace App\Modules\Core\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Locale extends Model {

	use PresentableTrait;

/**
 * The database table used by the model.
 *
 * @var string
 */
	protected $table = 'locales';

// Presenter ---------------------------------------------------------------
	protected $presenter = 'App\Modules\Core\Http\Presenters\Core';

// Translation Model -------------------------------------------------------
// Hidden ------------------------------------------------------------------

// Fillable ----------------------------------------------------------------
/*
			$table->string('locale', 2);
			$table->string('name', 20);
			$table->string('script', 20);
			$table->string('native', 20);
			$table->boolean('active')->default(0);
			$table->boolean('default')->default(0);
*/
	protected $fillable = [
		'locale',
		'name',
		'script',
		'native',
		'active',
		'default'
		];

// Relationships -----------------------------------------------------------

// hasMany
// belongsTo
// belongsToMany

// Functions ---------------------------------------------------------------


}
