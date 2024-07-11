<div class="row">
    <div class="col-12">
        <form id="buscarDisponibilidadFechasForm">
            <div class="row">
                @csrf
                <div class="col-4">
                    <label for="servicio">Servicio:</label>
                    <select class="form-control" name="servicio_fechas" id="servicio_fechas">
                        @foreach($servicios as $servicio)
                            <option value="{{ $servicio->id }}" data-duracion="{{ $servicio->duracion }}">
                                {{ $servicio->nombre }} - {{ $servicio->duracion }} min
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-3">
                    <label for="numPersonas">Número de personas:</label>
                    <input id="numPersonas_fechas" name="numPersonas_fechas" type="number" class="form-control" min="1" required>
                </div>

                <div class="col-3">
                    <label for="tipoDia">Día:</label>
                    <select class="form-control" name="tipoDia_fechas" id="tipoDia_fechas">
                        <option value="entreSemana">Entre semana</option>
                        <option value="finDeSemana">Fines de semana</option>
                        <option value="lunes">Lunes</option>
                        <option value="martes">Martes</option>
                        <option value="miercoles">Miércoles</option>
                        <option value="jueves">Jueves</option>
                        <option value="viernes">Viernes</option>
                        <option value="sabado">Sábado</option>
                        <option value="domingo">Domingo</option>
                    </select>
                </div>

                <div class="col-2">
                    <button type="submit" class="btn btn-primary">Buscar Disponibilidad</button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-4">
        <button id="buscarMasFechasFechas" class="btn btn-secondary">Buscar más fechas</button>
        <div id="resultadosDisponibilidadFechas" class="mt-3"></div>
    </div>
</div>
