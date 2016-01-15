<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
        'first_name', 'last_name', 'identity_card', 'gender', 'birth_date', 'photo', 'remark',
        'phone', 'cellphone', 'address',
        'role_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * A user have one role in the system.
     */
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    /**
     * The first name + the last name.
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

}
