@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">
        Estas son las zonas registradas en el sistema
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary d-inline">Zonas</h2>
            <button id="new_zone" type="button" class="btn btn-primary float-right">
                Crear
            </button>
        </div>
        <div class="card-body">
            @if(isset($zones))
                <div class="table-responsive">
                    <table class="table table-bordered" id="zone_table" width="100%" cellspacing="0">
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
                        @foreach($zones as $zone)
                            <tr>
                                <td>{{ $zone->id }}</td>
                                <td>{{ $zone->name }}</td>
                                <td>{{ $zone->created_at->format('M d Y') }}</td>
                                <td>{{ $zone->updated_at->format('M d Y') }} </td>
                                <td>
                                    <form method="POST"
                                          action="{{ route('zone.destroy', $zone) }}"
                                          style="display: inline">
                                        {{ csrf_field() }} {{ method_field('DELETE') }}
                                        <button class="btn btn-danger"
                                                onclick="return confirm('¿Estás seguro de querer eliminar esta zona?')"
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
            $("#zone_table").DataTable({
                "order": [[ 0, "desc" ]],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json'
                }
            });
        });

        $("#new_zone").click(function () {
            (async () => {
                const {value: name} = await Swal.fire({
                    title: 'Nueva zona',
                    input: 'text',
                    showCancelButton: true,
                    inputValidator: (value) => {
                        if (!value) {
                            return '¡No se puede crear una zona vacía!'
                        }
                    }
                });

                if (name) {
                    axios.post('zone', {
                        name: name
                    }).then(response => {
                        Swal.fire(
                            '¡Completado!',
                            '¡Zona creada!',
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
