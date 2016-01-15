@extends('layouts.panel')

@section('title', 'Periodos lectivos')
@section('sub-title', 'Configuración de los periodos')

@section('navigation')
    <li>Configuración</li>
    <li class="active">Periodos lectivos</li>
@endsection

@section('content')
    <!-- Modal to edit periods -->
    <div id="modalEditar" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar periodo</h4>
                </div>

                <form action="{{ url('periodo/editar') }}" method="POST">
                    <div class="modal-body">
                        <p>Modificar el periodo seleccionado:</p>
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <input type="hidden" name="period_id" value="">

                        <div class="form-group">
                            <label for="name">Nombre del periodo lectivo:</label>
                            <input type="text" name="name" placeholder="Nombre del periodo" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="start">Fecha de inicio:</label>
                                    <input type="date" name="start" value="" class="form-control">
                                </div>
                                <div class="col-sm-6">
                                    <label for="end">Fecha de fin:</label>
                                    <input type="date" name="end" value="" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Modificar periodo</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Template for alerts -->
    <template id="template-alerta">
        <div class="alert alert-danger fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Hey!</strong> <span></span>
        </div>
    </template>

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Acerca de los periodos lectivos</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Cerrar"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <p>Es importante crear periodos dentro de los años lectivos.</p>
                    <p>Si el año lectivo de su institución educativa se divide en 2 semestres, usted debería crear 2 periodos, y nombrarlos como mejor le parezca.</p>
                    <p>Por ejemplo, podría nombrarlos "Primer semestre" y "Segundo semestre", o bien "2016-I" y "2016-II".</p>
                    <ul>
                        <li>Año lectivo seleccionado: <strong>{{ $year->name or 'Sin nombre' }}</strong> ({{ $year->range or 'Ninguno' }})</li>
                    </ul>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Configuración de periodos</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    <p>Periodos comprendidos en el año lectivo seleccionado:</p>
                    <table class="table responsive">
                        <thead>
                        <tr>
                            <td>Código</td>
                            <td>Nombre del periodo</td>
                            <td>Fecha de inicio</td>
                            <td>Fecha de fin</td>
                            <td>Opciones</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($periods as $period)
                        <tr>
                            <td>{{ $period->id }}</td>
                            <td data-name>{{ $period->name }}</td>
                            <td data-start>{{ $period->start_format }}</td>
                            <td data-end>{{ $period->end_format }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-editar="{{ $period->id }}">Editar</button>
                                <a href="{{ url('configuracion/periodo-lectivo/' . $period->id) }}" class="btn btn-success">Ver unidades</a>
                                <a href="{{ url('periodo/eliminar/' . $period->id) }}" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Registrar nuevo periodo</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <p>Registrar nuevo periodo en el año lectivo seleccionado:</p>
                    <form action="{{ url('periodo/registrar') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="school_year_id" value="{{ $year->id }}">

                        <div class="form-group">
                            <label for="name">Nombre del periodo lectivo:</label>
                            <input type="text" name="name" placeholder="Nombre del periodo" value="{{ old('name') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="start">Fecha de inicio:</label>
                                    <input type="date" name="start" value="{{ old('start') }}" class="form-control">
                                </div>
                                <div class="col-sm-6">
                                    <label for="end">Fecha de fin:</label>
                                    <input type="date" name="end" value="{{ old('end') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success pull-right">Registrar nuevo periodo</button>
                    </form>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('custom/js/periodos.js') }}"></script>
@endsection
