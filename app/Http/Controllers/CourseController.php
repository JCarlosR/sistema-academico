<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $courses = Course::all();
        return view('configuracion.cursos')->with(compact(['courses']));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:grades|min:4|max:255',
            'description' => 'min:4|max:255'
        ];

        $messages = [
            'name.required' => 'Es necesario definir un nombre.',
            'name.unique' => 'Los cursos deben tener un nombre único.',
            'name.min' => 'Ingrese un nombre adecuado.',
            'description.min' => 'Ingrese una descripción adecuada.'
        ];

        $v = Validator::make($request->all(), $rules, $messages);

        if ($v->fails())
            return back()->withErrors($v)->withInput();

        Course::create($request->all());
        return back()->with('success', 'Curso registrado exitosamente.');
    }

    public function update(Request $request)
    {
        $course_id = $request->get('course_id');

        $rules = [
            'course_id' => 'required|exists:courses,id',
            'name' => 'required|max:255|unique:courses,name,'.$course_id.',id',
            'description' => 'min:4|max:255'
        ];

        $messages = [
            'name.required' => 'Es necesario definir un nombre.',
            'name.unique' => 'Los cursos deben tener un nombre único.',
            'name.min' => 'Ingrese un nombre adecuado.',
            'description.min' => 'Ingrese una descripción adecuada.'
        ];

        $v = Validator::make($request->all(), $rules, $messages);

        if ($v->fails())
            return [
                'success' => false,
                'errors' => $v->getMessageBag()->toArray()
            ];

        // Finally, the course will be updated
        $course = Course::find($request->get('course_id'));
        $course->name = $request->get('name');
        $course->description = $request->get('description');
        $course->save();

        return [
            'success' => true,
            'name' => $course->name,
            'description' => $course->description
        ];
    }

    public function destroy($id)
    {
        $course = Course::find($id);

 /*     $sections = $grade->sections;
        if ($sections->count() > 0)
            return back()->with('error', 'No es posible eliminar un curso asociado a secciones.');
*/
        $course->delete();
        return back();
    }

}
