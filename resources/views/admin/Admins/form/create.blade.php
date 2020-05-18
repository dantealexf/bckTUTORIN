@extends('layouts.admin')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">
        Formulario para crear administradores
    </h1>
    <p class="mb-4">
        El administrador tiene todos los permisos
    </p>

    <form method="POST" action="{{ route('admin.store') }}" accept-charset="UTF-8" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Datos básicos del usuario </h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="">
                                    Genero :
                                </label>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="hombre" name="gender" value="0" class="custom-control-input" {{ (old('gender') == 0 ) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="hombre">Hombre</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="mujer" name="gender" value="1" class="custom-control-input" {{ (old('gender') == 1 ) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="mujer">Mujer</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="otro" name="gender" value="2" class="custom-control-input" {{ (old('gender') == 2 ) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="otro">Otro</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group has-error">
                            <label for="name">Nombre completo :</label>
                            <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Ingrese nombre completo.." value="{{ old('name') }}">
                            {!! $errors->first('name', '<span class="form-text text-danger">:message</span>') !!}
                        </div>
                        <div class="form-group">
                            <label for="email">Correo electrónico  :</label>
                            <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Ingrese su correo electrónico" value="{{ old('email') }}">
                            {!! $errors->first('email', '<span class="form-text text-danger">:message</span>') !!}
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="password">Contraseña :</label>
                                <input type="password" name="password" id="password" class="form-control form-control-user" placeholder="Ingrese contraseña..." value="{{ old('password') }}">
                                {!! $errors->first('password', '<span class="form-text text-danger">:message</span>') !!}
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation">Confirmar contraseña :</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-user" placeholder="Ingrese contraseña..." value="{{ old('password_confirmation') }}">
                                {!! $errors->first('password_confirmation', '<span class="form-text text-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="mobile">Numero de celular  :</label>
                                <input type="text" name="mobile" id="mobile" class="form-control form-control-user" placeholder="Ingrese su número celular ..." value="{{ old('mobile') }}">
                                {!! $errors->first('mobile', '<span class="form-text text-danger">:message</span>') !!}
                            </div>
                            <div class="col-md-6">
                                <label for="birthday">Fecha de nacimiento  :</label>
                                <input name="birthday" id="birthday" class="form-control form-control-user datepicker" data-date-format="mm/dd/yyyy" value="{{ old('birthday') }}">
                                {!! $errors->first('birthday', '<span class="form-text text-danger">:message</span>') !!}
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Imagen de perfil - No obligatoria</h6>
                    </div>
                    <div class="card-body">
                        <label for="avatar">Ingrese foto de perfil en caso de tenerla : </label>
                        <input type="file" name="avatar" id="avatar" class="form-control form-control-user">
                        {!! $errors->first('avatar', '<span class="form-text text-danger">:message</span>') !!}
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Ubicación</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col">
                                <label for="state">Departamento : </label>
                                <input type="text" class="form-control form-control-user" id="state" name="state" placeholder="Ingrese departamento donde vive...">
                                {!! $errors->first('state', '<span class="form-text text-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="city">Ciudad : </label>
                                <input type="text" class="form-control form-control-user" id="city" name="city" placeholder="Ingrese ciudad donde vive...">
                                {!! $errors->first('city', '<span class="form-text text-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="address">Dirección : </label>
                                <input type="text" class="form-control form-control-user" id="address" name="address" placeholder="Ingrese dirección donde vive...">
                                {!! $errors->first('address', '<span class="form-text text-danger">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>

@endsection
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet"/>
@endpush
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $('.datepicker').datepicker({});
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endpush

