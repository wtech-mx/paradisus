<!-- Modal -->
<div class="modal fade" id="modal_terminos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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

                    <div class="col-12 ">
                        <label for="name">Nombre Manual *</label>
                        <div class="input-group mb-3">
                            <div class="form-check">
                                <input type="radio" id="cosme_no" name="cosme_manual" value="no" checked>
                                <label for="cosme_no">No</label>
                                <input type="radio" id="cosme_si" name="cosme_manual" value="si">
                                <label for="cosme_si">Sí</label>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="campo_cosmemanual" style="display: none;">
                        <div class="col-12 form-group">
                            <label for="name">Nombre Completo *</label>

                            <div class="input-group mb-3" >
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/icons/letter.png') }}" alt="" width="25px">
                                </span>
                                <input type="text" class="form-control" id="cosmemanual" name="cosmemanual">
                            </div>
                        </div>

                        <div class="col-12 form-group">
                            <label for="name">Telefono *</label>

                            <div class="input-group mb-3" >
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/icons/ring-phone.png') }}" alt="" width="25px">
                                </span>
                                <input type="numer" class="form-control" id="cosmemanual_tel" name="cosmemanual_tel">
                            </div>
                        </div>
                    </div>


                    <div class="col-12 form-group">
                        <label for="name">Texto *</label>
                        <textarea  id="mytextarea" name="descripcion"></textarea>

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
