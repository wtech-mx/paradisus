@extends('layouts.app')

@section('template_title')
    Inv Bodega
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
                            <h3 class="mb-3">Inventario Bodega</h3>

                            @can('notas-pedido-create')
                            <a class="btn btn-sm btn-success" href="{{ route('notas_pedidos.create') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                <i class="fa fa-fw fa-edit"></i> Crear </a>
                            @endcan
                        </div>
                    </div>

                    @can('notas-pedido-list')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>Cantidad</th>
                                            <th>SKU</th>
                                            <th>Producto</th>
                                            <th>Fecha Edit</th>
                                        </tr>
                                    </thead>

                                        <tbody>
                                            @foreach ($productos as $producto)
                                                <tr>
                                                    @if ($producto->cantidad == 0)
                                                    <td>
                                                        <input type="text" class="form-control input-cantidad" style="color: #e30000;background-color: #e3000040;" data-id="{{ $producto->id }}" value="{{ $producto->cantidad }}">
                                                    </td>
                                                    @elseif ($producto->cantidad <= 2 && $producto->cantidad >= 0)
                                                    <td>
                                                        <input type="text" class="form-control input-cantidad" style="color: #c54003;background-color: #c764023b;" data-id="{{ $producto->id }}" value="{{ $producto->cantidad }}">
                                                    </td>
                                                    @else
                                                    <td>
                                                        <input type="text" class="form-control input-cantidad" style="color: #70b06a;background-color: #6ab06d61;" data-id="{{ $producto->id }}" value="{{ $producto->cantidad }}">
                                                    </td>
                                                    @endif
                                                    <td>
                                                        <a type="button" class="btn btn-primary btn-sm" href="{{route('productos.imprimir', $producto->id)}}">
                                                            {{ $producto->sku }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $producto->nombre }}</td>
                                                    <td>{{ $producto->updated_at }}</td>
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
