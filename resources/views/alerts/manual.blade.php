
<form method="POST" action="{{ route('store_agenda_manual.notas') }}" enctype="multipart/form-data" role="form">
    <div class="row">
        @csrf
        <h5>Agendar cita</h5>

        <div class="col-3">
            <label for="servicio">Servicio:</label><br>
            <select class="form-control servicios_manual" name="servicio_manual" id="servicio_manual">
                @foreach($servicios as $servicio)
                    <option value="{{ $servicio->id }}" data-duracion="{{ $servicio->duracion }}" data-precio="{{ $servicio->precio }}">
                        {{ $servicio->nombre }} - {{ $servicio->duracion }} min
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-2">
            <label for="total-suma">Fecha</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <img src="{{ asset('assets/icons/calenda.png') }}" alt="" width="25px">
                </span>
                <input id="fechaSeleccionadaInput" name="fechaSeleccionada" type="date" class="form-control" value="{{$fechaActual}}">
            </div>
        </div>

        <div class="col-2">
            <label for="total-suma">Hora: </label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <img src="{{ asset('assets/icons/fecha-limite.webp') }}" alt="" width="25px">
                </span>
                <input  id="horaSeleccionadaInput" name="horaSeleccionada" type="time" class="form-control">
            </div>
        </div>

        <div class="col-3">
            <label for="total-suma">¿Quien lo vendio?</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <img src="{{ asset('assets/icons/mujer.png') }}" alt="" width="30px">
                </span>
                <select class="form-control user_manual" id="id_user_manual" name="id_user_manual" value="{{ old('submarca') }}" required>
                    <option value="14" selected>Daniela Gutierrez</option>
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

                    <select class="form-select cliente_manual d-inline-block"  data-toggle="select" id="id_client_manual" name="id_client_manual" value="{{ old('id_client_manual') }}">
                        <option>Seleccionar cliente</option>
                        @foreach ($clients as $item)
                            <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }} / {{ $item->phone }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="col-6" style="display: grid;">
            <label for="cosmesInput">Cosmes:</label>
            <select class="form-control multi_cosme_manual" id="cosmes_manual" name="cosmes_manual[]" multiple >
                @foreach($user_pagos as $cosme)
                    <option value="{{ $cosme->id }}">{{ $cosme->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-2">
            <label for="total-suma"># Nota servicio: </label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <img src="{{ asset('assets/icons/personas.webp') }}" alt="" width="30px">
                </span>
                <input class="form-control" type="number" id="id_nota" name="id_nota">
            </div>
        </div>

        <div class="col-2">
            <label for="total-suma"># Nota laser: </label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <img src="{{ asset('assets/icons/personas.webp') }}" alt="" width="30px">
                </span>
                <input class="form-control" type="number" id="id_laser" name="id_laser">
            </div>
        </div>

        <div class="col-2">
            <label for="total-suma"># Nota paquete: </label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <img src="{{ asset('assets/icons/personas.webp') }}" alt="" width="30px">
                </span>
                <input class="form-control" type="number" id="id_paquete" name="id_paquete">
            </div>
        </div>

        <div class="col-6 mb-3" style="display: grid;">
            <label for="cosmesInput">Descripcion:</label>
            <textarea name="descripcion"  cols="10" rows="3" class="form-control"></textarea>
        </div>

        <div class="col-4">
            <button type="submit" class="btn close-modal w-100" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
                Guardar
            </button>
        </div>


    </div>
</form>

