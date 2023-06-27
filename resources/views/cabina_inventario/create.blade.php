@extends('layouts.app')

@section('template_title')
   Crear Inventario
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h3 class="mb-3">Crear Inventario</h3>

                            <a class="btn"  href="{{ route('inventario.index1') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
                                Regresar
                            </a>

                        </div>
                    </div>


                        <div class="form-group col-6">
                            <label for="">Num de Cabina</label>
                            <input class="form-control" type="text" name="cabina" id="cabina" value="Cabina 1" readonly>
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

                        <form method="POST" action="{{ route('cabina_inventario.store') }}" enctype="multipart/form-data" role="form">
                            @csrf
                                <div class="tab-content" id="pills-tabContent">

                                        <div class="tab-pane fade show active" id="semana1">
                                            <div class="row">
                                                <input class="form-control" type="hidden" name="cabina" id="cabina" value="Cabina 1">
                                                <input class="form-control" type="hidden" name="num_semana" id="num_semana" value="1">
                                                
                                                <div class="form-group col-6">
                                                    <label for="">Fecha</label>
                                                    <input class="form-control" type="date" name="fecha1" id="fecha1" value="{{ $fechaActual }}" readonly>
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
                                                <h1>Hola</h1>
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
</script>
@endsection
