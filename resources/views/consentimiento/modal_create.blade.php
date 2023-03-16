<!-- Modal -->
<div class="modal fade" id="exampleModalConsentimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalConsentimiento" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear Cliente</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <form method="POST" action="{{ route('clients_consentimiento.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="precio">Cliente</label><br>
                        <select class="form-control cliente"  data-toggle="select" id="id_client" name="id_client" value="{{ old('id_client') }}">
                            <option>Seleccionar cliente</option>
                            @foreach ($clients as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="num">Numero de personas</label>
                        <input id="num_personas" name="num_personas" type="number" class="form-control" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Cancelar</button>
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
