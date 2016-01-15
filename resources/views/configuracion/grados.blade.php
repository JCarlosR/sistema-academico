@extends('layouts.panel')

@section('title', 'Grados')
@section('sub-title', 'Configuración de los grados')

@section('navigation')
    <li>Configuración</li>
    <li class="active">Grados</li>
@endsection

@section('content')
    <!-- Modal to edit grades -->
    <div id="modalEditar" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar grado</h4>
                </div>

                <form action="{{ url('grado/editar') }}" method="POST">
                    <div class="modal-body">
                        <p>Modificar el grado seleccionado:</p>
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <input type="hidden" name="grade_id" value="">

                        <div class="form-group">
                            <label for="name">Nombre del grado:</label>
                            <input type="text" name="name" placeholder="Nombre del grado" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <input type="text" name="description" placeholder="Descripción" value="" class="form-control">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Modificar grado</button>
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
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Acerca de los grados</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Cerrar"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <p>Es necesario definir los grados o niveles de su institución educativa.</p>
                    <p>Cada grado identificará a un grupo de alumnos, según las secciones que se definirán en cada grado.</p>
                    <p>Tenga en cuenta que los grados no pueden eliminarse si ya existen datos asociados al mismo.</p>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Registrar nuevo grado</h3>
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

                    <p>A continuación, usted puede definir un nuevo grado.</p>
                    <form action="{{ url('grado/registrar') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name">Nombre del grado:</label>
                            <input type="text" name="name" placeholder="Nombre del grado" value="{{ old('name') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <input type="text" name="description" placeholder="Descripción" value="{{ old('description') }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success pull-right">Registrar nuevo grado</button>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Grados de la institución educativa</h3>
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

                    <p>Listado de grados en la institución educativa:</p>
                    <table class="table responsive">
                        <thead>
                        <tr>
                            <td>Código</td>
                            <td>Nombre del grado</td>
                            <td>Descripción</td>
                            <td>Opciones</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($grades as $grade)
                        <tr>
                            <td>{{ $grade->id }}</td>
                            <td data-name>{{ $grade->name }}</td>
                            <td data-description>{{ $grade->description }}</td>
                            <td>
                                <button class="btn btn-primary" data-editar="{{ $grade->id }}">Editar</button>
                                <a href="{{ url('configuracion/grado/' . $grade->id) }}" class="btn btn-info">Ver secciones</a>
                                <a href="{{ url('grado/eliminar/' . $grade->id) }}" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('custom/js/grados.js') }}"></script>
@endsection