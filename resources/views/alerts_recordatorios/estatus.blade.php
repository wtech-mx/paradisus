<div class="modal fade" id="editEstatus{{$alerta->id}}" tabindex="-1" role="dialog" aria-labelledby="editClientModal{{$alerta->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataModalLabel">Cambiar estatus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form method="POST" action="{{ route('update_estatus.recordatorios', $alerta->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Estatus *</label>
                        <select class="form-control user" id="id_estatus" name="id_estatus" readonly>
                            <option value="2">Asiste</option>
                        </select>
                    </div>

                    <label for="">Descripcion</label>
                    <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="3"> {{$alerta->descripcion}} </textarea>

                    <div class="modal-footer">
                        <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Actualizar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
