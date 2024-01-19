@extends('layouts.app')

@section('template_title')
    Productos inventarios
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        @if(Session::has('message'))
                        <p>{{ Session::get('message') }}</p>
                        @endif

                        <div class="d-flex justify-content-between">
                            <h3 class="mb-3">Productos inventarios</h3>

                            @can('notas-pedido-create')
                            <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createDataModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                <i class="fa fa-fw fa-edit"></i> Crear </a>
                            @endcan
                        </div>
                    </div>
                    @include('productos.modal_crear')
                    @can('notas-pedido-list')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>¿Cabina?</th>
                                        </tr>
                                    </thead>

                                        <tbody>
                                            @foreach ($productos_inventarios as $producto)
                                                <tr>
                                                    <td>{{ $producto->nombre }}</td>
                                                    <td>
                                                        @if ($producto->cabinas == 1)
                                                            Si
                                                        @else
                                                            No
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                </table>
                            </div>
                        </div>
                    @endcan
                </div>

            </div>
        </div>
    </div>
@endsection

@section('datatable')
<script type="text/javascript">
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });

</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Usamos el elemento padre estático '.table-responsive' para delegar el evento
        $('.table-responsive').on('change', '.input-cantidad', function() {
            var id = $(this).data('id');
            var cantidad = $(this).val();

            $.ajax({
                url: '/actualizar-cantidad',
                method: 'POST',
                data: {
                    id: id,
                    cantidad: cantidad
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
    </script>


@endsection
