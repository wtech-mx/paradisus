<!-- Modal -->
<div class="modal fade" id="modal_terminos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear Terminos</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                    <form action="{{ route('terminos.store') }}" class="row" method="POST">
                        @csrf
                        <div class="col-12 form-group">
                            <label for="name">Titulo *</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/icons/letter.png') }}" alt="" width="25px">
                                </span>
                                <input type="text" class="form-control" id="" name="titulo">

                            </div>
                        </div>

                        <div class="col-12 form-group">
                            <label for="name">Cosme / Administracion *</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/icons/mujer.png') }}" alt="" width="25px">
                                </span>
                                <select class="form-control" data-toggle="select" id="" name="id_user">
                                    <option value="">Seleccionar</option>
                                    @foreach ($user as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 form-group">
                            <label for="name">Texto *</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/icons/retiro-de-efectivo.png') }}" alt="" width="25px">
                                </span>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="descripcion"></textarea>

                            </div>
                        </div>

                        <div class="col-6 form-group">
                            <label for="name">Monto *</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                                </span>
                                <input type="number" class="form-control" id="" name="monto">
                            </div>
                        </div>

                        <div class="col-6 form-group">
                            <label for="name">Fecha *</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/icons/calenda.png') }}" alt="" width="25px">
                                </span>
                                <input type="date" class="form-control" id="" name="fecha">
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <button type="submit" class="btn btn-primary">Guardar Registro</button>
                        </div>

                    </form>
            </div>

        </div>
    </div>
</div>
