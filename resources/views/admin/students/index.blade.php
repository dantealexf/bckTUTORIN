@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">
        Estos son los diferentes estudiantes de la plataforma
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary d-inline">Estudiantes </h2>
            <a href="{{ route('students.create') }}" type="button" class="btn btn-primary float-right">
                Crear
            </a>
        </div>
        <div class="card-body">
            @if(isset($students))
                <div class="table-responsive">
                    <table class="table table-bordered" id="category_table" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Celular</th>
                            <th>Fecha de creación</th>
                            <th>Fecha de modificación</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->mobile }}</td>
                                <td>{{ $student->created_at->format('M d Y') }}</td>
                                <td>{{ $student->updated_at->format('M d Y') }} </td>
                                <td>
                                    <a href="{{ route('students.show',$student) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a href="{{ route('students.edit',$student) }}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    {{--<form method="POST"
                                          action="{{ route('students.destroy', $student) }}"
                                          style="display: inline">
                                        {{ csrf_field() }} {{ method_field('DELETE') }}
                                        <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Estás seguro de querer eliminar este estudiante?')"
                                        ><i class="fa fa-times"></i></button>
                                    </form>--}}
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
