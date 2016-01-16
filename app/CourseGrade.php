<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseGrade extends Model
{

    protected $table = 'course_grade';
    protected $fillable = [ 'course_handbook_id', 'course_id', 'grade_id' ];

    public function course_handbook()
    {
        return $this->belongsTo('App\CourseHandbook');
    }

}
