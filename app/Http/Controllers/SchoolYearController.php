<?php

namespace App\Http\Controllers;

use App\CourseHandbook;
use App\SchoolYear;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SchoolYearController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $years = SchoolYear::all();
        $current_year = $years->pop();
        $current_handbook = $current_year->course_handbook;
        $handbooks = CourseHandbook::all();
        return view('configuracion.anos-lectivos')->with(compact(['years', 'current_year', 'current_handbook', 'handbooks']));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:school_years|min:4|max:255',
            'start' => 'required|date',
            'end' => 'required|date',
            'course_handbook_id' => 'required|exists:course_handbooks,id'
        ];

        $messages = [
            'name.required' => 'Por favor indique un nombre para el año lectivo.',
            'name.min' => 'Ingrese un nombre adecuado.',
            'start.required' => 'Es necesario definir la fecha de inicio.',
            'end.required' => 'Es necesario definir la fecha de fin.'
        ];

        $v = Validator::make($request->all(), $rules, $messages);

        if ($v->fails())
            return back()->withErrors($v)->withInput();

        if ($request->get('start') > $request->get('end'))
            return back()->withErrors(['range' => 'Las fechas son inconsistentes.'])->withInput();

        SchoolYear::create($request->all());
        return back()->with('success', 'Año lectivo registrado exitosamente.');
    }

}
