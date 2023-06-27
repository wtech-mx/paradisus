@extends('layouts.app')

@section('template_title')
   Editar Inventario
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h3 class="mb-3">Editar Inventario</h3>

                            <a class="btn"  href="{{ route('inventario.index1') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
                                Regresar
                            </a>

                        </div>
                    </div>


                        <div class="form-group col-6">
                            <label for="">Num de Cabina</label>
                            <input class="form-control" type="text" name="cabina" id="cabina" value="{{$product_inv->CabinaInvetario->num_cabina}}" readonly>
                        </div>

                        <ul class="nav nav-pills nav-fill p-1" id="pills-tab" role="tablist">
                            @for ($semana = 1; $semana <= $contadorMiercoles; $semana++)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ $semana === 5 ? 'disabled' : '' }}" data-bs-toggle="tab" href="#semana{{ $semana }}" role="tab" aria-controls="pills-home" aria-selected="true" id="pills-home-tab">
                                        <i class="ni ni-folder-17 text-sm me-2"></i> Semana {{ $semana }}
                                    </a>
                                </li>
                            @endfor

                        </ul>

                        <form method="POST" action="{{ route('cabina1.update_cabina1', $product_inv->CabinaInvetario->id ) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                                <div class="tab-content" id="pills-tabContent">

                                        <div class="tab-pane fade show active" id="semana1">
                                            <div class="row">
                                                <input class="form-control" type="hidden" name="cabina" id="cabina" value="{{$product_inv->CabinaInvetario->num_cabina}}">
                                                <input class="form-control" type="hidden" name="num_semana" id="num_semana" value="1">

                                                <div class="form-group col-6">
                                                    <label for="">Fecha</label>
                                                    <input class="form-control" type="date" name="fecha1" id="fecha1" value="{{$product_inv->CabinaInvetario->fecha}}" readonly>
                                                </div>

                                                <div class="form-group col-12">
                                                    @foreach ($products_invs as $productoInventario)
                                                        @if ($productoInventario->num_semana == '1')
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="producto[]">producto</label><br>
                                                                        <select class="form-select" id="producto[]" name="producto[]">
                                                                            <option value="">Seleciona el producto</option>

                                                                            @foreach ($productos as $producto)
                                                                                <option value="{{ $producto->id }}" @if ($producto->id == $productoInventario->id_producto) selected @endif>{{ $producto->nombre }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="cantidad[]">Cantidad</label>
                                                                        <input id="cantidad[]" name="cantidad[]" type="number" class="form-control" value="{{ $productoInventario->cantidad }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="estatus[]">estatus</label>
                                                                        <select class="form-select" id="estatus[]" name="estatus[]">
                                                                            <option value="">Selecionar</option>
                                                                            <option value="Por Terminar" @if ($productoInventario->estatus == "Por Terminar") selected @endif>Por Terminar</option>
                                                                            <option value="Se cambio" @if ($productoInventario->estatus == "Se cambio") selected @endif>Se cambio</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>

                                                <div class="form-group col-12">
                                                    <div id="formulario" class="mt-4">

                                                        <button type="button" class="clonar btn btn-secondary btn-sm">Agregar</button>
                                                        <div class="clonars">
                                                            <div class="row">

                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="descripcion">producto</label><br>
                                                                        <select class="form-select"  id="producto[]" name="producto[]">
                                                                            <option value="">Seleciona el producto</option>
                                                                            @foreach ($productos as $producto)
                                                                            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="fecha">Cantidad</label>
                                                                        <input  id="cantidad[]" name="cantidad[]" type="number" class="form-control" value="1">
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="num_sesion">estatus</label>
                                                                        <select class="form-select"  id="estatus[]" name="estatus[]">
                                                                            <option value="">Selecionar</option>
                                                                            <option value="Por Terminar">Por Terminar</option>
                                                                            <option value="Se cambio">Se cambio</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="num_sesion">-</label><br>
                                                                        <button type="button" class="eliminar btn btn-danger btn-sm">Eliminar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="semana2">
                                            <div class="row">
                                                <input class="form-control" type="hidden" name="num_semana2" id="num_semana2" value="2">

                                                <div class="form-group col-6">
                                                    <label for="">Fecha</label>
                                                    <input class="form-control" type="date" name="fecha2" id="fecha2" value="{{$product_inv->CabinaInvetario->fecha}}" readonly>
                                                </div>

                                                <div class="form-group col-12">
                                                    @foreach ($products_invs as $productoInventario)
                                                        @if ($productoInventario->num_semana == '2')
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="producto[]">producto</label><br>
                                                                        <select class="form-select" id="producto[]" name="producto[]">
                                                                            <option value="">Seleciona el producto</option>

                                                                            @foreach ($productos as $producto)
                                                                                <option value="{{ $producto->id }}" @if ($producto->id == $productoInventario->id_producto) selected @endif>{{ $producto->nombre }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="cantidad[]">Cantidad</label>
                                                                        <input id="cantidad[]" name="cantidad[]" type="number" class="form-control" value="{{ $productoInventario->cantidad }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="estatus[]">estatus</label>
                                                                        <select class="form-select" id="estatus[]" name="estatus[]">
                                                                            <option value="">Selecionar</option>
                                                                            <option value="Por Terminar" @if ($productoInventario->estatus == "Por Terminar") selected @endif>Por Terminar</option>
                                                                            <option value="Se cambio" @if ($productoInventario->estatus == "Se cambio") selected @endif>Se cambio</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>

                                                <div class="form-group col-12">
                                                    <div id="formulario2" class="mt-4">

                                                        <button type="button" class="clonar2 btn btn-secondary btn-sm">Agregar</button>
                                                        <div class="clonars2">
                                                            <div class="row">

                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="descripcion">producto</label><br>
                                                                        <select class="form-select"  id="producto2[]" name="producto2[]">
                                                                            <option value="">Seleciona el producto</option>
                                                                            @foreach ($productos as $producto)
                                                                            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="fecha">Cantidad</label>
                                                                        <input  id="cantidad2[]" name="cantidad2[]" type="number" class="form-control" value="1">
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="num_sesion">estatus</label>
                                                                        <select class="form-select"  id="estatus2[]" name="estatus2[]">
                                                                            <option value="">Selecionar</option>
                                                                            <option value="Por Terminar">Por Terminar</option>
                                                                            <option value="Se cambio">Se cambio</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="num_sesion">-</label><br>
                                                                        <button type="button" class="eliminar2 btn btn-danger btn-sm">Eliminar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                </div>

                                <button type="submit" class="btn" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
                                    Guardar
                                </button>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('datatable')
<script type="text/javascript">
    $('#formulario').on('click', '.eliminar', function() {
        // Obtener el contenedor del conjunto a eliminar
        var $contenedor = $(this).closest('.clonars');

        // Eliminar el conjunto
        $contenedor.remove();
    });

    // ============= Agregar mas inputs dinamicamente =============
    $('.clonar').click(function() {
      // Clona el .input-group
      var $clone = $('#formulario .clonars').last().clone();

      // Borra los valores de los inputs clonados
      $clone.find(':input').each(function () {
        if ($(this).is('select')) {
          this.selectedIndex = 0;
        } else {
          this.value = '';
        }
      });

      // Agrega lo clonado al final del #formulario
      $clone.appendTo('#formulario');
    });




    $('#formulario2').on('click', '.eliminar2', function() {
        // Obtener el contenedor del conjunto a eliminar
        var $contenedor2 = $(this).closest('.clonars2');

        // Eliminar el conjunto
        $contenedor2.remove();
    });

    // ============= Agregar mas inputs dinamicamente =============
    $('.clonar2').click(function() {
      // Clona el .input-group
      var $clone2 = $('#formulario2 .clonars2').last().clone();

      // Borra los valores de los inputs clonados
      $clone2.find(':input').each(function () {
        if ($(this).is('select')) {
          this.selectedIndex = 0;
        } else {
          this.value = '';
        }
      });


      // Agrega lo clonado al final del #formulario
      $clone2.appendTo('#formulario2');
    });
</script>
@endsection
