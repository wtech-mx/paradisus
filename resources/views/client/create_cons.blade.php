<div class="modal fade" id="exampleModalCons" tabindex="-1" role="dialog" aria-labelledby="exampleModalCons" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear consentimiento</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <form method="POST" action="{{ route('clients_consentimiento.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body">
                    <h3 class="mb-3">Crear Consentimiento</h3>
                    <div class="row">
                        <div class="col-12">
                            <label for="precio">Cliente</label><br>
                            <button class="btn btn-success btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Agregar <img src="{{ asset('assets/icons/cliente.png') }}" alt="" width="25px">
                            </button>
                            <select class="form-control cliente"  data-toggle="select" id="id_client" name="id_client">
                                <option value="">- - - Seleccionar un cliente - - -</option>
                                @foreach ($clients as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }} - {{ $item->phone }}</option>
                                @endforeach
                            </select>
                        </div>
                                <div class="collapse" id="collapseExample">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="name">Nombre(s) *</label>
                                                <input  id="name" name="name" type="text" class="form-control" placeholder="Nombre">
                                        </div>

                                        <div class="col-12">
                                            <label for="name">Apellido(s) *</label>
                                                <input  id="last_name" name="last_name" type="text" class="form-control" placeholder="Apellidos">
                                        </div>

                                        <div class="col-12">
                                            <label for="name">Telefono *</label>
                                                <input  id="phone" name="phone" type="text" class="form-control" type="tel" minlength="10" maxlength="10" placeholder="555555555">
                                        </div>
                                    </div>
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
    </div>
</div>
