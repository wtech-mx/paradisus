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
                        </div>
                    </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('productos.create_bodega') }}" enctype="multipart/form-data" role="form">
                                    @csrf
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                    <table class="table table-flush">
                                        <thead class="thead">
                                            <tr>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Comentario</th>
                                            </tr>
                                        </thead>

                                            <tbody>
                                                @foreach ($productos_bodega as $producto)
                                                    <tr>
                                                        <input type="number" class="form-control" id="id_producto[]" name="id_producto[]" value="{{ $producto->id }}" style="display: none">
                                                        <td>{{ $producto->nombre }}</td>
                                                        @if ($producto->cantidad == 0)
                                                        <td>
                                                            <input type="text" class="form-control" style="color: #e30000;background-color: #e3000040;" id="cantidad[]" name="cantidad[]" value="{{ $producto->cantidad }}">
                                                        </td>
                                                        @elseif ($producto->cantidad <= 2 && $producto->cantidad >= 0)
                                                        <td>
                                                            <input type="text" class="form-control" style="color: #c54003;background-color: #c764023b;" id="cantidad[]" name="cantidad[]" value="{{ $producto->cantidad }}">
                                                        </td>
                                                        @else
                                                        <td>
                                                            <input type="text" class="form-control" style="color: #70b06a;background-color: #6ab06d61;" id="cantidad[]" name="cantidad[]" value="{{ $producto->cantidad }}">
                                                        </td>
                                                        @endif
                                                        <td><textarea name="comentario[]" id="comentario[]" cols="50" rows="3"></textarea></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                    </table>
                                </form>
                            </div>
                        </div>
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
@endsection
