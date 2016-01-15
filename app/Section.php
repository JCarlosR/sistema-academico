<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [ 'grade_id', 'name' ];

    public function grade()
    {
        return $this->belongsTo('App\Grade');
    }

}
