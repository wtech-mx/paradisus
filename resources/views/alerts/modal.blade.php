<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-secondary" role="document">
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
                  <input class="form-control" type="date" name="txtFecha" id="txtFecha" >
                </div>

                <div class="form-group col-4">
                    <label for="">Hora Inicio</label>
                  <input class="form-control" type="time" name="txtHora" id="txtHora" autocomplete="off" >
                </div>

                <div class="form-group col-4">
                    <label for="">Hora Fin</label>
                  <input class="form-control" type="time" name="txtHorafin" id="txtHorafin" autocomplete="off" >
                </div>

                {{-- <input type="hidden" class="form-control" name="image" id="image"> --}}
                <input class="form-control" type="hidden" name="estatus" id="estatus" >

                {{-- <div class="form-group col-12 mb-3">
                    <label for="">T&iacute;tulo</label>
                    <input class="form-control" type="text" name="title" id="title">
                </div> --}}

                <div class="form-group col-6 mb-3">

                   <label for="">Selecionar Paciente</label>
                   <input class="" type="text" name="title" id="title" disabled style="background: transparent;font-size: 12px;border: 0px;padding:0px">
                        <select class="form-control mibuscador_paciente" id="cliente_id" name="cliente_id" >
                             <option value="">Seleccione Paciente</option>
                             @foreach($client as $item)
                             <option  value="{{$item->id}}">{{$item->name}} {{$item->last_name}}</option>
                          @endforeach
                        </select>
                </div>

                <div class="form-group col-6 mb-3">
                   <label for="">Selecionar Unidad</label>
                        <select class="form-control" id="resourceId" name="resourceId" style="margin-top: 22px;">
                             <option value="">Seleccione Unidad</option>
                             @for ($i = 1; $i <= $configuracion->modulos; $i++)
                             @php
                                 $letra = chr($i + 64); // Convierte el número en su equivalente de letra ASCII (A = 1, B = 2, etc.)
                             @endphp
                             <option value="{{ $letra }}">{{ $letra }}</option>
                         @endfor
                        </select>
                </div>

                <div class="form-group col-12 mb-3">
                   <label for="">Selecionar especialista</label>
                        <select class="form-control" id="id_especialist" name="id_especialist" >
                             <option value="">Seleccione especialista</option>
                             @foreach($cosme as $item)
                             <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                </div>

                <label for="">Descripcion</label>
                <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="2"></textarea>

                <div class="form-group col-6 mt-3">
                    <label for="">Selecciona el servicio</label>
                    <select class="form-control" id="id_color" name="id_color" >
                        <option value="">Selecionar servicio</option>
                        @foreach($colores as $item)
                              <option value="{{$item->id}}">{{$item->servicio}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-6 mt-3">
                    <label for="">¿Estatus de la cita?</label>
                    <select class="form-control" id="id_status" name="id_status">
                      <option value="">Selecionar estatus</option>
                      @foreach($estatus as $item)
                          <option value="{{$item->id}}">{{$item->estatus}}</option>
                      @endforeach
                    </select>
                </div>

            </div>

        </div>

        <div class="modal-footer">
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



