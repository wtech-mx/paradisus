<!-- Modal -->
<div class="modal fade" id="showPropinaCosmes" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Propina</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form method="POST" action="{{ route('propina_store.propina') }}" id="miFormulario" enctype="multipart/form-data" role="form">
                @csrf

                <div class="modal-body row">

                    <div class="col-6">
                        <label for="total-suma">Seleccione Usuario</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/ama-de-casa.webp') }}" alt="" width="25px">
                            </span>
                            <select class="form-control " id="id_user_propina" name="id_user_propina" value="{{ old('id_user_propina') }}" required>
                                @foreach ($user_pagos as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="total-suma">Propina</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/cambio.png') }}" alt="" width="25px">
                            </span>
                            <input  id="propina" name="propina" type="number" class="form-control" >
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="total-suma">Metodo Pago</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/transferir.png') }}" alt="" width="25px">
                            </span>
                            <select id="forma_pago_propina" name="forma_pago_propina" class="form-control">
                                <option value="Efectivo">Efectivo</option>
                                <option value="Transferencia">Transferencia</option>
                                <option value="Mercado Pago">Mercado Pago</option>
                                <option value="Tarjeta">Tarjeta</option>
                                <option value="Gift Card">Gift Card</option>
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
