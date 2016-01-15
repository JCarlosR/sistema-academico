<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{

    protected $fillable = [ 'name', 'start', 'end', 'school_year_id' ];

    protected $dates = [ 'start', 'end' ];

    public function school_year()
    {
        return $this->belongsTo('App\SchoolYear');
    }

    public function units()
    {
        return $this->hasMany('App\Unit');
    }

    public function getStartFormatAttribute()
    {
        return $this->start->format('d/m/Y');
    }

    public function getEndFormatAttribute()
    {
        return $this->end->format('d/m/Y');
    }

    public function getRangeAttribute()
    {
        return $this->start_format . ' - ' . $this->end_format;
    }

}
