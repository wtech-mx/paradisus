<!-- Modal -->
<div class="modal fade" id="showAsistenciaCosmes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Registrar Asistencia</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <div class="modal-body">
                <div class="row">
                    <form method="post" action="{{ route('pagos.store') }}">
                        @csrf

                        <!-- Campos para seleccionar la cosmetóloga y la información de asistencia -->
                        <div class="form-group">
                            <label for="cosmetologo">Cosmetóloga:</label>
                            <select name="cosmetologo_id" id="cosmetologo_id" class="form-control">
                                <!-- Opciones de cosmetólogas -->
                                @foreach ($user_pagos as $cosmetologo)
                                    <option value="{{ $cosmetologo->id }}">{{ $cosmetologo->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="puntualidad">Puntualidad:</label>
                            <select name="puntualidad" id="puntualidad" class="form-control">
                                <option value="1" selected>Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="cosmetologo_cubriendo">Cosmetóloga Cubriendo:</label>
                            <select name="cosmetologo_cubriendo" id="cosmetologo_cubriendo" class="form-control">
                                <option value="">Seleccionar en caso de cubrir</option>
                                @foreach ($user_pagos as $cosmetologo)
                                    <option value="{{ $cosmetologo->id }}">{{ $cosmetologo->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Guardar Registro</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
