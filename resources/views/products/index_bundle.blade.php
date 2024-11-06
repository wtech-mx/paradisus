@extends('layouts.app')

@section('template_title')
    Products
@endsection
@section('css')

@endsection
@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <a class="btn" id="regresar_btn" style="background: {{$configuracion->color_boton_close}}; color: #fff"><i class="fas fa-arrow-left"></i> Regresar </a>

                    <h3 class="mb-3">Paquetes/kits</h3>

                    <a type="button" class="btn btn-sm bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                        ¿Como fucniona?
                    </a>

                        <a href="{{ route('bundle.create') }}" class="btn btn-sm bg-gradient-primary"  style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                            <i class="fa fa-fw fa-edit"></i> Crear Paquete / Kit
                        </a>

                </div>
            </div>

            <div class="d-flex justify-content-around">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-kits-tab" data-bs-toggle="pill" data-bs-target="#pills-kits" type="button" role="tab" aria-controls="pills-kits" aria-selected="false" style="background: #86ff61a3">
                                Kits  <img src="{{ asset('assets/user/icons/productos.png') }}" alt="" width="35px">
                            </button>
                        </li>
                </ul>
            </div>

            <div class="table-responsive p-4" style="border:solid 5px #86ff61a3">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Nombre</th>
                            <th>Precio Normal</th>
                            <th>Categoria</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    @foreach ($productsKit as $product)
                    @php
                        $precio_rebajado = number_format($product->precio_rebajado, 0, '.', ',');
                        $precio_normal = number_format($product->precio_normal, 0, '.', ',');
                    @endphp
                    <tr id="productRow{{ $product->id }}">
                        <td>{{ $product->id }}</td>
                        <th>

                            @if ($product->imagenes == NULL)
                                <img id="blah" src="{{asset('cursos/no-image.jpg') }}" alt="Imagen" style="width: 50px; height: 50px;"/>
                            @else
                                <img id="blah" src="https://plataforma.imnasmexico.com/products/{{ $product->imagenes }}" alt="Imagen" style="width: 50px; height: 50px;"/>
                            @endif

                        </th>
                        <td>{{ $product->nombre }}</td>
                        <td>${{ $precio_normal }}</td>
                        <td>{{ $product->categoria }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>

                            <a class="btn btn-sm btn-primary" href="{{ route('bundle.edit', $product->id) }}">
                                <i class="fa fa-fw fa-edit"></i>
                            </a>

                            @can('productos-edit')
                                <form class="OcultarProductForm d-inline" data-id="{{ $product->id }}">
                                    @csrf
                                    <input type="hidden" name="_method" value="PATCH">
                                    <input type="hidden" name="categoria" value="Ocultar">

                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-fw fa-trash"></i>
                                    </button>
                                </form>

                            @endcan
                        </td>
                    </tr>
                    @endforeach

                </table>
            </div>


          </div>
        </div>
      </div>
</div>

@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        deferRender:true,
        paging: true,
        pageLength: 10
    });
</script>

<script>

    $(document).ready(function() {

      $(document).on('submit', '.OcultarProductForm', function(e) {
        e.preventDefault(); // Evitar el comportamiento predeterminado del formulario

        let productId = $(this).data('id'); // Obtener el ID del producto
        let form = $(this); // Referencia al formulario
        let url = "{{ route('products.update_ocultar', ':id') }}".replace(':id', productId); // Ruta con el ID del producto

        $.ajax({
                url: url,
                type: 'PATCH',
                data: form.serialize(), // Serializar los datos del formulario
                success: function(response) {
                // Si la respuesta es exitosa, elimina la fila del producto de la tabla
                $('#productRow' + response.id).fadeOut(300, function() {
                    $(this).remove(); // Eliminar la fila después de que desaparezca
                });

                // Opcional: Mostrar mensaje de éxito
                alert('Eliminado con exito');
                },
                error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Error:', error);
                }
            });
        });

    });


  </script>

@endsection
