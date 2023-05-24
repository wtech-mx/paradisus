<!-- Modal -->
<div class="modal fade" id="modalCons" tabindex="-1" role="dialog" aria-labelledby="modalCons" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear Consentimiento</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>

            <form method="POST" action="{{ route('clients_consentimiento.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-5">
                            <label for="precio">Cliente</label><br>
                            <select class="form-control cliente"  data-toggle="select" id="id_client" name="id_client">
                                <option>Seleccionar cliente</option>
                                @foreach ($clients as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="precio">Consentimiento</label><br>
                            <select class="form-control " id="consentimiento" name="consentimiento">
                                    <option value="1">Facial / Corporal</option>
                                    <option value="2">Brow bar</option>
                                    <option value="3">LASH LIFTING</option>
                            </select>
                        </div>
                        <div class="col-3">
                                <label for="num"># personas</label><br>
                                <input id="num_personas" name="num_personas" type="number" class="form-control" >
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-3">
                        <label for="num"></label><br>
                        <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
