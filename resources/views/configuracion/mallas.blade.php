@extends('layouts.panel')

@section('title', 'Mallas curriculares')
@section('sub-title', 'Configuración de las mallas curriculares')

@section('navigation')
    <li>Configuración</li>
    <li class="active">Mallas curriculares</li>
@endsection

@section('content')
    <!-- Modal to edit course_handbooks -->
    <div id="modalEditar" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar malla curricular</h4>
                </div>

                <form action="{{ url('malla/editar') }}" method="POST">
                    <div class="modal-body">
                        <p>Modificar la malla curricular seleccionada:</p>
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <input type="hidden" name="course_handbook_id" value="">

                        <div class="form-group">
                            <label for="name">Nombre de la malla curricular:</label>
                            <input type="text" name="name" placeholder="Malla curricular" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <input type="text" name="description" placeholder="Descripción" value="" class="form-control">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Modificar malla curricular</button>
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
                    <h3 class="box-title">Acerca de las mallas curriculares</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimizar"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Cerrar"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <p>Es necesario definir la malla curricular que se usa actualmente en su institución educativa.</p>
                    <p>Es importante, ya que al definir un nuevo año lectivo, se le tendrá que asignar una malla curricular.</p>
                    <p>Tenga en cuenta que una misma malla curricular puede aplicarse a varios años lectivos, pero en caso de requerir modificaciones, usted tendrá que crear una nueva malla curricular.</p>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Registrar nueva malla curricular</h3>
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

                    <p>A continuación, usted puede definir una nueva malla curricular.</p>
                    <form action="{{ url('malla/registrar') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name">Nombre de la malla curricular:</label>
                            <input type="text" name="name" placeholder="Nombre de la malla curricular" value="{{ old('name') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <input type="text" name="description" placeholder="Descripción" value="{{ old('description') }}" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success pull-right">Registrar nuevo malla curricular</button>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Mallas curriculares de la institución educativa</h3>
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

                    <p>Listado de malla curriculars en la institución educativa:</p>
                    <table class="table responsive">
                        <thead>
                        <tr>
                            <td>Código</td>
                            <td>Nombre de la malla curricular</td>
                            <td>Descripción</td>
                            <td>Opciones</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($handbooks as $handbook)
                        <tr>
                            <td>{{ $handbook->id }}</td>
                            <td data-name>{{ $handbook->name }}</td>
                            <td data-description>{{ $handbook->description }}</td>
                            <td>
                                <button class="btn btn-primary" data-editar="{{ $handbook->id }}">Editar</button>
                                <a href="{{ url('configuracion/malla/' . $handbook->id) }}" class="btn btn-info">Acceder</a>
                                <a href="{{ url('malla/eliminar/' . $handbook->id) }}" class="btn btn-danger">Eliminar</a>
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
    <script src="{{ asset('custom/js/mallas.js') }}"></script>
@endsection