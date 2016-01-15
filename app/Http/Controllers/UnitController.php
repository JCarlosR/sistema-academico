<?php

namespace App\Http\Controllers;

use App\Period;
use App\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $period = Period::find($id);
        $units = $period->units;
        $u = 0;
        $year = $period->school_year;
        return view('configuracion.unidades')->with(compact(['year', 'period', 'units', 'u']));
    }

    public function store(Request $request)
    {
        $rules = [
            'period_id' => 'required|exists:periods,id',
            'start' => 'required|date',
            'end' => 'required|date'
        ];

        $messages = [
            'start.required' => 'Es necesario definir la fecha de inicio.',
            'end.required' => 'Es necesario definir la fecha de fin.',
        ];

        $v = Validator::make($request->all(), $rules, $messages);

        if ($v->fails())
            return back()->withErrors($v)->withInput();

        // Custom validations

        if ($request->get('start') > $request->get('end'))
            $errors['range'] = 'Las fechas son inconsistentes.';

        $period = Period::find($request->get('period_id'));

        // Exist an automatic cast from string to carbon
        // But the comparison for "2016-01-15" < $period->start
        // is evaluated as TRUE when they have the same date
        $start = Carbon::createFromFormat("Y-m-d", $request->get('start'));
        $end = Carbon::createFromFormat("Y-m-d", $request->get('end'));

        if ($start < $period->start)
            $errors['start'] = 'La fecha de inicio debe ser posterior al inicio del periodo.';
        if ($end > $period->end)
            $errors['end'] = 'La fecha de fin debe ser anterior al fin del periodo.';

        if (isset($errors))
            return back()->withErrors($errors)->withInput();

        Unit::create($request->all());
        return back()->with('success', 'Unidad registrada exitosamente.');
    }

    public function update(Request $request)
    {
        $rules = [
            'unit_id' => 'required|exists:units,id',
            'start' => 'required|date',
            'end' => 'required|date'
        ];

        $messages = [
            'unit_id.exists' => 'La unidad indicada no existe.',
            'start.required' => 'Es necesario definir la fecha de inicio.',
            'end.required' => 'Es necesario definir la fecha de fin.',
        ];

        $v = Validator::make($request->all(), $rules, $messages);

        if ($v->fails())
            return [
                'success' => false,
                'errors' => $v->getMessageBag()->toArray()
            ];

        // Getting the unit that will be updated
        $unit = Unit::find($request->get('unit_id'));
        $period = $unit->period;

        // Custom validation
        $start = Carbon::createFromFormat("Y-m-d", $request->get('start'));
        $end = Carbon::createFromFormat("Y-m-d", $request->get('end'));

        if ($start < $period->start)
            $errors['start'] = 'La fecha de inicio debe ser posterior al inicio del periodo.';
        if ($end > $period->end)
            $errors['end'] = 'La fecha de fin debe ser anterior al fin del periodo.';

        if (isset($errors))
            return [
                'success' => false,
                'errors' => $errors
            ];

        // Finally, saving the changes
        $unit->start = $start;
        $unit->end = $end;
        $unit->save();

        return [
            'success' => true,
            'start' => $unit->start_format,
            'end' => $unit->end_format
        ];
    }

    public function destroy($id)
    {
        $unit = Unit::find($id);

        if ($unit !=null)
            $unit->delete();

        return back();
    }

}
