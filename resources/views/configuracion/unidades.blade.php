@extends('layouts.panel')

@section('title', 'Unidades')
@section('sub-title', 'Configuración de las unidades')

@section('navigation')
    <li>Configuración</li>
    <li class="active">Periodos lectivos</li>
@endsection

@section('content')
    <!-- Modal to edit units -->
    <div id="modalEditar" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar unidad</h4>
                </div>

                <form action="{{ url('unidad/editar') }}" method="POST">
                    <div class="modal-body">
                        <p>Modificar la unidad seleccionada:</p>
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <input type="hidden" name="unit_id" value="">

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
                        <button type="submit" class="btn btn-success">Modificar unidad</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Template para alertas -->
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
                    <h3 class="box-title">Acerca de las unidades</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Cerrar"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <p>Es importante crear unidades dentro de los periodos lectivos.</p>
                    <p>Las notas que suben los docentes se asocian siempre a una unidad. Lo mismo ocurre con la asistencia.</p>
                    <p>Un docente puede asignar tareas, trabajos grupales, exámenes y demás tipos de evaluaciones a una unidad.</p>
                    <ul>
                        <li>Año lectivo seleccionado: <strong><a href="{{ url('configuracion/ano-lectivo/' . $year->id) }}">{{ $year->name or 'Sin nombre' }}</a></strong> ({{ $year->range or 'Ninguno' }})</li>
                        <li>Periodo seleccionado: <strong>{{ $period->name }}</strong> ({{ $period->range or 'Ninguno' }})</li>
                    </ul>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Configuración de unidades</h3>
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
                    <p>Unidades comprendidas en el periodo seleccionado:</p>

                    <table class="table responsive">
                        <thead>
                        <tr>
                            <td>Unidad</td>
                            <td>Fecha de inicio</td>
                            <td>Fecha de fin</td>
                            <td>Opciones</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($units as $unit)
                        <tr>
                            <td>{{ ++$u }}</td>
                            <td data-start>{{ $unit->start_format }}</td>
                            <td data-end>{{ $unit->end_format }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-editar="{{ $unit->id }}">Editar</button>
                                <a href="{{ url('unidad/eliminar/' . $unit->id) }}" class="btn btn-danger">Eliminar</a>
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
                    <h3 class="box-title">Registrar nueva unidad</h3>
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

                    <p>Registrar nueva unidad en el periodo seleccionado:</p>
                    <form action="{{ url('unidad/registrar') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="period_id" value="{{ $period->id }}">

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
                        <button type="submit" class="btn btn-success pull-right">Registrar nueva unidad</button>
                    </form>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('custom/js/unidades.js') }}"></script>
@endsection
