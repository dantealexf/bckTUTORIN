@extends('layouts.admin')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">
        Información del usuario
    </h1>
    <p class="mb-4">
        Esta es la vista desde el administrador todos los datos que se muestran aquí no serán visibles para todos los
        clientes del sistema.
    </p>

    @if($user->profile->viewed == false)
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between">
                <h5 class="text-primary">
                    Mensaje del administrador
                </h5>
                <form method="POST" action="{{ route('teachers.viewed') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <button class="btn btn-danger btn-sm float-right">
                        <i class="fa fa-times"></i>
                    </button>
                </form>
            </div>
            <div class="card-body">
                <p>
                    {{ $user->profile->message }}
                </p>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary d-inline">Datos básicos del usuario </h6>
                    @if($user->gender == 0)
                        <button class="float-right btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-male"></i>
                            </span>
                            <span class="text">Hombre</span>
                        </button>
                    @elseif($user->gender == 1)
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
                                : {{ $user->profile->valoration }}</h3>
                        </div>

                        <div class="col-md-12">
                            <h3 class="text-primary">Nombre :</h3>
                            <h4>{{ $user->name }}</h4>
                        </div>

                        <div class="col-md-12">
                            <h3 class="text-primary">Correo :</h3>
                            <h4>{{ $user->email }}</h4>
                        </div>

                        <div class="col-md-6">
                            <h3 class="text-primary"> Numero celular:</h3>
                            <h4>{{ $user->mobile }}</h4>
                        </div>
                        <div class="col-md-6">
                            <h3 class="text-primary">Fecha de nacimiento :</h3>
                            <h4>{{ $user->birthday->format('m/d/y') }}</h4>
                        </div>
                        <div class="col-md-6">
                            <h3 class="text-primary">Numero de cedula :</h3>
                            @if($user->profile->dni != null)
                                <h4>{{ $user->profile->dni }}</h4>
                            @else
                                <h4>No registrada</h4>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <h3 class="text-primary">Estado :</h3>
                            <h4>
                                @if($user->profile->verified)
                                    <button class="btn btn-sm btn-success"><i class="fa fa-check"></i></button>
                                @elseif($user->profile->request)
                                    <button class="btn btn-sm btn-warning"><i class="fa fa-exclamation"></i></button>
                                @endif
                            </h4>
                        </div>

                        <div class="col-md-12">
                            <h3 class="text-primary">Descripción </h3>
                            @if($user->profile->description != null)
                                <p>
                                    {{ $user->profile->description }}
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

            <form method="POST" action="{{ route('teachers.message') }}">
                {{ csrf_field() }}
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Evaluación del administrador</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="col-md-12">
                                <label for="">
                                    Verificación :
                                </label> <br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="completed" name="verified" value="1"
                                           class="custom-control-input" {{ (old('verified',$user->profile->verified) == 1 ) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="completed">Completo</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="incompleted" name="verified" value="0"
                                           class="custom-control-input" {{ (old('verified',$user->profile->verified) == 0 ) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="incompleted">Incompleto</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message">Mensaje :</label>
                            <input class="form-control" type="text" name="message"
                                   placeholder="Mensaje del administrador al usuario " required>
                        </div>
                        <button class="btn btn-success btn-block" type="submit">
                            <i class="fa fa-envelope"></i>
                        </button>
                    </div>
                </div>
            </form>


            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Foto de perfil</h6>
                </div>
                <div class="card-body d-flex justify-content-center">
                    @if(!empty($user->image))
                        <img width="200" class="img-profile" src="{{ $user->image->url }}"
                             alt="Foto de perfil del usario">
                    @else
                        <img width="200" class="img-profile" src="/storage/avatar/default.png"
                             alt="Foto de perfil del usario">
                    @endif
                </div>
            </div>


            <form method="POST" action="{{ route('teachers.file') }}" accept-charset="UTF-8"
                  enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Anexar documento</h6>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <div class="row">
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <div class="form-group col-md-10">
                                <label for="type">Tipo de documento :</label>
                                <select class="form-control" name="type" id="type">
                                    <option value="CC">Cedula de ciudadanía</option>
                                    <option value="CE">Cedula de extranjería</option>
                                    <option value="PA">Pasaporte</option>
                                    <option value="TI">Tarjeta de identidad</option>
                                    <option value="ES">Estudio</option>
                                    <option value="CB">Certificación bancaria</option>
                                </select>
                                <hr>
                                <input class="form-control" type="file" name="file" id="file"
                                       style="color: transparent;">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-block btn-success"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </form>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Categorías seleccionadas </h6>
                </div>
                <div class="card-body">
                    @if( !empty($user->profile->categories) && $user->profile->categories->count() > 0)
                        <ul>
                            @foreach($user->profile->categories as $category)
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
                    @if( !empty($user->profile->tags) && $user->profile->tags->count() > 0)
                        <ul>
                            @foreach($user->profile->tags as $tag)
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

    @if( !empty($user->profile->documents))
        <div class="row">
            @foreach($user->profile->documents as $document)
                <div class="card shadow mb-4 mt-4 col-md-4 ml-2">
                    <div class="card-header py-3">
                        <h3>
                            @if($document->type == 'CC')
                                Cedula de ciudadanía
                            @elseif($document->type == 'CE')
                                Cedula de extranjería
                            @elseif($document->type == 'PA')
                                Pasaporte
                            @elseif($document->type == 'TI')
                                Tarjeta de identidad
                            @elseif($document->type == 'ES')
                                Estudio
                            @elseif($document->type == 'CB')
                                Certificación bancaria
                            @endif
                        </h3>
                    </div>
                    <div class="card-body">
                        <a href="{{ $document->url }}" target="_blank">
                            <img width="100" src="/document.png" alt="">
                        </a>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        @if($document->verified)
                            <button class="btn btn-success">
                                <i class="fa fa-check"></i>
                            </button>
                        @else
                            <button class="btn btn-warning">
                                <i class="fa fa-exclamation"></i>
                            </button>
                        @endif

                        @if(! $document->verified)
                            <form method="POST" action="{{ route('teachers.verify') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="document" value="{{ $document->id }}">
                                <button class="btn btn-success">
                                    <i class="fa fa-thumbs-up"></i>
                                </button>
                            </form>
                        @endif

                    </div>
                </div>
            @endforeach
        </div>
    @endif




    @if( !empty($user->comments))
        @foreach($user->comments as $comment)
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
