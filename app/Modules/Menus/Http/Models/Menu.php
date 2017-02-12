<?php
namespace App\Modules\Menus\Http\Models;

use Illuminate\Database\Eloquent\Model;

use Laracasts\Presenter\PresentableTrait;

class Menu extends Model
{
    use PresentableTrait;

    protected $table = 'menus';


// Presenter ---------------------------------------------------------------
    protected $presenter = 'App\Modules\Menus\Http\Presenters\Menus';


// Translation Model -------------------------------------------------------
    protected $translator = 'App\Modules\Menus\Http\Models\MenuTranslation';


// Hidden ------------------------------------------------------------------
    protected $hidden = [
        'created_at',
        'updated_at'
    ];


// Fillable ----------------------------------------------------------------
    protected $fillable = [
        'class',
        'enable',
        'name',
        // Translatable columns
        'status',
        'title'
    ];


// Translated Columns ------------------------------------------------------
    protected $translatedAttributes = [
        'status',
        'title'
    ];

// 	protected $appends = [
// 		'status',
// 		'title'
// 		];


// Relationships -----------------------------------------------------------

// hasMany
// belongsTo
// belongsToMany

// Functions ---------------------------------------------------------------

    public function getStatusAttribute()
    {
        return $this->status;
    }

    public function getTitleAttribute()
    {
        return $this->title;
    }

    public function scopeIsEnabled($query)
    {
        return $query
            ->where('status', '=', 1);
    }


}
