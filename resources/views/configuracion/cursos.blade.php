@extends('layouts.panel')

@section('title', 'Cursos')
@section('sub-title', 'Configuración de los cursos')

@section('navigation')
    <li>Configuración</li>
    <li class="active">Cursos</li>
@endsection

@section('content')
    <!-- Modal to edit grades -->
    <div id="modalEditar" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar curso</h4>
                </div>

                <form action="{{ url('curso/editar') }}" method="POST">
                    <div class="modal-body">
                        <p>Modificar el curso seleccionado:</p>
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <input type="hidden" name="course_id" value="">

                        <div class="form-group">
                            <label for="name">Nombre del curso:</label>
                            <input type="text" name="name" placeholder="Nombre del curso" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <input type="text" name="description" placeholder="Descripción" value="" class="form-control">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Modificar curso</button>
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
                    <h3 class="box-title">Acerca de los cursos</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Cerrar"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <p>Es necesario definir los cursos que se dictarán en su institución educativa.</p>
                    <p>Los cursos serán asociados a los grados, pero es necesario que sean creados de manera independiente.</p>
                    <p>Tenga en cuenta que los cursos no pueden eliminarse si ya existen datos asociados al mismo.</p>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Registrar nuevo curso</h3>
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

                    <p>A continuación, usted puede definir un nuevo curso.</p>
                    <form action="{{ url('curso/registrar') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name">Nombre del curso:</label>
                            <input type="text" name="name" placeholder="Nombre del curso" value="{{ old('name') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <input type="text" name="description" placeholder="Descripción" value="{{ old('description') }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success pull-right">Registrar nuevo curso</button>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Cursos impartidos en la institución educativa</h3>
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

                    <p>Listado de cursos en la institución educativa:</p>
                    <table class="table responsive">
                        <thead>
                        <tr>
                            <td>Código</td>
                            <td>Nombre del curso</td>
                            <td>Descripción</td>
                            <td>Opciones</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($courses as $course)
                        <tr>
                            <td>{{ $course->id }}</td>
                            <td data-name>{{ $course->name }}</td>
                            <td data-description>{{ $course->description }}</td>
                            <td>
                                <button class="btn btn-primary" data-editar="{{ $course->id }}">Editar</button>
                                <a href="{{ url('curso/eliminar/' . $course->id) }}" class="btn btn-danger">Eliminar</a>
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
    <script src="{{ asset('custom/js/cursos.js') }}"></script>
@endsection