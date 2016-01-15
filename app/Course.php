<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    protected $fillable = [ 'name', 'description' ];

    public function grades()
    {
        return $this->belongsToMany('App\Grade');
    }

}
