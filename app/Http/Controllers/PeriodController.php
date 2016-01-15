<?php

namespace App\Http\Controllers;

use App\Period;
use App\SchoolYear;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Mockery\CountValidator\Exception;

class PeriodController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $year = SchoolYear::find($id);
        if ($year == null)
            return redirect('/');

        $periods = $year->periods;

        return view('configuracion.periodos-lectivos')->with(compact(['year', 'periods']));
    }

    public function store(Request $request)
    {
        $rules = [
            'school_year_id' => 'required|exists:school_years,id',
            'name' => 'required|min:4|max:255',
            'start' => 'required|date',
            'end' => 'required|date'
        ];

        $messages = [
            'name.required' => 'Es necesario asignar un nombre al periodo.',
            'name.min' => 'Ingrese un nombre adecuado.',
            'start.required' => 'Es necesario definir la fecha de inicio.',
            'end.required' => 'Es necesario definir la fecha de fin.',
        ];

        $v = Validator::make($request->all(), $rules, $messages);

        if ($v->fails())
            return back()->withErrors($v)->withInput();

        // Custom validations

        if ($request->get('start') > $request->get('end'))
            $errors['range'] = 'Las fechas son inconsistentes.';

        $year = SchoolYear::find($request->get('school_year_id'));
        if ($request->get('start') < $year->start)
            $errors['start'] = 'La fecha de inicio debe ser posterior al inicio del año lectivo.';
        if ($request->get('end') > $year->end)
            $errors['end'] = 'La fecha de fin debe ser anterior al fin del año lectivo.';

        if (isset($errors))
            return back()->withErrors($errors)->withInput();

        Period::create($request->all());
        return back()->with('success', 'Periodo lectivo registrado exitosamente.');
    }

    public function update(Request $request)
    {
        $rules = [
            'period_id' => 'required|exists:periods,id',
            'name' => 'required|min:4|max:255',
            'start' => 'required|date',
            'end' => 'required|date'
        ];

        $messages = [
            'period_id.exists' => 'El periodo indicado no existe.',
            'name.required' => 'Es necesario asignar un nombre al periodo.',
            'name.min' => 'Ingrese un nombre adecuado.',
            'start.required' => 'Es necesario definir la fecha de inicio.',
            'end.required' => 'Es necesario definir la fecha de fin.',
        ];

        $v = Validator::make($request->all(), $rules, $messages);

        if ($v->fails())
            return [
                'success' => false,
                'errors' => $v->getMessageBag()->toArray()
            ];

        // Getting the period that will be updated
        $period = Period::find($request->get('period_id'));
        $year = $period->school_year;

        // Custom validation
        $name = $request->get('name');
        $start = Carbon::createFromFormat("Y-m-d", $request->get('start'));
        $end = Carbon::createFromFormat("Y-m-d", $request->get('end'));

        if ($start < $year->start)
            $errors['start'] = 'La fecha de inicio debe ser posterior al inicio del año lectivo.';
        if ($end > $year->end)
            $errors['end'] = 'La fecha de fin debe ser anterior al fin del año lectivo.';

        if (isset($errors))
            return [
                'success' => false,
                'errors' => $errors
            ];

        // Finally, saving the changes
        $period->name = $name;
        $period->start = $start;
        $period->end = $end;
        $period->save();

        return [
            'success' => true,
            'name' => $period->name,
            'start' => $period->start_format,
            'end' => $period->end_format
        ];
    }

    public function destroy($id)
    {
        $period = Period::find($id);
        $units = $period->units;

        if ($units->count() > 0)
            return back()->with('error', 'No es posible eliminar un periodo asociado a unidades.');

        $period->delete();
        return back();
    }

}
