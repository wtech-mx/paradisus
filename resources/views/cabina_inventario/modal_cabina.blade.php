<!-- Modal -->
<div class="modal fade" id="cabinamodal" tabindex="-1" aria-labelledby="cabinamodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content ">

        <div class="modal-header">
          <h1 class="modal-title fs-5" id="cabinamodalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">

          <form  class="row" method="POST" action="{{ route('cabina_inventario.store') }}" enctype="multipart/form-data" role="form">
            @csrf
            <div class="form-group col-12">
                <label for="">Fecha</label>
                <input class="form-control" type="date" name="fecha" id="fecha" value="{{ $fechaActual }}" readonly>
            </div>

            <div class="form-group col-12">
                <label for="">Num de Cabina</label>
                <select class="form-select" name="num_cabina" id="num_cabina" readonly>
                    <option  {{ (Request::is('inventario/cabina1') ? 'selected ' : '') }} value="1">Cabina 1</option>
                    <option  {{ (Request::is('inventario/cabina2') ? 'selected ' : '') }} value="2">Cabina 2</option>
                    <option  {{ (Request::is('inventario/cabina3') ? 'selected ' : '') }} value="3">Cabina 3</option>
                    <option  {{ (Request::is('inventario/cabina4') ? 'selected ' : '') }} value="4">Cabina 4</option>
                    <option  {{ (Request::is('inventario/cabina5') ? 'selected ' : '') }} value="5">Cabina 5</option>
                </select>
            </div>

            <div class="form-group col-12">
                <label for="">Num de Semana</label>
                <select class="form-select" name="num_semana" id="num_semana">
                    <option value="semana_1">Semana 1</option>
                    <option value="semana_2">Semana 2</option>
                    <option value="semana_3">Semana 3</option>
                    <option value="semana_4">Semana 4</option>
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
                                    <label for="fecha">Cantidad</label>
                                    <input  id="cantidad[]" name="cantidad[]" type="number" class="form-control" value="1">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="num_sesion">estatus</label>
                                    <select class="form-select"  id="estatus[]" name="estatus[]">
                                        <option value="">Selecionar</option>
                                        <option value="Por Terminar">Por Terminar</option>
                                        <option value="Se cambio">Se cambio</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>

          </form>
        </div>
      </div>
    </div>
</div>

@section('datatable')

<script type="text/javascript">
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
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
