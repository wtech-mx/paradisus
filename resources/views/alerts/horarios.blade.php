<!-- Modal -->
<div class="modal fade" id="HorariosModal" tabindex="-1" role="dialog" aria-labelledby="edit-event-label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Horarios Cosmetologas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

                <div class="modal-body row">
                    <form method="POST" class="row" action="{{ route('update_horarios') }}" id="updateForm" enctype="multipart/form-data" role="form">
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

                                        @foreach(['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'] as $dia)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="usuarios[{{ $cosme->id }}][{{ $dia }}]" id="customRadio{{ $cosme->id }}{{ $dia }}" value="1" {{ $cosme->horario->{$dia} == 1 ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="customRadio{{ $cosme->id }}{{ $dia }}">{{ ucfirst($dia) }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                            <div class="col-12 mt-3">
                                <button type="submit" id="guardarCita" class="btn btn-primary">Actualizar</button>
                            </div>

                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button"  class="btn btn-sm  btn-secondary" data-bs-dismiss="modal">X Cerrar</button>
                </div>

        </div>
    </div>
</div>



