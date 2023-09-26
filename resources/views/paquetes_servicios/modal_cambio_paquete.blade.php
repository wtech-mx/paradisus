<!-- Modal -->
@php
    $saldo_favor = $paquete->monto - $paquete->restante;
@endphp
<div class="modal fade" id="modalPaquete{{$paquete->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel{{$paquete->id}}">Paquete Actual</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form method="POST" action="{{ route('update_paquete.buscador', $paquete->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <label for="precio">Paquete Actual</label><br>
                                <input type="text" class="form-control" value="{{ $paquete->Servicios->nombre }}" readonly>
                            </div>

                            <div class="col-6">
                                <label for="precio">Cambio</label><br>
                                <select class="form-control" id="id_paquete" name="id_paquete" value="{{ old('id_paquete') }}" required>
                                    <option value="">Seleccionar paquete</option>
                                    <option value="1" data-precio="7000">figura Ideal c/Aparatología</option>
                                    <option value="2" data-precio="6000">Lipoescultura s/Cirugía</option>
                                    <option value="3" data-precio="5200">Moldeante & Reductivo</option>
                                    <option value="4" data-precio="4500">Drenante & Linfático</option>
                                    <option value="5" data-precio="4500">Glúteos Definido & Perfectos</option>
                                </select>
                            </div>

                            <div class="col-4">
                                <label for="precio">Precio paquete actual</label><br>
                                <input type="text" class="form-control" id="paquete_precio_actual" value="{{ $paquete->Servicios->precio }}" readonly>
                            </div>

                            <div class="col-4">
                                <label for="precio">Precio paquete seleccionado</label><br>
                                <input type="text" id="precio_paquete" name="precio_paquete" class="form-control" readonly>
                            </div>

                            <div class="col-4">
                                <label for="precio">Saldo a Favor</label><br>
                                <input type="text" id="saldo_favor" name="saldo_favor" class="form-control" value="{{ $saldo_favor }}" readonly>
                            </div>

                            <div class="col-6">
                                <div class="form-check">
                                    @if ($paquete->descuento_5 == 1)
                                        <label class="custom-control-label" for="descuento">Pago de contado</label><br>
                                        <input class="form-check-input" type="checkbox" name="descuento_5" id="descuento_5" value="{{ $paquete->descuento_5 }}" checked readonly>
                                    @else
                                        <label class="custom-control-label" for="descuento">Pago de contado</label><br>
                                        <input class="form-check-input" type="checkbox" name="descuento_5" id="descuento_5" readonly>
                                    @endif
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="precio">Pago restante</label><br>
                                <input type="text" id="pago_restante" name="pago_restante" class="form-control" readonly>
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

