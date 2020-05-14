@extends('layouts.login')

@section('content')
    <div class="text-center">
        <div class="error mx-auto" data-text="404">404</div>
        <p class="lead text-gray-800 mb-5">Pagina no encontrada </p>
        <p class="text-gray-500 mb-0">La ruta que está buscando no existe </p>
        <a href="{{ route('inicio') }}">&larr; Regresar al inicio</a>
    </div>
@endsection
