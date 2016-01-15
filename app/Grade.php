<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [ 'name', 'description' ];

    public function sections()
    {
        return $this->hasMany('App\Section');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course');
    }

}
