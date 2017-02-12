<?php

namespace App\Modules\Core\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Status extends Model
{
    use PresentableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'statuses';

// Presenter ---------------------------------------------------------------
    protected $presenter = 'App\Modules\Core\Http\Presenters\Core';

// Translation Model -------------------------------------------------------
    protected $translator = 'App\Modules\Core\Http\Models\StatusTranslation';

// Hidden ------------------------------------------------------------------
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

// Fillable ----------------------------------------------------------------
    /*
                $table->string('name')->nullable();
                $table->string('description')->nullable();
    */
    protected $fillable = [
        // Translatable columns
        'name',
        'description'
    ];

// Translated Columns ------------------------------------------------------
    protected $translatedAttributes = [
        'name',
        'description'
    ];

// Relationships -----------------------------------------------------------
// Functions ---------------------------------------------------------------

    public function getNameAttribute()
    {
        return $this->name;
    }

    public function getDescriptionAttribute()
    {
        return $this->description;
    }


}
