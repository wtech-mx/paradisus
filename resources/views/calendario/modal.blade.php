<!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="edit-event-label" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agendar cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
              </div>

              <div class="modal-body" style="padding: 0rem 1rem 0rem 1rem;">

                  <div class="form row">

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

                      <input type="hidden" class="form-control" name="image" id="image">
                      <input class="form-control" type="hidden" name="estatus" id="estatus" >

                      <div class="form-group col-12 mb-3">
                          <label for="">T&iacute;tulo</label>
                          <input class="form-control" type="text" name="title" id="title">
                      </div>

                      <div class="form-group col-6 mb-3">
                         <label for="">Selecionar Paciente</label>
                              <select class="form-control mibuscador_paciente" id="id_client" name="id_client" >
                                   <option value="">Seleccione Paciente</option>
                                       @foreach($client as $item)
                                          <option  value="{{$item->id}}">{{$item->name}} {{$item->last_name}}</option>
                                       @endforeach
                              </select>
                      </div>

                      <div class="form-group col-6 mb-3">
                         <label for="">Selecionar Cabina</label>
                              <select class="form-control" id="resource_id" name="resource_id" >
                                   <option value="">Seleccione Cabina</option>
                                   <option value="a">A</option>
                                   <option value="b">B</option>
                                   <option value="c">C</option>
                                   <option value="d">D</option>
                                   <option value="e">E</option>
                              </select>
                      </div>

                      <div class="form-group col-12 mb-3">
                         <label for="">Selecionar Cosmetologa</label>
                              <select class="form-control" id="id_especialist" name="id_especialist" >
                                   <option value="">Seleccione Cosmetologa</option>
                                       @foreach($cosme as $item)
                                          <option value="{{$item->id}}">{{$item->name}}</option>
                                       @endforeach
                              </select>
                      </div>

                      <label for="">Descripcion</label>
                      <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="2"></textarea>

                      <div class="form-group col-6 mt-3">
                          <label for="">Selecciona el servicio</label>
                          <select class="form-control" id="color" name="color" >
                              <option value="">Selecionar estatus</option>
                              @foreach($servicios as $item)
                                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                              @endforeach
                          </select>
                      </div>

                      <div class="form-group col-6 mt-3">
                          <label for="">¿Estatus de la cita?</label>
                          <select class="form-control" id="check" name="check">
                              <option selected value="1">Sin confirmar agendado</option>
                              <option value="2">No asistio / cancelado</option>
                              <option value="3">Confirmado</option>
                              <option value="4">Atendido</option>
                          </select>
                      </div>

                  </div>

              </div>

              <div class="modal-footer">
                  <button class="btn  btn-sm text-white" id="btnWhats" style="background-color: #128C7E">
                      <input type="text" name="txtTelefono" id="txtTelefono" disabled style="font-size: 0px;background: transparent;color: #fff;border: 1px solid transparent;display: inherit;left: 40px;position: relative;">
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



