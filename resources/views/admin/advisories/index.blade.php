@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">
        Estas son las asesorías  publicadas con estado publicado.
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary d-inline">Asesorías creadas  </h2>
            <a href="{{ route('advisory.create') }}" type="button" class="btn btn-primary float-right">
                Crear
            </a>
        </div>
        <div class="card-body">
            @if(isset($advisories))
                <div class="table-responsive">
                    <table class="table table-bordered" id="category_table" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titulo</th>
                            <th>Precio</th>
                            <th>Resumen</th>
                            <th>Fecha de entrega</th>
                            <th>Fecha de creación</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($advisories as $advisory)
                            <tr>
                                <td>{{ $advisory->id }}</td>
                                <td>{{ $advisory->title }}</td>
                                <td>{{ $advisory->price }}</td>
                                <td>{{ $advisory->excerpt }}</td>
                                <td>{{ $advisory->delivery }} </td>
                                <td>{{ $advisory->created_at->format('M d Y') }}</td>
                                <td>
                                    <a href="{{ route('advisory.show',$advisory) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a href="{{ route('advisory.edit',$advisory) }}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i>
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
                "order": [[ 0, "desc" ]],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json'
                }
            });
        });
    </script>
@endpush
