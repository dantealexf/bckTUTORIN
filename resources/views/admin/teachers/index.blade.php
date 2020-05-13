@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">
        Estos son los diferentes estudiantes de la plataforma
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary d-inline">Tutores </h2>
        </div>
        <div class="card-body">
            @if(isset($profiles))
                <div class="table-responsive">
                    <table class="table table-bordered" id="category_table" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Estado</th>
                            <th>Celular</th>
                            <th>Fecha de creación</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($profiles as $profile)
                            <tr>
                                <td>{{ $profile->user->id }}</td>
                                <td>{{ $profile->user->name }}</td>
                                <td>{{ $profile->user->email }}</td>
                                <td>
                                @if($profile->verified)
                                    <button class="btn btn-sm btn-success"><i class="fa fa-check"></i></button>
                                @elseif($profile->request)
                                        <button class="btn btn-sm btn-warning"><i class="fa fa-exclamation"></i></button>
                                @endif
                                </td>
                                <td>{{ $profile->user->mobile }}</td>
                                <td>{{ $profile->user->created_at->format('M d Y') }}</td>
                                <td>
                                    <a href="{{ route('teachers.show',$profile->user) }}" class="btn btn-sm btn-info">
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
                "order": [[ 0, "desc" ]],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json'
                }
            });
        });
    </script>
@endpush
