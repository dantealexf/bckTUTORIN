@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">
        Peticiones, quejas y relacmos de los clientes.
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary d-inline">PQR </h2>
        </div>
        <div class="card-body">
            @if(isset($pqrs))
                <div class="table-responsive">
                    <table class="table table-bordered" id="category_table" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titulo</th>
                            <th>Descripción</th>
                            <th>Tipo</th>
                            <th>Fecha de creación</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pqrs as $pqr)
                            <tr>
                                <td>{{ $pqr->id }}</td>
                                <td>{{ $pqr->title }}</td>
                                <td>{{ $pqr->description }}</td>
                                @if($pqr->type == 'REQUEST')
                                    <td>
                                        <button class="btn btn-sm btn-info">Petición</button>
                                    </td>
                                @elseif($pqr->type == 'NAGGING')
                                    <td>
                                        <button class="btn btn-sm btn-warning">Queja</button>
                                    </td>
                                @else
                                    <td>
                                        <button class="btn btn-sm btn-danger">Reclamo</button>
                                    </td>
                                @endif
                                <td>{{ $pqr->created_at->format('M d Y') }}</td>
                                <td>
                                    <a href="{{ route('pqr.show',$pqr) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function () {
            $("#category_table").DataTable({
                "order": [[0, "desc"]],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json'
                }
            });
        });
    </script>
@endpush
