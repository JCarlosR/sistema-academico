<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    /**
     * A role is assigned to a group of users.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

}
