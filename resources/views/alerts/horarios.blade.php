<!-- Modal -->
<div class="modal fade" id="HorariosModal" tabindex="-1" role="dialog" aria-labelledby="edit-event-label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Comidas Cosmetologas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

                <div class="modal-body row">
                    <form method="POST" class="row" action="{{ route('calendar.store_comidas') }}" id="miFormulario" enctype="multipart/form-data" role="form">
                        @csrf


                            @foreach($user_pagos as $cosme)
                            <div class="col-4">
                                {{ $cosme->name }}
                            </div>

                            <div class="col-8">
                                <div class="row">
                                    <div class="col-6">

                                        <div class="form-group">
                                            <label class="form-control-label">Dias Laborales:</label>

                                            @if ($cosme->horario->lunes == 1)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="lunes" id="customRadio1" value="{{$cosme->horario->lunes}}" checked>
                                                    <label class="custom-control-label" for="customRadio1">Lunes</label>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="lunes" id="customRadio1" value="1">
                                                    <label class="custom-control-label" for="customRadio1">Lunes</label>
                                                </div>
                                            @endif

                                            @if ($cosme->horario->martes == 1)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="martes" id="customRadio2" value="{{$cosme->horario->martes}}" checked>
                                                    <label class="custom-control-label" for="customRadio1">Martes</label>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="martes" id="customRadio2" value="1">
                                                    <label class="custom-control-label" for="customRadio1">Martes</label>
                                                </div>
                                            @endif

                                            @if ($cosme->horario->miercoles == 1)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="miercoles" id="customRadio3" value="{{$cosme->horario->miercoles}}" checked>
                                                    <label class="custom-control-label" for="customRadio1">Miercoles</label>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="miercoles" id="customRadio3" value="1">
                                                    <label class="custom-control-label" for="customRadio1">Miercoles</label>
                                                </div>
                                            @endif

                                            @if ($cosme->horario->jueves == 1)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="jueves" id="customRadio4" value="{{$cosme->horario->jueves}}" checked>
                                                    <label class="custom-control-label" for="customRadio1">Jueves</label>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="jueves" id="customRadio4" value="1">
                                                    <label class="custom-control-label" for="customRadio1">Jueves</label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Fin de Semana:</label>

                                            @if ($cosme->horario->viernes == 1)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="viernes" id="customRadio5" value="{{$cosme->horario->viernes}}" checked>
                                                    <label class="custom-control-label" for="customRadio1">Viernes</label>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="viernes" id="customRadio5" value="1">
                                                    <label class="custom-control-label" for="customRadio1">Viernes</label>
                                                </div>
                                            @endif

                                            @if ($cosme->horario->sabado == 1)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="sabado" id="customRadio6" value="{{$cosme->horario->sabado}}" checked>
                                                    <label class="custom-control-label" for="customRadio1">Sabado</label>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="sabado" id="customRadio6" value="1">
                                                    <label class="custom-control-label" for="customRadio1">Sabado</label>
                                                </div>
                                            @endif

                                            @if ($cosme->horario->domingo == 1)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="domingo" id="customRadio7" value="{{$cosme->horario->domingo}}" checked>
                                                    <label class="custom-control-label" for="customRadio1">Domingo</label>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="domingo" id="customRadio7" value="1">
                                                    <label class="custom-control-label" for="customRadio1">Domingo</label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                            </div>
                            @endforeach

                    </form>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm  btn-secondary" data-bs-dismiss="modal">X Cerrar</button>
                </div>

        </div>
    </div>
</div>


