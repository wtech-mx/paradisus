<div id="form-container" id="form-container" id="form-container" style="position: fixed; top: 0; right: 0; width: 300px; height: 100%; background-color: white; display: none;padding-top: 100px; padding-right: 20px; padding-left: 20px;box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);">

            <form method="POST" action="{{ route('clients_consentimiento.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body">
                    <h3 class="mb-3">Crear Consentimiento</h3>
                    <div class="row">
                        <div class="col-12">
                            <label for="precio">Cliente</label><br>
                            <select class="form-control cliente"  data-toggle="select" id="id_client" name="id_client">
                                <option>- - - Seleccionar un cliente - - -</option>
                                @foreach ($clients as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="precio">Consentimiento</label><br>
                            <select class="form-control " id="consentimiento" name="consentimiento">
                                    <option value="1">Facial / Corporal</option>
                                    <option value="2">Brow bar</option>
                                    <option value="3">LASH LIFTING</option>
                                    <option value="4">Jacuzzi</option>
                            </select>
                        </div>
                        <div class="col-12">
                                <label for="num"># personas</label><br>
                                <input id="num_personas" name="num_personas" type="number" class="form-control" >
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="num"></label><br>
                        <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                    </div>
                </div>
            </form>
</div>
