<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{

    protected $fillable = [ 'name', 'start', 'end', 'course_handbook_id' ];

    protected $dates = [ 'start', 'end' ];

    public function periods()
    {
        return $this->hasMany('App\Period');
    }

    public function course_handbook()
    {
        return $this->belongsTo('App\CourseHandbook');
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
