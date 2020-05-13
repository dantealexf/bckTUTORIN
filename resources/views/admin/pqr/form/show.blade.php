@extends('layouts.admin')

@section('content')
    <h1 class="h3 mb-2 text-gray-800">
        Información
    </h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Datos PQR</h6>
                @if($pqr->type == 'REQUEST')
                    <button class="btn float-right btn-info">Petición</button>
                @elseif($pqr->type == 'NAGGING')
                    <button class="btn float-right btn-warning">Queja</button>
                @else
                    <button class="btn float-right btn-danger">Reclamo</button>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-primary">Titulo : </h3>
                        <h3>{{ $pqr->title }}</h3>
                    </div>
                    <div class="col-md-12">
                        <h3 class="text-primary">Detalle : </h3>
                        <p>{{ $pqr->description }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Usuario :</h6>
                </div>
                <div class="card-body">
                    <h3 class="text-primary">Nombre : </h3>
                    <a class="text-muted font-weight-bold" href="{{ route('students.show',$pqr->user) }}">
                        <h3>
                            {{ $pqr->user->name }}
                        </h3>
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
