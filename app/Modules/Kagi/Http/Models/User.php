<?php

namespace App\Modules\Kagi\Http\Models;

//use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Laracasts\Presenter\PresentableTrait;

// extends Authenticatable

abstract class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

    //use Authenticatable;
    use CanResetPassword;
    use PresentableTrait;
    use ShinobiTrait;
    use Notifiable;

    protected $table = 'users';

// Presenter ---------------------------------------------------------------
    protected $presenter = 'App\Modules\Kagi\Http\Presenters\Kagi';

// Translation Model -------------------------------------------------------
// Hidden ------------------------------------------------------------------
    protected $hidden = ['password', 'remember_token'];

// Fillable ----------------------------------------------------------------
    protected $fillable = [
        'name',
        'ad_name',
        'user_badge_id',
        'email',
        'password',
        'blocked',
        'banned',
        'confirmed',
        'allow_direct',
        'activated',
        'activated_at',
        'last_login',
        'avatar',
        'confirmation_code'
    ];

// Translated Columns ------------------------------------------------------
// Relationships -----------------------------------------------------------

// hasMany
// belongsTo
// belongsToMany

// Functions ---------------------------------------------------------------


    public function getFullEmailAttribute()
    {
        return $this->first_name . ' ' . $this->last_name . ' :: ' . $this->email_1;
    }


}
