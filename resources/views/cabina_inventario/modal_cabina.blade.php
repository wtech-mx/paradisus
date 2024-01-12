<!-- Modal -->
<div class="modal fade" id="cabinamodal" tabindex="-1" aria-labelledby="cabinamodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog modal-xl">
      <div class="modal-content ">

        <div class="modal-header">
          <h1 class="modal-title fs-5" id="cabinamodalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <ul class="nav nav-pills nav-fill p-1" id="pills-tab" role="tablist">
                @for ($semana = 1; $semana <= $contadorMiercoles; $semana++)
                    <li class="nav-item" role="presentation">
                        <a class="nav-link {{ $semana === 5 ? 'disabled' : '' }}" data-bs-toggle="tab" href="#semana{{ $semana }}" role="tab" aria-controls="pills-home" aria-selected="true" id="pills-home-tab">
                            <i class="ni ni-folder-17 text-sm me-2"></i> Semana {{ $semana }}
                        </a>
                    </li>
                @endfor
            </ul>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="semana1" role="tabpanel" aria-labelledby="pills-semana1-tab" tabindex="0">
                    <form method="POST" action="{{ route('cabina_inventario.store') }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="">Fecha</label>
                                <input class="form-control" type="date" name="fecha1" id="fecha1" value="{{ $fechaActual }}" readonly>
                            </div>

                            <div class="form-group col-4">
                                <label for="">Num semana</label>
                                <input class="form-control" type="text" name="num_semana" id="num_semana" value="1" readonly>
                            </div>

                            <div class="form-group col-4">
                                <label for="">Num de Cabina</label>
                                <select class="form-select" name="cabina" id="cabina" readonly>
                                    <option  {{ (Request::is('inventario/cabina1') ? 'selected ' : '') }} value="1">Cabina 1</option>
                                    <option  {{ (Request::is('inventario/cabina2') ? 'selected ' : '') }} value="2">Cabina 2</option>
                                    <option  {{ (Request::is('inventario/cabina3') ? 'selected ' : '') }} value="3">Cabina 3</option>
                                    <option  {{ (Request::is('inventario/cabina4') ? 'selected ' : '') }} value="4">Cabina 4</option>
                                    <option  {{ (Request::is('inventario/cabina5') ? 'selected ' : '') }} value="5">Cabina 5</option>
                                </select>
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

                            <div>
                                {{-- <h4>Insumos extras</h4>
                                <div class="form-group col-12">
                                    <div id="formulario6" class="mt-4">

                                        <button type="button" class="clonar6 btn btn-secondary btn-sm">Agregar</button>
                                        <div class="clonars6">
                                            <div class="row">

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="descripcion">producto</label><br>
                                                        <select class="form-select"  id="producto_extra[]" name="producto_extra[]">
                                                            <option value="">Seleciona el producto</option>
                                                            @foreach ($productos as $producto)
                                                            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label for="cantidad[]">Cantidad</label>
                                                        <input id="cantidad_extra[]" name="cantidad_extra[]" type="number" class="form-control" value="1">
                                                    </div>
                                                </div>
                                                <input id="extra" name="extra" type="hidden" class="form-control" value="1">
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label for="num_sesion">-</label><br>
                                                        <button type="button" class="eliminar6 btn btn-danger btn-sm">Eliminar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="semana2" role="tabpanel" aria-labelledby="pills-semana2-tab" tabindex="0">
                    <form method="POST" action="{{ route('cabina_inventario.store') }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="">Fecha</label>
                                <input class="form-control" type="date" name="fecha1" id="fecha1" value="{{ $fechaActual }}" readonly>
                            </div>

                            <div class="form-group col-4">
                                <label for="">Num semana</label>
                                <input class="form-control" type="text" name="num_semana" id="num_semana" value="2" readonly>
                            </div>

                            <div class="form-group col-4">
                                <label for="">Num de Cabina</label>
                                <select class="form-select" name="cabina" id="cabina" readonly>
                                    <option  {{ (Request::is('inventario/cabina1') ? 'selected ' : '') }} value="1">Cabina 1</option>
                                    <option  {{ (Request::is('inventario/cabina2') ? 'selected ' : '') }} value="2">Cabina 2</option>
                                    <option  {{ (Request::is('inventario/cabina3') ? 'selected ' : '') }} value="3">Cabina 3</option>
                                    <option  {{ (Request::is('inventario/cabina4') ? 'selected ' : '') }} value="4">Cabina 4</option>
                                    <option  {{ (Request::is('inventario/cabina5') ? 'selected ' : '') }} value="5">Cabina 5</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <div id="formulario2" class="mt-4">

                                    <button type="button" class="clonar2 btn btn-secondary btn-sm">Agregar</button>
                                    <div class="clonars2">
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
                                                    <button type="button" class="eliminar2 btn btn-danger btn-sm">Eliminar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="semana3" role="tabpanel" aria-labelledby="pills-semana3-tab" tabindex="0">
                    <form method="POST" action="{{ route('cabina_inventario.store') }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="">Fecha</label>
                                <input class="form-control" type="date" name="fecha1" id="fecha1" value="{{ $fechaActual }}" readonly>
                            </div>

                            <div class="form-group col-4">
                                <label for="">Num semana</label>
                                <input class="form-control" type="text" name="num_semana" id="num_semana" value="3" readonly>
                            </div>

                            <div class="form-group col-4">
                                <label for="">Num de Cabina</label>
                                <select class="form-select" name="cabina" id="cabina" readonly>
                                    <option  {{ (Request::is('inventario/cabina1') ? 'selected ' : '') }} value="1">Cabina 1</option>
                                    <option  {{ (Request::is('inventario/cabina2') ? 'selected ' : '') }} value="2">Cabina 2</option>
                                    <option  {{ (Request::is('inventario/cabina3') ? 'selected ' : '') }} value="3">Cabina 3</option>
                                    <option  {{ (Request::is('inventario/cabina4') ? 'selected ' : '') }} value="4">Cabina 4</option>
                                    <option  {{ (Request::is('inventario/cabina5') ? 'selected ' : '') }} value="5">Cabina 5</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <div id="formulario3" class="mt-4">

                                    <button type="button" class="clonar3 btn btn-secondary btn-sm">Agregar</button>
                                    <div class="clonars3">
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
                                                    <button type="button" class="eliminar3 btn btn-danger btn-sm">Eliminar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="semana4" role="tabpanel" aria-labelledby="pills-semana4-tab" tabindex="0">
                    <form method="POST" action="{{ route('cabina_inventario.store') }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="">Fecha</label>
                                <input class="form-control" type="date" name="fecha1" id="fecha1" value="{{ $fechaActual }}" readonly>
                            </div>

                            <div class="form-group col-4">
                                <label for="">Num semana</label>
                                <input class="form-control" type="text" name="num_semana" id="num_semana" value="4" readonly>
                            </div>

                            <div class="form-group col-4">
                                <label for="">Num de Cabina</label>
                                <select class="form-select" name="cabina" id="cabina" readonly>
                                    <option  {{ (Request::is('inventario/cabina1') ? 'selected ' : '') }} value="1">Cabina 1</option>
                                    <option  {{ (Request::is('inventario/cabina2') ? 'selected ' : '') }} value="2">Cabina 2</option>
                                    <option  {{ (Request::is('inventario/cabina3') ? 'selected ' : '') }} value="3">Cabina 3</option>
                                    <option  {{ (Request::is('inventario/cabina4') ? 'selected ' : '') }} value="4">Cabina 4</option>
                                    <option  {{ (Request::is('inventario/cabina5') ? 'selected ' : '') }} value="5">Cabina 5</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <div id="formulario4" class="mt-4">

                                    <button type="button" class="clonar4 btn btn-secondary btn-sm">Agregar</button>
                                    <div class="clonars4">
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
                                                    <button type="button" class="eliminar4 btn btn-danger btn-sm">Eliminar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="semana5" role="tabpanel" aria-labelledby="pills-semana5-tab" tabindex="0">
                    <form method="POST" action="{{ route('cabina_inventario.store') }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="">Fecha</label>
                                <input class="form-control" type="date" name="fecha1" id="fecha1" value="{{ $fechaActual }}" readonly>
                            </div>

                            <div class="form-group col-4">
                                <label for="">Num semana</label>
                                <input class="form-control" type="text" name="num_semana" id="num_semana" value="5" readonly>
                            </div>

                            <div class="form-group col-4">
                                <label for="">Num de Cabina</label>
                                <select class="form-select" name="cabina" id="cabina" readonly>
                                    <option  {{ (Request::is('inventario/cabina1') ? 'selected ' : '') }} value="1">Cabina 1</option>
                                    <option  {{ (Request::is('inventario/cabina2') ? 'selected ' : '') }} value="2">Cabina 2</option>
                                    <option  {{ (Request::is('inventario/cabina3') ? 'selected ' : '') }} value="3">Cabina 3</option>
                                    <option  {{ (Request::is('inventario/cabina4') ? 'selected ' : '') }} value="4">Cabina 4</option>
                                    <option  {{ (Request::is('inventario/cabina5') ? 'selected ' : '') }} value="5">Cabina 5</option>
                                </select>
                            </div>

                            <div class="form-group col-12">
                                <div id="formulario5" class="mt-4">

                                    <button type="button" class="clonar btn btn-secondary btn-sm">Agregar</button>
                                    <div class="clonars5">
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
                                                    <button type="button" class="eliminar5 btn btn-danger btn-sm">Eliminar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>


@section('datatable')

<script type="text/javascript">
    $('#formulario').on('click', '.eliminar', function() {
        // Obtener el contenedor del conjunto a eliminar
        var $contenedor = $(this).closest('.clonars');

        // Eliminar el conjunto
        $contenedor.remove();
    });

    $('#formulario2').on('click', '.eliminar2', function() {
        // Obtener el contenedor del conjunto a eliminar
        var $contenedor = $(this).closest('.clonars2');

        // Eliminar el conjunto
        $contenedor.remove();
    });

    $('#formulario3').on('click', '.eliminar3', function() {
        // Obtener el contenedor del conjunto a eliminar
        var $contenedor = $(this).closest('.clonars3');

        // Eliminar el conjunto
        $contenedor.remove();
    });

    $('#formulario4').on('click', '.eliminar4', function() {
        // Obtener el contenedor del conjunto a eliminar
        var $contenedor = $(this).closest('.clonars4');

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

    // ============= Agregar mas inputs dinamicamente =============
    $('.clonar2').click(function() {
      // Clona el .input-group
      var $clone = $('#formulario2 .clonars2').last().clone();

      // Borra los valores de los inputs clonados
      $clone.find(':input').each(function () {
        if ($(this).is('select')) {
          this.selectedIndex = 0;
        } else {
          this.value = '';
        }
      });

      // Agrega lo clonado al final del #formulario
      $clone.appendTo('#formulario2');
    });

    // ============= Agregar mas inputs dinamicamente =============
    $('.clonar3').click(function() {
      // Clona el .input-group
      var $clone = $('#formulario3 .clonars3').last().clone();

      // Borra los valores de los inputs clonados
      $clone.find(':input').each(function () {
        if ($(this).is('select')) {
          this.selectedIndex = 0;
        } else {
          this.value = '';
        }
      });

      // Agrega lo clonado al final del #formulario
      $clone.appendTo('#formulario3');
    });

        // ============= Agregar mas inputs dinamicamente =============
        $('.clonar4').click(function() {
      // Clona el .input-group
      var $clone = $('#formulario4 .clonars4').last().clone();

      // Borra los valores de los inputs clonados
      $clone.find(':input').each(function () {
        if ($(this).is('select')) {
          this.selectedIndex = 0;
        } else {
          this.value = '';
        }
      });

      // Agrega lo clonado al final del #formulario
      $clone.appendTo('#formulario4');
    });

    $('#formulario6').on('click', '.eliminar6', function() {
        // Obtener el contenedor del conjunto a eliminar
        var $contenedor6 = $(this).closest('.clonars6');

        // Eliminar el conjunto
        $contenedor6.remove();
    });

    // ============= Agregar mas inputs dinamicamente =============
    $('.clonar6').click(function() {
      // Clona el .input-group
      var $clone6 = $('#formulario6 .clonars6').last().clone();

      // Borra los valores de los inputs clonados
      $clone6.find(':input').each(function () {
        if ($(this).is('select')) {
          this.selectedIndex = 0;
        } else {
          this.value = '';
        }
      });

      // Agrega lo clonado al final del #formulario
      $clone6.appendTo('#formulario6');
    });
</script>

@endsection
