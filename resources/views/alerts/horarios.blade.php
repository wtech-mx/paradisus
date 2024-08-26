<!-- Modal -->
<div class="modal fade" id="HorariosModal" tabindex="-1" role="dialog" aria-labelledby="edit-event-label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">

    <div class="modal-dialog modal-lg modal-dialog-centered " role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Horarios Cosmetologas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

                <div class="modal-body row">

                    <div class="col-12">
                        <form method="POST" class="row" action="{{ route('bitacora_horarios.create') }}" id="" enctype="multipart/form-data" role="form">
                            @csrf

                            <p class="d-inline-flex gap-1">
                                <a class="btn btn-xs btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                 Agregar una incidencia
                                </a>
                              </p>
                              <div class="collapse" id="collapseExample">
                                <div class="card card-body ">
                                    <div class="row">

                                        <div class="form-group col-12">
                                            <label for="">Fecha</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="">
                                                    <img src="{{ asset('assets/icons/calenda.png') }}" alt="" width="30px">
                                                </span>
                                                <input class="form-control" type="date" name="horaio_fecha_inicio" id="horaio_fecha_inicio" placeholder="Selecionar Fecha">
                                            </div>
                                        </div>

                                        {{-- <div class="form-group col-6">
                                            <label for="">Fecha Fin </label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="">
                                                    <img src="{{ asset('assets/icons/calenda.png') }}" alt="" width="30px">
                                                </span>
                                                <input class="form-control" type="date" name="horario_fecha_fin" id="horario_fecha_fin" placeholder="Selecionar Fecha">
                                            </div>
                                        </div> --}}

                                        <div class="form-group col-6" style="">
                                            <label for="">Cosmetóloga que faltara</label>
                                            <select class="form-control "  id="horario_cosme_faltante" name="horario_cosme_faltante" >
                                                @foreach($user_pagos as $cosme)
                                                    <option value="{{ $cosme->id }}">{{ $cosme->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-6" style="">
                                            <label for="">Cosmetóloga que sustituira:</label>
                                            <select class="form-control"  id="horario_cosme_sustituye" name="horario_cosme_sustituye" >
                                                @foreach($user_pagos as $cosme)
                                                    <option value="{{ $cosme->id }}">{{ $cosme->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label for="">Descripcion</label>
                                            <textarea class="form-control" name="horario_descripcion" id="horario_descripcion" cols="30" rows="3"></textarea>
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" id="" class="btn btn-success mt-4">
                                                Guardar
                                            </button>
                                        </div>

                                    </div>

                                </div>
                              </div>


                        </form>
                    </div>

                    <div class="col-4">
                        <form method="POST" class="row" action="{{ route('update_horarios') }}" id="updateForm" enctype="multipart/form-data" role="form">
                            @csrf

                            @foreach($user_pagos as $cosme)
                            <div class="col-4">
                                {{ $cosme->name }}
                            </div>

                            <div class="col-8">
                                <div class="form-group">
                                    <label class="form-control-label">Dias Laborales:</label>
                                    @foreach(['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'] as $dia)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="usuarios[{{ $cosme->id }}][{{ $dia }}]" id="customRadio{{ $cosme->id }}{{ $dia }}" value="1" {{ $cosme->horario->{$dia} == 1 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="customRadio{{ $cosme->id }}{{ $dia }}">{{ ucfirst($dia) }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        @endforeach

                        <div class="col-12 mt-3">
                            <button type="submit" id="guardarCita" class="btn btn-primary">Actualizar</button>
                        </div>

                        </form>
                    </div>

                    <div class="col-8">
                        @foreach ($bitacora_horario as $item)
                            <div class="row mt-3" style="box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);border-radius: 16px;padding:10px;background: #e3829f1f;">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-2"><p class="text-left text-dark text-sm"><strong>#</strong> {{ $item->id }} </p></div>
                                        <div class="col-5"><p class="text-left text-dark text-sm"><strong>Come que falto</strong> <br>{{ $item->CosmeFaltante->name }}</p></div>
                                        <div class="col-5"><p class="text-left text-dark text-sm"><strong>Come que sustituye</strong> <br> {{ $item->CosmeSustituye->name }}</p></div>
                                        <div class="col-6"><p class="text-left text-dark text-sm"><strong>Fecha inicio</strong> <br>{{ \Carbon\Carbon::parse($item->fecha_inicio)->locale('es')->translatedFormat('l j F Y') }} </p></div>
                                        <div class="col-6"><p class="text-left text-dark text-sm"><strong>Fecha Fin</strong> <br> {{ \Carbon\Carbon::parse($item->fecha_fin)->locale('es')->translatedFormat('l j F Y') }}</p></div>
                                        <div class="col-12"><p class="text-left text-dark text-sm">{{ $item->comentario }}</p></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button"  class="btn btn-sm  btn-secondary" data-bs-dismiss="modal">X Cerrar</button>
                </div>

        </div>
    </div>
</div>



