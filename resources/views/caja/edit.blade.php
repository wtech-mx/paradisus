<!-- Modal -->
<div class="modal fade" id="editDataModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Editar Retirar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form method="POST" action="{{ route('caja.update_caja', $item->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre">Monto</label>
                        <input name="egresos" id="egresos" type="number" class="form-control" value="{{ $item->egresos }}" required>
                    </div>

                    <div class="form-group">
                        <label for="descuento">Concepto</label>
                        <textarea name="concepto" id="concepto" cols="10" rows="3" class="form-control" required>{{ $item->concepto }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="nota">Foto</label>
                        <input type="file" id="foto" class="form-control" name="foto" value="{{ $item->foto }}">
                        @if ($item->foto == NULL)
                            <a href=""></a>
                        @else
                            <a target="_blank" href="{{asset('foto_retiros/'.$item->foto)}}">Abrir Imagen</a>
                        @endif
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Cancelar</button>
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
