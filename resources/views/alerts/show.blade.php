<!-- Modal -->

<div class="modal fade" id="showDataModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="showDataModal{{$item->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="showDataModalLabel">Editar Cosmes</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                <span aria-hidden="true">X</span>
            </button>
        </div>

        <div class="modal-body">
            <label for="">Cosmetologa(s)</label>
            <div class="row">
                @foreach($cosmes_alerts as $item2)
                    @if ($item2->id_alerta == $item->id)
                    <div class="col-6">
                        <input class="form-control" type="text" value="{{$item2->User->name}}" disabled >
                    </div>
                    @endif
                @endforeach
            </div>
            <label for="">Nota</label>
            <textarea class="form-control" cols="30" rows="2" disabled>{{$item->descripcion}}</textarea>
        </div>

        <div class="modal-body">
            <label for="">Selecionar Cosmetologa</label>
            <select class="form-control" id="id_especialist[]" name="id_especialist[]" multiple>
                    @foreach($cosme as $item2)
                        <option value="{{$item2->id}}">{{$item2->name}}</option>
                    @endforeach
            </select>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Cancelar</button>
            <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
        </div>
    </div>
</div>
</div>
