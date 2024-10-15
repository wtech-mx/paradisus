<!-- Modal -->
<div class="modal fade" id="exampleModal_{{$notas->id }}" tabindex="-1" aria-labelledby="exampleModal_{{$notas->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModal_{{$notas->id }}Label">Editar Estatus #{{$notas->id }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form id="myFormEstatus" method="POST" action="{{ route('update_estatus.pedido',  $notas->id) }}" enctype="multipart/form-data" role="form">
            @csrf
            @method('PATCH')
            <!-- Método PATCH para la actualización -->

            <div class="modal-body">
                <div class="row">
                    <div class="form-group">
                        <label for="name">Estatus *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/change.png') }}" alt="" width="35px">
                            </span>
                            <select class="form-select d-inline-block" id="estatus_cotizacion" name="estatus_cotizacion">
                                    {{-- <option value="{{ $notas->estatus }}">{{ $notas->estatus }}</option> --}}
                                    <option value="Cancelada">Cancelar</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" id="submitButtonEstatus{{$notas->id }}" class="btn btn-success">
                    Actualizar
                    <span id="spinner{{$notas->id }}" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                </button>
            </div>
        </form>

      </div>
    </div>
  </div>
