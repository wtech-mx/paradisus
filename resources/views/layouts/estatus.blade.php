<!-- Modal -->
<div class="modal fade" id="estatusModal" tabindex="-1" role="dialog" aria-labelledby="edit-event-label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Configuración de estatus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

                <div class="modal-body ">
                    <p>
                        <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Agregar estatus</a>
                    </p>
                      <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <form action="{{ route('estatus.create') }}" method="post" class="row"  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group col-3">
                                    <label for="limpieza">Estatus</label>
                                    <input type="text" class="form-control" id="estatus" name="estatus">
                                </div>

                                <div class="form-group col-2">
                                    <label for="Color">Color</label>
                                    <input type="color" class="form-control" id="color" name="color">
                                </div>

                                <div class="form-group col-4">
                                    <label for="Color">Icono</label>
                                    <select class="form-control" id="icono" name="icono">
                                        <option value="{{ asset('img/iconos_serv/sistema/asistencia.png') }}" data-img="{{ asset('img/iconos_serv/sistema/asistencia.png') }}">Asistencia</option>
                                        <option value="{{ asset('img/iconos_serv/sistema/asistencia 2.png') }}" data-img="{{ asset('img/iconos_serv/sistema/asistencia 2.png') }}">Asistencia 2</option>
                                        <option value="{{ asset('img/iconos_serv/sistema/confirmado.png') }}" data-img="{{ asset('img/iconos_serv/sistema/confirmado.png') }}">Confirmado</option>
                                        <option value="{{ asset('img/iconos_serv/sistema/confirmado 2.png') }}" data-img="{{ asset('img/iconos_serv/sistema/confirmado 2.png') }}">Confirmado 2</option>
                                        <option value="{{ asset('img/iconos_serv/sistema/pendiente.png') }}" data-img="{{ asset('img/iconos_serv/sistema/pendiente.png') }}">Pendiente</option>
                                        <option value="{{ asset('img/iconos_serv/sistema/pendiente 2.png') }}" data-img="{{ asset('img/iconos_serv/sistema/pendiente 2.png') }}">Pendiente 2</option>
                                        <option value="{{ asset('img/iconos_serv/sistema/reagendado.png') }}" data-img="{{ asset('img/iconos_serv/sistema/reagendado.png') }}">Reagendado</option>
                                        <option value="{{ asset('img/iconos_serv/sistema/reagendado 2.png') }}" data-img="{{ asset('img/iconos_serv/sistema/reagendado 2.png') }}">Reagendado 2</option>
                                        <option value="{{ asset('img/iconos_serv/sistema/sin_asistencia.png') }}" data-img="{{ asset('img/iconos_serv/sistema/sin_asistencia.png') }}">Sin Asistencia</option>
                                        <option value="{{ asset('img/iconos_serv/sistema/sin_asistencia 2.png') }}" data-img="{{ asset('img/iconos_serv/sistema/sin_asistencia 2.png') }}">Sin Asistencia 2</option>
                                        <option value="{{ asset('img/iconos_serv/sistema/cancelado.png') }}" data-img="{{ asset('img/iconos_serv/sistema/cancelado.png') }}">Cancelado</option>
                                        <option value="{{ asset('img/iconos_serv/sistema/pagado.png') }}" data-img="{{ asset('img/iconos_serv/sistema/pagado.png') }}">Pagado</option>
                                    </select>
                                </div>

                                <div class="form-group col-3">
                                    <label for="operatoria" style="opacity: 0;">-------</label>
                                    <button type="submit" class="btn btn-primary">Crear</button>
                                </div>
                            </form>
                            <hr>

                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12">
                            @foreach ($estatus as $item)
                            <form action="{{ route('estatus.update_estatus',$item->id) }}" method="post" class="row"  enctype="multipart/form-data">
                              @csrf

                                <div class="form-group col-3">
                                    <label for="limpieza">estatus</label>
                                    <input type="hidden" class="form-control" id="id" name="id" value="{{$item->id}}">
                                    <input type="text" class="form-control" id="estatus" name="estatus" value="{{$item->estatus}}">
                                </div>

                                <div class="form-group col-2">
                                    <label for="Color">Color</label>
                                    <input type="color" class="form-control" id="color" name="color" value="{{$item->color}}">
                                </div>

                                <div class="form-group col-4">
                                    <label for="Color">Icono</label>
                                    <select class="form-control icono-select" name="icono2">
                                        <option value="{{$item->image}}" data-img="{{$item->image}}">{{$item->estatus}}</option>
                                        <option value="{{ asset('img/iconos_serv/sistema/asistencia.png') }}" data-img="{{ asset('img/iconos_serv/sistema/asistencia.png') }}">Asistencia</option>
                                        <option value="{{ asset('img/iconos_serv/sistema/asistencia 2.png') }}" data-img="{{ asset('img/iconos_serv/sistema/asistencia 2.png') }}">Asistencia 2</option>
                                        <option value="{{ asset('img/iconos_serv/sistema/confirmado.png') }}" data-img="{{ asset('img/iconos_serv/sistema/confirmado.png') }}">Confirmado</option>
                                        <option value="{{ asset('img/iconos_serv/sistema/confirmado 2.png') }}" data-img="{{ asset('img/iconos_serv/sistema/confirmado 2.png') }}">Confirmado 2</option>
                                        <option value="{{ asset('img/iconos_serv/sistema/pendiente.png') }}" data-img="{{ asset('img/iconos_serv/sistema/pendiente.png') }}">Pendiente</option>
                                        <option value="{{ asset('img/iconos_serv/sistema/pendiente 2.png') }}" data-img="{{ asset('img/iconos_serv/sistema/pendiente 2.png') }}">Pendiente 2</option>
                                        <option value="{{ asset('img/iconos_serv/sistema/reagendado.png') }}" data-img="{{ asset('img/iconos_serv/sistema/reagendado.png') }}">Reagendado</option>
                                        <option value="{{ asset('img/iconos_serv/sistema/reagendado 2.png') }}" data-img="{{ asset('img/iconos_serv/sistema/reagendado 2.png') }}">Reagendado 2</option>
                                        <option value="{{ asset('img/iconos_serv/sistema/sin_asistencia.png') }}" data-img="{{ asset('img/iconos_serv/sistema/sin_asistencia.png') }}">Sin Asistencia</option>
                                        <option value="{{ asset('img/iconos_serv/sistema/sin_asistencia 2.png') }}" data-img="{{ asset('img/iconos_serv/sistema/sin_asistencia 2.png') }}">Sin Asistencia 2</option>
                                        <option value="{{ asset('img/iconos_serv/sistema/cancelado.png') }}" data-img="{{ asset('img/iconos_serv/sistema/cancelado.png') }}">Cancelado</option>
                                        <option value="{{ asset('img/iconos_serv/sistema/pagado.png') }}" data-img="{{ asset('img/iconos_serv/sistema/pagado.png') }}">Pagado</option>
                                    </select>
                                </div>

                                <div class="form-group col-3">
                                    <label for="operatoria" style="opacity: 0;">-------</label>
                                    <button type="submit" class="btn btn-primary">guardar</button>
                                </div>
                               </form>
                            @endforeach
                        </div>
                    </div>

                </div>
                <hr>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">cerrar</button>
                </div>

        </div>
    </div>
</div>


