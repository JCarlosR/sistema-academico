<?php

namespace App\Http\Controllers;

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
        return view('configuracion.anos-lectivos')->with(compact(['years', 'current_year']));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'unique:school_years|min:4|max:255',
            'start' => 'required|date',
            'end' => 'required|date'
        ];

        $messages = [
            'name.min' => 'Ingrese un nombre adecuado.',
            'start.required' => 'Es necesario definir la fecha de inicio.',
            'end.required' => 'Es necesario definir la fecha de fin.',
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
