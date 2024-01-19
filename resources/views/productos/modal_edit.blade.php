<!-- Modal -->
<div class="modal fade" id="EditProductsDataModal_{{ $producto->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditProductsDataModal_{{ $producto->id }}Label">Editar <strong>{{ $producto->nombre }}</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form method="POST" action="{{ route('productos.update', $producto->id) }}" id="miFormulario" enctype="multipart/form-data" role="form">
                @csrf

                <input type="hidden" name="_method" value="PATCH">

                <div class="modal-body row">

                    <div class="col-9 form-group">
                        <label for="name">Nombre *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/abc-block.png') }}" alt="" width="25px">
                            </span>
                            <input name="nombre" id="nombre" type="text" class="form-control" value="{{ $producto->nombre }}">
                        </div>
                    </div>

                    <div class="col-3 form-group">
                        <label for="name">Cantidad</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/hashtag.png') }}" alt="" width="25px">
                            </span>
                            <input name="cantidad" id="cantidad" type="number" class="form-control" value="{{ $producto->cantidad }}">
                        </div>
                    </div>

                    <div class="col-4 form-group">
                        <label for="name">Cabina 1</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/mascara-facial.png') }}" alt="" width="25px">
                            </span>
                            <select class="form-control" data-toggle="select" id="cabina1" name="cabina1" value="{{ $producto->cabina1 }}">
                                @if($producto->cabina1 == 1)
                                    <option selected value="1">Si</option>
                                @elseif($producto->cabina1 == NULL)
                                    <option selected value="">No</option>
                                @else
                                    <option selected value="">No</option>
                                @endif

                                <option value="">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-4 form-group">
                        <label for="name">Cabina 2</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/mascara-facial.png') }}" alt="" width="25px">
                            </span>
                            <select class="form-control" data-toggle="select" id="cabina2" name="cabina2" value="{{ $producto->cabina2 }}">

                                @if($producto->cabina2 == 1)
                                    <option selected value="1">Si</option>
                                @elseif($producto->cabina2 == NULL)
                                    <option selected value="">No</option>
                                @else
                                    <option selected value="">No</option>
                                @endif

                                <option value="">No</option>
                                <option value="1">Si</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-4 form-group">
                        <label for="name">Cabina 3</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/mascara-facial.png') }}" alt="" width="25px">
                            </span>
                            <select class="form-control" data-toggle="select" id="cabina3" name="cabina3" value="{{ $producto->cabina3 }}">

                                @if($producto->cabina3 == 1)
                                    <option selected value="1">Si</option>
                                @elseif($producto->cabina3 == NULL)
                                    <option selected value="">No</option>
                                @else
                                    <option selected value="">No</option>
                                @endif

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
                            <select class="form-control" data-toggle="select" id="cabina4" name="cabina4" value="{{ $producto->cabina4 }}">

                                @if($producto->cabina4 == 1)
                                    <option selected value="1">Si</option>
                                @elseif($producto->cabina4 == NULL)
                                    <option selected value="">No</option>
                                @else
                                    <option selected value="">No</option>
                                @endif

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
                            <select class="form-control" data-toggle="select" id="cabina5" name="cabina5" value="{{ $producto->cabina5 }}">

                                @if($producto->cabina5 == 1)
                                    <option selected value="1">Si</option>
                                @elseif($producto->cabina5 == NULL)
                                    <option selected value="">No</option>
                                @else
                                    <option selected value="">No</option>
                                @endif

                                <option >Selciona opcion</option>
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
