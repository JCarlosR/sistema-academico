<?php

namespace App\Http\Controllers;

use App\Grade;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GradeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $grades = Grade::all();
        return view('configuracion.grados')->with(compact(['grades']));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:grades|min:4|max:255',
            'description' => 'min:4|max:255'
        ];

        $messages = [
            'name.required' => 'Es necesario definir un nombre.',
            'name.unique' => 'Los grados deben tener un nombre único.',
            'name.min' => 'Ingrese un nombre adecuado.',
            'description.min' => 'Ingrese una descripción adecuada.'
        ];

        $v = Validator::make($request->all(), $rules, $messages);

        if ($v->fails())
            return back()->withErrors($v)->withInput();

        Grade::create($request->all());
        return back()->with('success', 'Grado registrado exitosamente.');
    }

    public function update(Request $request)
    {
        $grade_id = $request->get('grade_id');

        $rules = [
            'grade_id' => 'required|exists:grades,id',
            'name' => 'required|max:255|unique:grades,name,'.$grade_id.',id',
            'description' => 'min:4|max:255'
        ];

        $messages = [
            'name.required' => 'Es necesario definir un nombre.',
            'name.unique' => 'Los grados deben tener un nombre único.',
            'name.min' => 'Ingrese un nombre adecuado.',
            'description.min' => 'Ingrese una descripción adecuada.'
        ];

        $v = Validator::make($request->all(), $rules, $messages);

        if ($v->fails())
            return [
                'success' => false,
                'errors' => $v->getMessageBag()->toArray()
            ];

        // Finally, the grade will be updated
        $grade = Grade::find($request->get('grade_id'));
        $grade->name = $request->get('name');
        $grade->description = $request->get('description');
        $grade->save();

        return [
            'success' => true,
            'name' => $grade->name,
            'description' => $grade->description
        ];
    }

    public function destroy($id)
    {
        $grade = Grade::find($id);
        $sections = $grade->sections;

        if ($sections->count() > 0)
            return back()->with('error', 'No es posible eliminar un grado asociado a secciones.');

        $grade->delete();
        return back();
    }

    public function sections($id)
    {
        $grade = Grade::find($id);
        $sections = $grade->sections;
        return $sections;
    }

}
