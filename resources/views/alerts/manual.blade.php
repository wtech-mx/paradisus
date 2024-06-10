
<form method="POST" action="{{ route('store_agenda_manual.notas') }}" enctype="multipart/form-data" role="form">
    <div class="row">
        @csrf
        <h5>Agendar cita</h5>

        <div class="col-4">
            <label for="servicio">Servicio:</label><br>
            <select class="form-control servicios_manual" name="servicio" id="servicio">
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

        <div class="col-4">
            <label for="total-suma">¿Quien lo vendio?</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <img src="{{ asset('assets/icons/mujer.png') }}" alt="" width="30px">
                </span>
                <select class="form-control user_manual" id="id_user" name="id_user" value="{{ old('submarca') }}" required>
                    <option value="">Seleccione una opcion</option>
                    @foreach ($user_cosmes as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col-4">
            <div class="form-group">
                <label for="name">Cliente *</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <img src="{{ asset('assets/icons/cliente.png') }}" alt="" width="25px">
                    </span>

                    <select class="form-select cliente_manual d-inline-block"  data-toggle="select" id="id_client" name="id_client" value="{{ old('id_client') }}">
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
                <input id="fechaSeleccionadaInput" name="fechaSeleccionada" type="date" class="form-control">
            </div>
        </div>

        <div class="col-4">
            <label for="total-suma">Hora: </label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <img src="{{ asset('assets/icons/fecha-limite.webp') }}" alt="" width="30px">
                </span>
                <input  id="horaSeleccionadaInput" name="horaSeleccionada" type="time" class="form-control">
            </div>
        </div>

        <div class="col-12">
            <label for="cosmesInput">Cosmes:</label>
            <select class="form-control multi_cosme_manual" id="cosmesInput" name="cosmes[]" multiple>
                @foreach($user_pagos as $cosme)
                    <option value="{{ $cosme->id }}">{{ $cosme->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-4">
            <label for="total-suma"># Nota: </label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <img src="{{ asset('assets/icons/personas.webp') }}" alt="" width="30px">
                </span>
                <input class="form-control" type="number" id="id_nota" name="id_nota">
            </div>
        </div>

        <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
            Guardar
        </button>
    </div>
</form>

