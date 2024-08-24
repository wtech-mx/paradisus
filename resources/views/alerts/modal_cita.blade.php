<!-- Modal -->
<div class="modal fade" id="modalCita{{$alerta->id}}" tabindex="-1" role="dialog" aria-labelledby="edit-event-label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">

    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Comidas Cosmetologas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

                <div class="modal-body row">
                    <form method="POST" class="row" action="{{ route('servicio.store_prox_cita') }}" id="submit_prox_cita_{{$alerta->id}}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="text" id="modal_cita_cliente_id" name="modal_cita_cliente_id" value="{{$alerta->id_client}}">
                        <input type="text" id="modal_cita_id_nota" name="modal_cita_id_nota" value="{{$alerta->id_nota}}">
                        <input type="text" id="modal_cita_id_paquete" name="modal_cita_id_paquete" value="{{$alerta->id_paquete}}">
                        <input type="text" id="modal_cita_id_laser" name="modal_cita_id_laser" value="{{$alerta->id_laser}}">
                        <input type="text" id="modal_cita_descripcion" name="modal_cita_descripcion" value="{{$alerta->descripcion}}">

                        <div class="form-group col-6">
                            <label for="">Cliente</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="">
                                    <img src="{{ asset('assets/icons/cliente.png') }}" alt="" width="30px">
                                </span>
                                <input class="form-control" type="text" value="{{$alerta->title}}">
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="">Num. sesion siguiente</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="">
                                    <img src="{{ asset('assets/icons/prueba.webp') }}" alt="" width="30px">
                                </span>
                                <input class="form-control" type="text" id="num_sesion" name="num_sesion" value="{{$alerta->id_color + 1 }}">
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="">Servicio</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="">
                                    <img src="{{ asset('assets/icons/mascara-facial.png') }}" alt="" width="30px">
                                </span>
                                <select class="form-control modal_cita_serv" id="modal_cita_id_servicio" name="modal_cita_id_servicio" >
                                    <option value="{{$alerta->id_servicio}}">{{$alerta->Servicios_id->nombre}}</option>
                                    @foreach($servicios_select as $item)
                                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="">Fecha Inicio</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="">
                                    <img src="{{ asset('assets/icons/calenda.png') }}" alt="" width="30px">
                                </span>
                                <input class="form-control" type="date" name="fecha_inicio_comida" id="" >
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="">Hora Inicio</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="">
                                    <img src="{{ asset('assets/icons/esperar.png') }}" alt="" width="30px">
                                </span>
                                <input class="form-control" type="time" name="hora_inicio_comida" id="" autocomplete="off" >
                            </div>
                        </div>

                        <div class="col-12" style="display: grid;">
                            <label for="">Cosmetólogas:</label>
                            <select class="form-control modal_cita_cosme"  id="modal_cita_cosme" name="modal_cita_cosme[]" multiple>
                                @foreach($user_pagos as $cosme)
                                    <option value="{{ $cosme->id }}">{{ $cosme->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6 mt-3">
                            <button type="submit" class="btn btn-primary btn-submit-cita" data-alerta-id="{{$alerta->id}}">
                                <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
                                Guardar {{$alerta->id}}
                            </button>

                        </div>

                    </form>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm  btn-secondary " data-bs-dismiss="modal">X Cerrar</button>
                </div>

        </div>
    </div>
</div>
