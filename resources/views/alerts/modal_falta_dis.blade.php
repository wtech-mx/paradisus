<!-- Modal -->
<div class="modal fade" id="faltaModal" tabindex="-1" role="dialog" aria-labelledby="edit-event-label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Falta Disponibilidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

                <div class="modal-body row">
                    <form method="POST" class="row" action="{{ route('falta_disponibilidad.create') }}" enctype="multipart/form-data" role="form">
                        @csrf

                        <div class="form-group col-6">
                            <label for="">Fecha Falta</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="">
                                    <img src="{{ asset('assets/icons/calenda.png') }}" alt="" width="30px">
                                </span>
                                <input class="form-control" type="date" name="fecha_falta_disponibilidad" id="fecha_falta_disponibilidad" >
                            </div>
                        </div>


                        <div class="col-12" style="display: grid;">
                            <label for="">Cosmetóloga:</label>
                            <select class="form-control cosmesInput_falta_disponibilidad"  id="cosme_falta_disponibilidad" name="cosme_falta_disponibilidad" >
                                @foreach($user_pagos as $cosme)
                                    <option value="{{ $cosme->id }}">{{ $cosme->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6 mt-3">
                            <button type="submit" class="btn btn-success">
                                <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                                Guardar
                            </button>

                        </div>

                    </form>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm  btn-secondary" data-bs-dismiss="modal">X Cerrar</button>
                </div>

        </div>
    </div>
</div>


