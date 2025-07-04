<!-- Modal -->
 <div class="modal fade" id="createDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Retirar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form method="POST" action="{{ route('caja.store') }}" id="miFormulario" enctype="multipart/form-data" role="form">
                @csrf

                <div class="modal-body row">

                    <div class="col-6 form-group">
                        <label for="name">Monto *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/dinero.png') }}" alt="" width="25px">
                            </span>
                            <input name="egresos" id="egresos" type="number" class="form-control" required step="any">
                        </div>
                    </div>

                    <div class="col-6 form-group">
                        <label for="name">Retiro y/o Ingreso *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/retiro-de-efectivo.png') }}" alt="" width="25px">
                            </span>
                            <select class="form-control" data-toggle="select" id="motivo" name="motivo" required>
                                <option value="">Seleccionar</option>
                                <option value="Retiro">Retiro</option>
                                <option value="Ingreso">Ingreso</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 form-group">
                        <label for="descuento">Concepto</label>
                        <textarea name="concepto" id="concepto" cols="10" rows="3" class="form-control" required></textarea>
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
