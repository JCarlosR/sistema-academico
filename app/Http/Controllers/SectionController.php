<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Period;
use App\SchoolYear;
use App\Section;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\CountValidator\Exception;

class SectionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $grade = Grade::find($id);
        if ($grade == null)
            return redirect('/');

        $sections = $grade->sections;

        return view('configuracion.secciones')->with(compact(['grade', 'sections']));
    }

    public function store(Request $request)
    {
        $grade_id = $request->get('grade_id');

        $rules = [
            'grade_id' => 'required|exists:grades,id',
            'name' => 'required|max:255|unique:sections,name,NULL,id,grade_id,'.$grade_id
        ];

        $messages = [
            'name.required' => 'Es necesario asignar un nombre al periodo.',
            'name.max' => 'Ingrese un nombre adecuado.',
            'name.unique' => 'Los nombres de sección no se pueden repetir en un mismo grado.'
        ];

        $v = Validator::make($request->all(), $rules, $messages);

        if ($v->fails())
            return back()->withErrors($v)->withInput();

        if (isset($errors))
            return back()->withErrors($errors)->withInput();

        Section::create($request->all());
        return back()->with('success', 'Sección registrada exitosamente.');
    }

    public function update(Request $request)
    {
        $section_id = $request->get('section_id');
        $grade_id = $request->get('grade_id');

        $rules = [
            'section_id' => 'required|exists:sections,id',
            'name' => 'required|max:255|unique:sections,name,$section_id,id,grade_id,$grade_id'
        ];

        $messages = [
            'name.required' => 'Es necesario asignar un nombre a la sección.',
            'name.max' => 'Ingrese un nombre adecuado.',
            'name.unique' => 'Los nombres de sección no se pueden repetir en un mismo grado.'
        ];

        $v = Validator::make($request->all(), $rules, $messages);

        if ($v->fails())
            return [
                'success' => false,
                'errors' => $v->getMessageBag()->toArray()
            ];

        // Finally, saving the changes
        $section = Section::find($section_id);
        $section->name = $request->get('name');
        $section->save();

        return [
            'success' => true,
            'name' => $section->name
        ];
    }

    public function destroy($id)
    {
        $section = Section::find($id);

        // have something associated?
        // we have to validate these relationships in a future

        /*if ($units->count() > 0)
            return back()->with('error', 'No es posible eliminar un periodo asociado a unidades.');
        */

        $section->delete();
        return back();
    }

}
