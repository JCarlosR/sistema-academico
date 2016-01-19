<?php

namespace App\Http\Controllers;

use App\Grade;
use App\SchoolYear;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EnrollmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $school_year = SchoolYear::orderBy('id', 'desc')->first();
        $grades = Grade::all();
        $sections = $grades->first()->sections;
        return view('matriculas.matricular')->with(compact(['school_year', 'grades', 'sections']));
    }

}
