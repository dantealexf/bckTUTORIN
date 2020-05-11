@extends('layouts.admin')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">
        Información del usuario
    </h1>
    <p class="mb-4">
        Esta es la vista desde el administrador todos los datos que se muestran aquí no serán visibles para todos los
        clientes del sistema.
    </p>


    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary d-inline">Datos básicos del usuario </h6>
                    @if($student->gender == 0)
                        <button class="float-right btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-male"></i>
                            </span>
                            <span class="text">Hombre</span>
                        </button>
                    @elseif($student->gender == 1)
                        <button class="float-right btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-female"></i>
                            </span>
                            <span class="text">Mujer</span>
                        </button>
                    @else
                        <button class="float-right btn btn-warning btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-transgender"></i>
                            </span>
                            <span class="text">Otro</span>
                        </button>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">
                            <h3 class="text-primary"> Calificación por otros usuarios
                                : {{ $student->profile->valoration }}</h3>
                        </div>

                        <div class="col-md-12">
                            <h3 class="text-primary">Nombre :</h3>
                            <h4>{{ $student->name }}</h4>
                        </div>

                        <div class="col-md-12">
                            <h3 class="text-primary">Correo :</h3>
                            <h4>{{ $student->email }}</h4>
                        </div>

                        <div class="col-md-6">
                            <h3 class="text-primary"> Numero celular:</h3>
                            <h4>{{ $student->mobile }}</h4>
                        </div>
                        <div class="col-md-6">
                            <h3 class="text-primary">Fecha de nacimiento :</h3>
                            <h4>{{ $student->birthday->format('m/d/y') }}</h4>
                        </div>
                        <div class="col-md-6">
                            <h3 class="text-primary">Numero de cedula :</h3>
                            @if($student->profile->dni != null)
                                <h4>{{ $student->profile->dni }}</h4>
                            @else
                                <h4>No registrada</h4>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <h3 class="text-primary">Genero :</h3>
                            @if($student->gender == 0)
                                <h4>Hombre</h4>
                            @elseif($student->gender == 1)
                                <h4>Mujer</h4>
                            @else
                                <h4>Otro</h4>
                            @endif
                        </div>

                        <div class="col-md-12">
                            <h3 class="text-primary">Descripción </h3>
                            @if($student->profile->description != null)
                                <p>
                                    {{ $student->profile->description }}
                                </p>
                            @else
                                <h4>No registra </h4>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">


            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Foto de perfil</h6>
                </div>
                <div class="card-body d-flex justify-content-center">
                    @if(!empty($student->image))
                        <img width="200" class="img-profile" src="{{ $student->image->url }}"
                             alt="Foto de perfil del usario">
                    @else
                        <img width="200" class="img-profile" src="/storage/avatar/default.png"
                             alt="Foto de perfil del usario">
                    @endif
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Categorías seleccionadas </h6>
                </div>
                <div class="card-body">
                    @if( !empty($student->profile->categories) && $student->profile->categories->count() > 0)
                        <ul>
                            @foreach($student->profile->categories as $category)
                                <li>
                                    <a href="{{ route('category.show',$category) }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <h3>No registra en el sistema</h3>
                    @endif
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Etiquetas seleccionadas</h6>
                </div>
                <div class="card-body">
                    @if( !empty($student->profile->tags) && $student->profile->tags->count() > 0)
                        <ul>
                            @foreach($student->profile->tags as $tag)
                                <li>
                                    <a href="{{ route('tag.show',$tag) }}">
                                        {{ $tag->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <h3>No registra en el sistema</h3>
                    @endif
                </div>
            </div>

        </div>
    </div>

    @if( !empty($student->comments))
        @foreach($student->comments as $comment)
            <div class="card shadow mb-4 mt-4">
                <div class="card-header py-3">
                    <a href="{{ route('students.show',$comment->user) }}">
                        <h6 class="m-0 font-weight-bold text-primary d-inline">
                            {{ $comment->user->name }}
                        </h6>
                    </a>

                    <form method="POST"
                          action="{{ route('comment.delete', $comment) }}"
                          style="display: inline">
                        {{ csrf_field() }} {{ method_field('DELETE') }}
                        <button class="float-right btn btn-sm btn-danger"
                                onclick="return confirm('¿Estás seguro de querer eliminar esta comentario?')"
                        ><i class="fa fa-times"></i></button>
                    </form>

                </div>
                <div class="card-body">
                    <p>
                        {{ $comment->body }}
                    </p>
                </div>
            </div>
        @endforeach
    @endif

@endsection
