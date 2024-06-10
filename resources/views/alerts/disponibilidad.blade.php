<div class="row">
    <div class="col-12">
        <form id="buscarDisponibilidadForm">
            <div class="row">
                @csrf
                <div class="col-5">
                    <label for="servicio">Servicio:</label>
                    <select class="form-control servicios" name="servicio" id="servicio">
                        @foreach($servicios as $servicio)
                            <option value="{{ $servicio->id }}" data-duracion="{{ $servicio->duracion }}" data-precio="{{ $servicio->precio }}">
                                {{ $servicio->nombre }} - {{ $servicio->duracion }} min
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-4">
                    <label for="total-suma">Número de personas:</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/icons/personas.webp') }}" alt="" width="30px">
                        </span>
                        <input  id="numPersonas" name="numPersonas" type="number" class="form-control" min="1" required>
                    </div>
                </div>

                <div class="col-3">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Buscar Disponibilidad</button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-4">
        <div id="resultadosDisponibilidad"></div>
    </div>

    <div class="col-8">
        <div id="formularioFechaSeleccionada" style="display: none;">
            <form id="detallesFechaSeleccionadaForm" method="POST" action="{{ route('store_agenda.notas') }}" enctype="multipart/form-data" role="form">
                <div class="row">
                    @csrf
                    <h5>Agendar cita</h5>

                    <div class="col-6">
                        <label for="total-suma">¿Quien lo vendio?</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/mujer.png') }}" alt="" width="30px">
                            </span>
                            <select class="form-control user" id="id_user" name="id_user" value="{{ old('submarca') }}" required>
                                <option value="">Seleccione una opcion</option>
                                @foreach ($user_cosmes as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Cliente *</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/icons/cliente.png') }}" alt="" width="25px">
                                </span>

                                <select class="form-select cliente d-inline-block"  data-toggle="select" id="id_client" name="id_client" value="{{ old('id_client') }}">
                                    <option>Seleccionar cliente</option>
                                    @foreach ($clients as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }} / {{ $item->phone }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <label for="total-suma">Fecha</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/calenda.png') }}" alt="" width="30px">
                            </span>
                            <input id="fechaSeleccionadaInput" name="fechaSeleccionada" readonly class="form-control">
                        </div>
                    </div>

                    <div class="col-4">
                        <label for="total-suma">Hora: </label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/fecha-limite.webp') }}" alt="" width="30px">
                            </span>
                            <input  id="horaSeleccionadaInput" name="horaSeleccionada" readonly class="form-control">
                        </div>
                    </div>

                    <input  id="servicioIdInput" name="servicioIdInput" class="form-control" style="display: none">
                    <input class="form-control" id="numPersonasInput" name="numPersonasInput" style="display: none">

                    <div class="col-4">
                        <label for="total-suma"># Servicio: </label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/personas.webp') }}" alt="" width="30px">
                            </span>
                            <input class="form-control" id="num_servicio" name="num_servicio" value="1" min="1">
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="cosmesInput">Cosmes:</label>
                        <select class="form-control multi_cosme" id="cosmesInput" name="cosmes[]" multiple>
                            @foreach($user_pagos as $cosme)
                                <option value="{{ $cosme->name }}">{{ $cosme->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-4">
                        <label for="total-suma">Total a Pagar</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                            </span>
                            <input type="text" id="totalSumaInput" name="total-suma" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-4">
                        <label for="total-suma">Restante</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/money.png') }}" alt="" width="25px">
                            </span>
                            <input type="number" id="restanteInput" name="restanteInput" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-4">
                        <label for="total-suma">Cambio</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/cambio.png') }}" alt="" width="25px">
                            </span>
                            <input type="number" id="cambioInput" name="cambioInput" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="col-2">
                        <label for="total-suma">Fecha</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/calenda.png') }}" alt="" width="25px">
                            </span>
                            <input  id="fecha_pago" name="fecha_pago" type="date" class="form-control" value="{{$fechaActual}}">
                        </div>
                    </div>

                    <div class="col-2">
                        <label for="total-suma">Cajera</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/skincare.png') }}" alt="" width="25px">
                            </span>
                            <select class="form-control"  data-toggle="select" id="cajera" name="cajera" required>
                                <option value="">Seleccionar cosme</option>
                                @foreach ($user_recepcion as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-3">
                        <label for="total-suma">Monto a pagar</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/cash-machine.png') }}" alt="" width="25px">
                            </span>
                            <input  id="pagoInput" name="pagoInput" type="number" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-3">
                        <label for="total-suma">Dinero recibido</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/payment-method.png') }}" alt="" width="25px">
                            </span>
                            <input  id="dineroRecibidoInput" name="dineroRecibidoInput" type="number" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-2">

                        <label for="num_sesion">Metodo Pago</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/transferir.png') }}" alt="" width="25px">
                            </span>
                            <select id="forma_pago" name="forma_pago" class="form-control">
                                <option value="Efectivo">Efectivo</option>
                                <option value="Transferencia">Transferencia</option>
                                <option value="Mercado Pago">Mercado Pago</option>
                                <option value="Tarjeta">Tarjeta</option>
                                <option value="Nota">Nota</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="nota">Nota</label>
                            <textarea class="form-control" id="nota2" name="nota2" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="total-suma">Comprobante de pago</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/icons/picture.png') }}" alt="" width="25px">
                            </span>
                            <input type="file" id="foto" class="form-control" name="foto">
                        </div>
                    </div>

                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
                        Guardar
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
