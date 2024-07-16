<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-secondary" role="document">
      <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agendar cita</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                <span aria-hidden="true">X</span>
            </button>
        </div>

        <div class="modal-body" style="padding: 0rem 1rem 0rem 1rem;">
            <div class="row">

                 <div class="form-group col-12">
                  <input class="form-control" type="hidden" name="txtID" id="txtID">
                </div>

                <div class="form-group col-4">
                    <label for="">Fecha</label>
                    <div class="input-group mb-3">
                         <span class="input-group-text" id="">
                            <img src="{{ asset('assets/icons/calenda.png') }}" alt="" width="30px">
                        </span>
                        <input class="form-control" type="date" name="txtFecha" id="txtFecha" >

                    </div>
                </div>

                <div class="form-group col-4">
                    <label for="">Hora Inicio</label>
                    <div class="input-group mb-3">
                         <span class="input-group-text" id="">
                            <img src="{{ asset('assets/icons/esperar.png') }}" alt="" width="30px">
                        </span>
                        <input class="form-control" type="time" name="txtHora" id="txtHora" autocomplete="off" >

                    </div>
                </div>

                <div class="form-group col-4">
                    <label for="">Hora Fin</label>
                    <div class="input-group mb-3">
                         <span class="input-group-text" id="">
                            <img src="{{ asset('assets/icons/esperar.png') }}" alt="" width="30px">
                        </span>
                        <input class="form-control" type="time" name="txtHorafin" id="txtHorafin" autocomplete="off" readonly>

                    </div>
                </div>

                {{-- <input type="hidden" class="form-control" name="image" id="image"> --}}
                <input class="form-control" type="hidden" name="estatus" id="estatus" >

                {{-- <div class="form-group col-12 mb-3">
                    <label for="">T&iacute;tulo</label>
                    <input class="form-control" type="text" name="title" id="title">
                </div> --}}

                <div class="col-3">
                    <label for="precio">Nuevo cliente</label><br>
                    <button class="btn btn-success btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#fullCalendar" aria-expanded="false" aria-controls="fullCalendar">
                        Agregar <img src="{{ asset('assets/icons/cliente.png') }}" alt="" width="25px">
                    </button>
                </div>

                <div class="form-group col-5  mt-3">
                    <label for="">Selecionar Cliente</label>
                    <div class="input-group mb-3">
                        <select class="form-control mibuscador_paciente" id="cliente_id" name="cliente_id" >
                            <option value="">Seleccione Cliente</option>
                            @foreach($clients as $item)
                                <option  value="{{$item->id}}">{{$item->name}} {{$item->last_name}}</option>
                            @endforeach
                       </select>
                    </div>
                </div>

                <div class="form-group col-4 mt-3">
                    <label for="">¿Quien lo vendio?</label>
                    <div class="input-group mb-3">
                         <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/icons/mujer.png') }}" alt="" width="30px">
                        </span>
                        <select class="form-control " id="id_especialist" name="id_especialist" >
                            <option value="">Seleccione vendedor</option>
                            @foreach($user_mix as $item)
                            <option  value="{{$item->id}}">{{$item->name}} </option>
                         @endforeach
                       </select>
                    </div>
                </div>

                <div class="form-group col-12">
                    <div class="collapse" id="fullCalendar">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-4">
                                    <label for="name">Nombre(s) *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/icons/cliente.png') }}" alt="" width="29px">
                                        </span>
                                        <input  id="name_full" name="name_full" type="text" class="form-control" placeholder="Nombre o Nombres">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label for="name">Apellido(s) *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/icons/letter.png') }}" alt="" width="29px">
                                        </span>
                                        <input  id="last_name_full" name="last_name_full" type="text" class="form-control" placeholder="Apellidos">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label for="name">Telefono *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/icons/phone.png') }}" alt="" width="29px">
                                        </span>
                                        <input  id="phone_full" name="phone_full" type="text" class="form-control" type="tel" minlength="10" maxlength="10" placeholder="555555555">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                 <div class="col-12" style="display: grid;">
                    <label for="cosmesInput">Cosmetólogas:</label>
                    <select class="form-control cosmesInput_multiple"  id="cosmesInput" name="cosmes[]" multiple>
                        @foreach($user_pagos as $cosme)
                            <option value="{{ $cosme->id }}">{{ $cosme->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-4 mt-3">
                    <label for="total-suma"># Nota servicio </label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/icons/personas.webp') }}" alt="" width="30px">
                        </span>
                        <input class="form-control" type="number" id="id_notaModal" name="id_nota">
                    </div>
                </div>

                <div class="col-4 mt-3">
                    <label for="total-suma"># Nota laser </label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/icons/personas.webp') }}" alt="" width="30px">
                        </span>
                        <input class="form-control" type="number" id="id_laserModal" name="cosmesInput">
                    </div>
                </div>

                <div class="col-4 mt-3">
                    <label for="total-suma"># Nota paque</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/icons/personas.webp') }}" alt="" width="30px">
                        </span>
                        <input class="form-control" type="number" id="id_paqueteModal" name="id_paqueteModal">
                    </div>
                </div>

                <div class="col-12">
                    <label for="">Descripcion</label>
                    <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="3"></textarea>
                </div>

                <div class="form-group col-6 mt-3">
                    <label for="">Selecciona el servicio</label>
                    <div class="input-group mb-3">
                        <select class="form-control id_servicio_full" id="id_servicio" name="id_servicio" >
                            <option value="">Selecionar servicio</option>
                            @foreach($servicios as $item)
                                  <option value="{{$item->id}}" data-precio="{{ $item->precio }}">{{$item->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group col-5 mt-3">
                    <label for="">¿Estatus de la cita?</label>
                    <div class="input-group mb-3">
                         <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/icons/change.png') }}" alt="" width="30px">
                        </span>
                        <select class="form-control" id="id_status" name="id_status">
                            <option value="">Selecionar estatus</option>
                            @foreach($estatus as $item)
                                <option value="{{$item->id}}">{{$item->estatus}}</option>
                            @endforeach
                          </select>
                    </div>
                </div>

                <div class="form-group col-12 mt-3">
                    <button class="btn btn-info btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#previousServices" aria-expanded="false" aria-controls="previousServices">
                        Ver servicios anteriores
                    </button>
                    <div class="collapse mt-3" id="previousServices">
                        <div class="card card-body ">
                            <div class="row" id="previousServicesList"></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="modal-footer">
            <button class="btn  btn-sm text-white" id="btnNota" style="background-color: #000">
                <input type="text" name="txtNota" id="txtNota" disabled style="background: transparent;color: #fff;border: 1px solid transparent;display: inherit;left: 40px;position: relative;font-size:0px;">
                <input type="hidden" name="txtNota" id="txtNota">
                <i class="fa fa-pencil" aria-hidden="true"></i> Nota
            </button>

            <button class="btn  btn-sm text-white" id="btnWhats" style="background-color: #128C7E">
                <input type="text" name="txtTelefono" id="txtTelefono" disabled style="background: transparent;color: #fff;border: 1px solid transparent;display: inherit;left: 40px;position: relative;font-size:0px;">
                <input type="hidden" name="txtTelefono" id="txtTelefono">
                <i class="fab fa-whatsapp" aria-hidden="true"></i> WhatsApp
            </button>

            <button class="btn btn-success btn-sm text-white" id="btnAgregar">
                <i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar
            </button>

            <button class="btn btn-warning btn-sm text-dark" id="btnModificar">
                <i class="fa fa-retweet" aria-hidden="true"></i> Modificar
            </button>

            <button class="btn btn-danger btn-sm text-white" id="btnBorrar">
                <i class="fa fa-trash" aria-hidden="true"></i> Borrar
            </button>
        </div>

      </div>
    </div>
  </div>



