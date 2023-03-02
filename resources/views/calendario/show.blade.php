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
            <label for="">Selecionar Cosmetologa</label>
            <select class="form-control" id="id_especialist[]" name="id_especialist[]" multiple>
                    @foreach($cosme as $item2)
                        <option value="{{$item2->id}}" {{is_array($cosmes_alerts->id_especialist) && in_array($item2->id, $cosmes_alerts->id_especialist) ? 'selected' : ''}}>{{$item2->name}}</option>
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
