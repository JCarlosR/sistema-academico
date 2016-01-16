<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseHandbook extends Model
{
    protected $fillable = [ 'name', 'description' ];

    public function school_years() {
        return $this->hasMany('App\SchoolYear');
    }

    public function course_grade_relations() {
        return $this->hasMany('App\CourseGrade');
    }

}
