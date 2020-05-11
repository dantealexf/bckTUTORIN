@extends('layouts.admin')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">
        Formulario de edición de la asesoría
    </h1>
    <p class="mb-4">
        Recuerde que la vista de administrador le permitirá ver y editar solo algunos campos específicos de la asesoría.
    </p>
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Información necesaria para una asesoría</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('advisory.update',$advisory) }}" accept-charset="UTF-8"
                          enctype="multipart/form-data">
                        {{ csrf_field() }} {{ method_field('PUT') }}
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="title">Titulo :</label>
                                <input type="text" class="form-control form-control-user" id="title" name="title"
                                       placeholder="Ingrese un título para la asesoría ..."
                                       value="{{ old('title',$advisory->title) }}">
                                {!! $errors->first('title', '<span class="form-text text-danger">:message</span>') !!}
                            </div>
                            <div class="col-md-6">
                                <h3 class="text-primary">Precio : </h3>
                                <h3>{{ $advisory->price }}</h3>
                            </div>
                            <div class="col-md-6">
                                <h3 class="text-primary">Fecha de entrega : </h3>
                                <h3>{{ $advisory->delivery->format('M/d/Y') }}</h3>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="body">Detalle  :</label>
                                <texasesoría rows="10" name="body" id="body" class="form-control form-control-user"
                                          placeholder="Ingresa el contendido completo de la publicación">{{ old('body',$advisory->body) }}</texasesoría>
                                {!! $errors->first('body', '<span class="form-text text-danger">:message</span>') !!}
                            </div>
                        </div>
                            <button type="submit" class="btn btn-success btn-block">Guardar</button>
                    </form>
                </div>
            </div>
        </div>


    <div class="col-md-4">

        @if(!empty($advisory->image))
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary d-inline">Foto o imagen anexada </h6>
                    <form method="POST"
                          action="{{ route('image.delete', $advisory->image) }}"
                          style="display: inline">
                        {{ csrf_field() }} {{ method_field('DELETE') }}
                        <button class="float-right btn btn-danger btn-sm btn-icon-split"
                                onclick="return confirm('¿Estás seguro de querer eliminar esta imagen?')"
                        ><span class="text"><i class="fa fa-times"></i></span></button>
                    </form>

                </div>
                <div class="card-body d-flex justify-content-center">
                    <img width="300" src="{{ $advisory->image->url }}" alt="Foto anexo" class="img-profile">
                </div>
            </div>
        @endif


        @if(!empty($advisory->file))
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary d-inline">Documento anexado </h6>
                    <form method="POST"
                          action="{{ route('document.delete', $advisory->file) }}"
                          style="display: inline">
                        {{ csrf_field() }} {{ method_field('DELETE') }}
                        <button class="float-right btn btn-danger btn-sm btn-icon-split"
                                onclick="return confirm('¿Estás seguro de querer eliminar este documento?')"
                        ><span class="text"><i class="fa fa-times"></i></span></button>
                    </form>
                </div>
                <div class="card-body d-flex justify-content-center">
                    <a href="{{ $advisory->file->url }}" target="_blank">
                        <img width="100" src="/document.png" alt="Documento anexo">
                    </a>
                </div>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Datos de la asesoría </h6>
            </div>
            <div class="card-body">
                <h5> Categoría :</h5>
                <a href="{{ route('category.show',$advisory->category) }}">
                    <h6> {{ $advisory->category->name }} </h6>
                </a>

                <hr>
                <h5> Nivel :</h5>
                <a href="{{ route('level.show',$advisory->level) }}">
                    <h6> {{ $advisory->level->name }} </h6>
                </a>
                <hr>
                @foreach($advisory->tags as $tag)
                    <a href="{{ route('tag.show',$tag) }}">
                        <span class="text-muted"> # {{ $tag->name }}</span>
                    </a>

                @endforeach
            </div>
        </div>

    </div>

    </div>

@endsection

@push('styles')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endpush

@push('scripts')
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('body');
        $(document).ready(function () {
            $('.datepicker').datepicker({
                autoclose: true
            });
        });
    </script>
@endpush
