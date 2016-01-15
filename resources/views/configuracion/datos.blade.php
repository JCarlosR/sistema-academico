@extends('layouts.panel')

@section('title', 'Datos generales')
@section('sub-title', 'Datos de la institución')

@section('navigation')
    <li>Configuración</li>
    <li class="active">Datos</li>
@endsection

@section('content')
<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Datos generales de la institución educativa</h3>
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
                        <label for="name">Nombre de la institución</label>
                        <input type="text" name="name" placeholder="Institución educativa" class="form-control" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="catchword">Lema</label>
                        <input type="text" name="catchword" placeholder="Motivación e ideal" class="form-control" value="{{ old('catchword') }}">
                    </div>

                    <div class="form-group">
                        <label for="logo">Logo</label>
                        <input type="file" name="logo" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="resolution">Número de resolución</label>
                        <input type="text" name="resolution" placeholder="Resolución" class="form-control" value="{{ old('resolution') }}">
                    </div>

                </div>
                <div class="col-sm-6">

                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input type="text" name="address" placeholder="Dirección" class="form-control" value="{{ old('address') }}">
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="text" name="email" placeholder="Correo electrónico" class="form-control" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="phone">Teléfono</label>
                        <input type="text" name="phone" placeholder="Teléfono" class="form-control" value="{{ old('phone') }}">
                    </div>

                    <div class="form-group">
                        <label for="cellphone">Celular</label>
                        <input type="text" name="cellphone" placeholder="Celular" class="form-control" value="{{ old('cellphone') }}">
                    </div>

                    <button type="submit" class="btn btn-primary pull-right">Guardar cambios</button>
                </div>
            </div>

        </form>
    </div><!-- /.box-body -->
</div><!-- /.box -->
@endsection
