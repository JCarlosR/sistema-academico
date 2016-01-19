@extends('layouts.panel')

@section('title', 'Matrícula')
@section('sub-title', 'Formulario para el registro de matrículas')

@section('navigation')
    <li>Configuración</li>
    <li class="active">Matrícula</li>
@endsection

@section('content')
<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Registro de matrículas</h3>
        <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Cerrar"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <form action="{{ url('/') }}" method="POST">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-sm-6">

                    <div class="form-group">
                        <label for="name">Seleccione alumno</label>
                        <div class="row">
                            <div class="col-xs-9">
                                <input type="text" name="name" placeholder="Código del alumno" class="form-control" value="{{ old('name') }}" readonly>
                            </div>
                            <div class="col-xs-3">
                                <button type="button" class="btn btn-primary btn-block">
                                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                    Buscar
                                </button>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="catchword">Año lectivo actual</label>
                        <select name="school_year_id" class="form-control">
                            <option value="{{ $school_year->id }}">{{ $school_year->name }}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="grade_id">Seleccione grado</label>
                        <select name="grade_id" id="grade_id" class="form-control">
                            @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="section_id">Seleccione sección</label>
                        <select name="section_id" id="section_id" class="form-control" data-source="{{ url('grado/{id}/secciones') }}">
                            <!-- The options will be re-loaded when the grade change -->
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="col-sm-6">

                    <div class="form-group">
                        <label for="address">Pago por matrícula</label>
                        <input type="text" name="address" placeholder="Monto a pagar ahora" class="form-control" value="{{ old('address') }}">
                    </div>

                    <div class="form-group">
                        <label for="email">Estado actual</label>
                        <select name="status" class="form-control">
                            <option value="0">Pendiente de pago</option>
                            <option value="1">Pago completo</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="phone">Observaciones</label>
                        <textarea name="" class="form-control">{{ old('obs') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-success pull-right">Registrar matrícula</button>
                </div>
            </div>

        </form>
    </div><!-- /.box-body -->
</div><!-- /.box -->
@endsection

@section('scripts')
    <script src="{{ asset('custom/js/matricular.js') }}"></script>
@endsection