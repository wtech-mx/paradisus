<!-- Modal -->
<div class="modal fade" id="showAsistenciaCosmes{{$user_pago->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">{{$user_pago->name}}</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <div class="modal-body">
                <div class="row">
                    <form method="post" action="{{ route('pagos.adicional') }}">
                        @csrf
                        <input type="text" id="id_cosme" name="id_cosme" value="{{$user_pago->id}}" style="display: none">
                        <!-- Campos para seleccionar la cosmetóloga y la información de asistencia -->
                        <div class="col-6 form-group">
                            <label for="name">Descuento o Extra *</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/icons/retiro-de-efectivo.png') }}" alt="" width="25px">
                                </span>
                                <select class="form-control" data-toggle="select" id="tipo" name="tipo">
                                    <option value="Extra" selected>Extra</option>
                                    <option value="Descuento">Descuento</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 form-group">
                            <label for="descuento">Monto *</label>
                            <input class="form-control" type="number" id="monto" name="monto" required>
                        </div>

                        <div class="col-12 form-group">
                            <label for="descuento">Concepto</label>
                            <textarea name="concepto" id="concepto" cols="10" rows="3" class="form-control" required></textarea>
                        </div>

                        <div class="col-12 form-group">
                            <label for="name">Comprobante</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/icons/picture.png') }}" alt="" width="25px">
                                </span>
                                <input type="file" id="comprobante" class="form-control" name="comprobante">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar Registro</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
