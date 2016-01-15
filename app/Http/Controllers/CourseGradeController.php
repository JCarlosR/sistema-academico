<?php

namespace App\Http\Controllers;

use App\Course;
use App\Grade;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CourseGradeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($grade_id = null)
    {
        $courses = Course::all();
        $grades = Grade::all();

        if ($grade_id == null) {
            $current_grade = $grades->first();
            $current_courses = $current_grade->courses;
        } else {
            $current_grade = Grade::find($grade_id);
            $current_courses = $current_grade->courses;
        }

        return view('configuracion.asignar-cursos')->with(compact(['courses', 'grades', 'current_courses', 'current_grade']));
    }

    public function store($course_id, $grade_id)
    {
        $course = Course::find($course_id);

        // If the course is already associated
        if ($course->grades->contains($grade_id)) {
            $message = "Este curso ya ha sido asignado al grado.";
            $type = "info";
            return back()->with(compact(['message', 'type']));
        }

        $course->grades()->attach($grade_id);
        $message = "Curso asignado correctamente.";
        $type = "success";
        return back()->with(compact(['message', 'type']));
    }

    public function destroy($course_id, $grade_id)
    {
        $course = Course::find($course_id);

        // If the course is already associated
        if ($course->grades->contains($grade_id)) {
            $course->grades()->detach($grade_id);
            $message = "Se ha eliminado correctamente el curso del grado.";
            $type = "success";
            return back()->with(compact(['message', 'type']));
        }

        $message = "El curso no se encuentra asignado al grado.";
        $type = "warning";
        return back()->with(compact(['message', 'type']));
    }

}
