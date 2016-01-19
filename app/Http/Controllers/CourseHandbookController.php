<?php

namespace App\Http\Controllers;

use App\CourseHandbook;
use App\Grade;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CourseHandbookController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $handbooks = CourseHandbook::all();
        return view('configuracion.mallas')->with(compact(['handbooks']));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:course_handbooks|min:4|max:255',
            'description' => 'min:4|max:255'
        ];

        $messages = [
            'name.required' => 'Es necesario definir un nombre.',
            'name.unique' => 'Las mallas curriculares deben tener un nombre único.',
            'name.min' => 'Ingrese un nombre adecuado.',
            'description.min' => 'Ingrese una descripción adecuada.'
        ];

        $v = Validator::make($request->all(), $rules, $messages);

        if ($v->fails())
            return back()->withErrors($v)->withInput();

        CourseHandbook::create($request->all());
        return back()->with('success', 'Malla curricular registrada exitosamente.');
    }

    public function update(Request $request)
    {
        $course_handbook_id = $request->get('course_handbook_id');

        $rules = [
            'course_handbook_id' => 'required|exists:course_handbooks,id',
            'name' => 'required|max:255|unique:course_handbooks,name,'.$course_handbook_id.',id',
            'description' => 'min:4|max:255'
        ];

        $messages = [
            'name.required' => 'Es necesario definir un nombre.',
            'name.unique' => 'Las mallas curriculares deben tener un nombre único.',
            'name.min' => 'Ingrese un nombre adecuado.',
            'description.min' => 'Ingrese una descripción adecuada.'
        ];

        $v = Validator::make($request->all(), $rules, $messages);

        if ($v->fails())
            return [
                'success' => false,
                'errors' => $v->getMessageBag()->toArray()
            ];

        $course_handbook = CourseHandbook::find($request->get('course_handbook_id'));

        // Finally, the course_handbook will be updated
        $course_handbook->name = $request->get('name');
        $course_handbook->description = $request->get('description');
        $course_handbook->save();

        return [
            'success' => true,
            'name' => $course_handbook->name,
            'description' => $course_handbook->description
        ];
    }

    public function destroy($id)
    {
        $course_handbook = CourseHandbook::find($id);

        $relations = $course_handbook->course_grade_relations;
        if ($relations->count() > 0)
            return back()->with('error', 'No es posible eliminar una malla curricular con cursos asignados.');

        $school_years = $course_handbook->school_years;
        if ($school_years->count() > 0)
            return back()->with('error', 'No es posible eliminar una malla curricular si está asignada a un año lectivo.');

        $course_handbook->delete();
        return back();
    }

}
