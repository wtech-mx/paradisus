<!-- Modal -->
<div class="modal fade" id="createDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Productos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form method="POST" action="{{ route('productos.store') }}" id="miFormulario" enctype="multipart/form-data" role="form">
                @csrf

                <div class="modal-body row">

                    <div class="col-9 form-group">
                        <label for="name">Nombre *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/abc-block.png') }}" alt="" width="25px">
                            </span>
                            <input name="nombre" id="nombre" type="text" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-3 form-group">
                        <label for="name">Cantidad</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/hashtag.png') }}" alt="" width="25px">
                            </span>
                            <input name="cantidad" id="cantidad" type="number" class="form-control" >
                        </div>
                    </div>

                    <div class="col-4 form-group">
                        <label for="name">Cabina 1</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/mascara-facial.png') }}" alt="" width="25px">
                            </span>
                            <select class="form-control" data-toggle="select" id="cabina1" name="cabina1" >
                                <option value="">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                    </div>

                    {{-- <div class="col-4 form-group">
                        <label for="name">Cabina 2</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/mascara-facial.png') }}" alt="" width="25px">
                            </span>
                            <select class="form-control" data-toggle="select" id="cabina2" name="cabina2" >
                                <option value="">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                    </div> --}}

                    <div class="col-4 form-group">
                        <label for="name">Cabina 3</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/mascara-facial.png') }}" alt="" width="25px">
                            </span>
                            <select class="form-control" data-toggle="select" id="cabina3" name="cabina3" >
                                <option value="">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-4 form-group">
                        <label for="name">Cabina 4</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/mascara-facial.png') }}" alt="" width="25px">
                            </span>
                            <select class="form-control" data-toggle="select" id="cabina4" name="cabina4" >
                                <option value="">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-4 form-group">
                        <label for="name">Cabina 5</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/mascara-facial.png') }}" alt="" width="25px">
                            </span>
                            <select class="form-control" data-toggle="select" id="cabina5" name="cabina5" >
                                <option value="">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
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
