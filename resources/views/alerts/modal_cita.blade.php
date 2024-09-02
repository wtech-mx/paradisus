<!-- Modal -->
<div class="modal fade" id="modal-{{ $alerta->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $alerta->id }}" aria-hidden="true">
    <div class="modal-dialog modal-md  modal-secondary" style="margin-right: 0; margin-left: auto;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel-{{ $alerta->id }}">Aprobar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="approveForm row" action="{{ route('servicio.store_prox_cita') }}" method="POST">
                    @csrf
                    <input type="hidden" id="modal_cita_cliente_id" name="modal_cita_cliente_id" value="{{$alerta->id_client}}" >
                    <input type="hidden" id="modal_cita_id_nota" name="modal_cita_id_nota" value="{{$alerta->id_nota}}" >
                    <input type="hidden" id="modal_cita_id_paquete" name="modal_cita_id_paquete" value="{{$alerta->id_paquete}}" >
                    <input type="hidden" id="modal_cita_id_laser" name="modal_cita_id_laser" value="{{$alerta->id_laser}}" >

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
                            <input class="form-control" type="text" id="modal_cita_num_sesion" name="modal_cita_num_sesion" value="{{$alerta->id_color + 1 }}">
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
                            <input class="form-control" type="date" name="modal_cita_fecha_inicio" id="" >
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="">Hora Inicio</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="">
                                <img src="{{ asset('assets/icons/esperar.png') }}" alt="" width="30px">
                            </span>
                            <input class="form-control" type="time" name="modal_cita_hora_inicio" id="" autocomplete="off" >
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

                    <div class="col-12">
                        <label for="">Descripcion</label>
                        <textarea class="form-control" name="modal_cita_descripcion" id="modal_cita_descripcion" cols="30" rows="3">{{$alerta->descripcion}}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
