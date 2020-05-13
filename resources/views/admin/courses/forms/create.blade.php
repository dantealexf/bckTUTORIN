@extends('layouts.admin')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">
        Formulario de creación de un curso.
    </h1>
    <p class="mb-4">
        Revise los datos del curso antes de publicarlo, solo el administrador podrá modificar los cursos.
    </p>

    <form method="POST" action="{{ route('course.store') }}" ccept-charset="UTF-8" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Información necesaria para un curso.</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Titulo :</label>
                            <input type="text" class="form-control form-control-user" id="title" name="title"
                                   placeholder="Ingrese un título para la asesoria ..." value="{{ old('title') }}">
                            {!! $errors->first('title', '<span class="form-text text-danger">:message</span>') !!}
                        </div>
                        <div class="form-group">
                            <label for="delivery">Fecha en la que necesita la asesoría :</label>
                            <input name="delivery" id="delivery" class="form-control form-control-user datepicker" placeholder="mm/dd/año" data-date-format="mm/dd/yyyy" value="{{ old('delivery') }}">
                            {!! $errors->first('delivery', '<span class="form-text text-danger">:message</span>') !!}
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="price">Precio x Hora:</label>
                                <input type="number" name="price" id="price" class="form-control form-control-user" value="{{ old('price',25000) }}" min="25000"/>
                                {!! $errors->first('price', '<span class="form-text text-danger">:message</span>') !!}
                            </div>
                            <div class="col-md-3">
                                <label for="hours">Cantidad de horas:</label>
                                <input type="number" name="hours" id="hours" class="form-control form-control-user" value="{{ old('hours',1) }}" min="1"/>
                                {!! $errors->first('hours', '<span class="form-text text-danger">:message</span>') !!}
                            </div>
                            <div class="col-md-5 d-flex align-items-center">
                                <span>Tipo de asesoría</span>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="virtual" name="type" value="0" class="custom-control-input" {{ (old('type') == 0 ) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="virtual">Virtual</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="domicilio" name="type" value="1" class="custom-control-input" {{ (old('type') == 1 ) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="domicilio">Domicilió</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="body">¿Qué se va a realizar en la asesoría? :</label>
                            <textarea rows="10" name="body" id="body" class="form-control form-control-user" placeholder="Ingresa el contendido completo de la publicación">{{ old('body') }}</textarea>
                            {!! $errors->first('body', '<span class="form-text text-danger">:message</span>') !!}
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Guardar</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Si tiene una foto puede ingresarla aquí - No es obligatorio </h6>
                    </div>
                    <div class="card-body">
                        <label for="photo">Foto o imagen  : </label>
                        <input type="file" name="photo" id="photo" class="form-control form-control-user">
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Si tiene un Documento puede ingresarlo aquí - No es obligatorio </h6>
                    </div>
                    <div class="card-body">
                        <label for="document">Documento  : </label>
                        <input type="file" name="document" id="document" class="form-control form-control-user">
                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Clasificación de la asesoría</h6>
                    </div>
                    <div class="card-body">
                        <label for="level">Nivel:</label>
                        <select class="form-control form-control-user js-example-basic-single" id="level" name="level" >
                            @foreach($levels as $level)
                                <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('level', '<span class="form-text text-danger">:message</span>') !!}

                        <label for="category">Categoría:</label>
                        <select class="form-control form-control-user js-example-basic-single" id="category" name="category">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('category', '<span class="form-text text-danger">:message</span>') !!}

                        <label for="tags">Etiquetas:</label>
                        <select class="form-control form-control-user js-example-basic-multiple" id="tags" name="tags[]" multiple="multiple">
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('tags', '<span class="form-text text-danger">:message</span>') !!}
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
                                <input type="text" class="form-control form-control-user" id="state" name="state" placeholder="Ingrese departamento donde vive..." value="{{ old('state',$user->location->state) }}">
                                {!! $errors->first('state', '<span class="form-text text-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="city">Ciudad : </label>
                                <input type="text" class="form-control form-control-user" id="city" name="city" placeholder="Ingrese ciudad donde vive..." value="{{ old('city',$user->location->city) }}">
                                {!! $errors->first('city', '<span class="form-text text-danger">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="address">Dirección : </label>
                                <input type="text" class="form-control form-control-user" id="address" name="address" placeholder="Ingrese dirección donde vive..." value="{{ old('address',$user->location->address) }}">
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('body');
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            $('.js-example-basic-multiple').select2({
                tags: true
            });
            $('.datepicker').datepicker({
                autoclose: true
            });
        });
    </script>
@endpush
