@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">
        Estas son las categorías registradas en el sistema
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary d-inline">Categorías</h2>
            <button id="new_category" type="button" class="btn btn-primary float-right">
                Crear
            </button>
        </div>
        <div class="card-body">
            @if(isset($categories))
                <div class="table-responsive">
                    <table class="table table-bordered" id="category_table" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Fecha de creación</th>
                            <th>Fecha de modificación</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->created_at->format('M d Y') }}</td>
                                <td>{{ $category->updated_at->format('M d Y') }} </td>
                                <td>
                                    <form method="POST"
                                          action="{{ route('category.destroy', $category) }}"
                                          style="display: inline">
                                        {{ csrf_field() }} {{ method_field('DELETE') }}
                                        <button class="btn btn-danger"
                                                onclick="return confirm('¿Estás seguro de querer eliminar esta categoria?')"
                                        ><i class="fa fa-times"></i></button>
                                    </form>

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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        $(function () {
            $("#category_table").DataTable({
                "order": [[ 0, "desc" ]],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json'
                }
            });
        });

        $("#new_category").click(function () {
            (async () => {
                const {value: name} = await Swal.fire({
                    title: 'Nueva categoría',
                    input: 'text',
                    showCancelButton: true,
                    inputValidator: (value) => {
                        if (!value) {
                            return '¡No se puede crear una categoría vacía!'
                        }
                    }
                });

                if (name) {
                    axios.post('category', {
                        name: name
                    }).then(response => {
                        Swal.fire(
                            '¡Completado!',
                            '¡Categoría creada!',
                            'success'
                        )
                        location.reload();
                    }).catch(function (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Algo malo sucedio al momento de crear',
                        })
                    })
                    ;
                }

            })()
        });
    </script>
@endpush
