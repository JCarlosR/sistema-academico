@extends('layouts.panel')

@section('title', 'Secciones')
@section('sub-title', 'Configuración de secciones')

@section('navigation')
    <li>Configuración</li>
    <li class="active">Secciones</li>
@endsection

@section('content')
    <!-- Modal to edit sections -->
    <div id="modalEditar" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar sección</h4>
                </div>

                <form action="{{ url('seccion/editar') }}" method="POST">
                    <div class="modal-body">
                        <p>Modificar la sección seleccionada:</p>
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <input type="hidden" name="grade_id" value="{{ $grade->id }}">
                        <input type="hidden" name="section_id" value="">

                        <div class="form-group">
                            <label for="name">Nombre de la sección:</label>
                            <input type="text" name="name" placeholder="Sección" value="" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Modificar sección</button>
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
                    <h3 class="box-title">Acerca de las secciones</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Cerrar"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <p>Es importante definir secciones dentro de cada grado.</p>
                    <p>Incluso si su institución tiene una única sección por grado, debe registrar dicha sección.</p>
                    <p>Esto es importante porque a futuro el sistema soportará nuevas secciones, a medida que su institución crezca.</p>
                    <ul>
                        <li>Grado seleccionado: <strong>{{ $grade->name }}</strong></li>
                    </ul>
                    <p><a href="{{ url('configuracion/grados') }}">Volver al listado de grados</a></p>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Listado de secciones</h3>
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

                    <p>Secciones pertenecientes al grado seleccionado:</p>
                    <table class="table responsive">
                        <thead>
                        <tr>
                            <td>Código</td>
                            <td>Nombre de la sección</td>
                            <td>Opciones</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($sections as $section)
                        <tr>
                            <td>{{ $section->id }}</td>
                            <td data-name>{{ $section->name }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-editar="{{ $section->id }}">Editar</button>
                                <a href="{{ url('seccion/eliminar/' . $section->id) }}" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Registrar nueva sección</h3>
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

                    <p>Registrar nueva sección en el grado seleccionado:</p>
                    <form action="{{ url('seccion/registrar') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="grade_id" value="{{ $grade->id }}">
                        <div class="form-group">
                            <label for="name">Nombre de la sección:</label>
                            <input type="text" name="name" placeholder="Sección" value="{{ old('name') }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success pull-right">Registrar nueva sección</button>
                    </form>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('custom/js/secciones.js') }}"></script>
@endsection
