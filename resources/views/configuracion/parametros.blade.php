@extends('layouts.panel')

@section('title', 'Parámetros generales')
@section('sub-title', 'Configuración de parámetros')

@section('navigation')
    <li>Configuración</li>
    <li class="active">Parámetros</li>
@endsection

@section('content')
<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Parámetros generales de configuración</h3>
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
                        <label for="registration_fee">Costo de la matrícula</label>
                        <input type="text" name="registration_fee" placeholder="Costo de la matrícula" class="form-control" value="{{ old('registration_fee') }}">
                    </div>

                    <div class="form-group">
                        <label for="monthly_payment">Pago mensual</label>
                        <input type="text" name="monthly_payment" placeholder="Pago mensual referencial" class="form-control" value="{{ old('monthly_payment') }}">
                    </div>

                    <div class="form-group">
                        <label for="coin_name">Nombre de la moneda</label>
                        <input type="text" name="coin_name" placeholder="Nombre de la moneda" class="form-control" value="{{ old('coin_name') }}">
                    </div>

                    <div class="form-group">
                        <label for="coin_symbol">Símbolo de la moneda</label>
                        <input type="text" name="coin_symbol" placeholder="Símbolo de la moneda" class="form-control" value="{{ old('coin_symbol') }}">
                    </div>

                </div>
                <div class="col-sm-6">

                    <div class="form-group">
                        <label for="periods_per_year">Periodos por año lectivo</label>
                        <input type="text" name="periods_per_year" placeholder="Número de periodos por año lectivo" class="form-control" value="{{ old('periods_per_year') }}">
                    </div>

                    <div class="form-group">
                        <label for="units_per_period">Unidades por periodo</label>
                        <input type="text" name="units_per_period" placeholder="Número de unidades por periodo" class="form-control" value="{{ old('units_per_period') }}">
                    </div>

                    <button type="submit" class="btn btn-primary pull-right">Guardar cambios</button>
                </div>
            </div>

        </form>
    </div><!-- /.box-body -->
</div><!-- /.box -->
@endsection
