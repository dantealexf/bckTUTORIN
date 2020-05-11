@extends('layouts.admin')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">
        Información de la tarea
    </h1>
    <p class="mb-4">
        Los datos que se muestran aquí serán visibles para cualquier tutor que cuente con las habilidades requeridas.
    </p>

    <div class="row">
        <div class="col-md-8">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Información necesaria para una tarea</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-primary">Titulo : </h3>
                        <h3>{{ $task->title }}</h3>
                    </div>
                    <div class="col-md-6">
                        <h3 class="text-primary">Precio : </h3>
                        <h3>{{ $task->price }}</h3>
                    </div>
                    <div class="col-md-6">
                        <h3 class="text-primary">Fecha de entrega : </h3>
                        <h3>{{ $task->delivery->format('M/d/Y') }}</h3>
                    </div>
                    <div class="col-md-12">
                        <h3 class="text-primary">Resumen : </h3>
                        <h3>{{ $task->excerpt }}</h3>
                    </div>
                    <div class="col-md-12">
                        <h3 class="text-primary">Detalle : </h3>
                        <p>
                            {!! $task->body !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Usuario que hizo la publicación.</h6>
                </div>
                <div class="card-body">
                    <h3 class="text-primary">Nombre : </h3>
                    <a class="text-muted font-weight-bold" href="{{ route('students.show',$task->user) }}">
                        <h3>
                            {{ $task->user->name }}
                        </h3>
                    </a>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Archivos anexos.</h6>

                </div>
                <div class="card-body">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-12">
                            @if(!empty($task->image))
                                <img width="200" class="img-profile" src="{{ $task->image->url }}"
                                     alt="Foto de perfil del usario">
                            @endif
                        </div>
                        <div class="col-md-12">
                            @if(!empty($task->file))
                                <a href="{{ $task->file->url }}" target="_blank">
                                    <img width="100" src="/document.png" alt="">
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Datos de la tarea </h6>
                </div>
                <div class="card-body">
                    <h5> Categoría :</h5>
                    <a href="{{ route('category.show',$task->category) }}">
                        <h6> {{ $task->category->name }} </h6>
                    </a>

                    <hr>
                    <h5> Nivel :</h5>
                    <a href="{{ route('level.show',$task->level) }}">
                        <h6> {{ $task->level->name }} </h6>
                    </a>
                    <hr>
                    @foreach($task->tags as $tag)
                        <a href="{{ route('tag.show',$tag) }}">
                            <span class="text-muted"> # {{ $tag->name }}</span>
                        </a>

                    @endforeach
                </div>
            </div>

        </div>
    </div>

    @if( !empty($task->offers))
        @foreach($task->offers as $offer)
            <div class="card border-left-success shadow h-100 py-2 mt-4">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold mb-1">
                                <a href="{{ route('students.show',$offer->user) }}">
                                    <h3 class="text-success">{{ $offer->user->name }}</h3>
                                </a>
                                <p>{{ $offer->body }}</p>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $offer->price }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer">

                    <a href="#" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-check"></i>
                    </span>
                        <span class="text">Aceptar propuesta</span>
                    </a>

                    <form method="POST"
                          action="{{ route('offer.delete', $offer) }}"
                          style="display: inline">
                        {{ csrf_field() }} {{ method_field('DELETE') }}
                        <button class="float-right btn btn-danger btn-icon-split"
                                onclick="return confirm('¿Estás seguro de querer eliminar esta oferta?')"
                        ><span class="text">Eliminar Propuesta</span></button>
                    </form>


                </div>
            </div>
        @endforeach
    @endif


@endsection
