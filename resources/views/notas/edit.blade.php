<!-- Modal -->
<div class="modal fade" id="editDataModal{{$notas->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataModalLabel">Editar Servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item active">
                  <a data-toggle="tab" href="#servicioedit{{$notas->id}}" style="color: #bb546c;margin-left: 20px;">Servicio</a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="#pagoedit{{$notas->id}}" style="color: #bb546c;margin-left: 20px;">Pago</a>
                </li>
                <li class="nav-item">
                   <strong><label style="color: #543325;margin-left: 20px;">Precio Servicio: {{ $notas->Servicios->precio }}</label></strong> <br>

                </li>
                <li class="nav-item">
                    <strong><label style="color: #543325;margin-left: 20px;">Sesiones Servicio: {{ $notas->Servicios->num_sesiones }}</label></strong>
                </li>
            </ul>
            <form method="POST" action="{{ route('notas.update', $notas->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active show" id="servicioedit{{$notas->id}}">
                            <div class="form-group">
                                <label for="nombre">Usuario</label>
                                <select class="form-control input-edit-car" id="id_user" name="id_user"
                                    value="{{ old('id_user') }}" disabled>
                                    <option value="{{ $notas->id_user }}">{{ $notas->User->name }}</option>
                                    @foreach ($user as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Cliente</label>
                                <select class="form-control input-edit-car" id="id_client" name="id_client"
                                    value="{{ old('id_client') }}" disabled>
                                    <option value="{{ $notas->id_client }}">{{ $notas->Client->name }} {{ $notas->Client->last_name }}</option>
                                    @foreach ($client as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="precio">Servicio</label>
                                <select class="form-control input-edit-car" id="id_servicio" name="id_servicio"
                                    value="{{ old('id_servicio') }}" disabled>
                                    <option value="{{ $notas->id_servicio }}">{{ $notas->Servicios->nombre }}</option>
                                    @foreach ($servicio as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fecha">Fecha y Hora</label>
                                <input id="fecha" name="fecha" type="datetime-local" class="form-control" placeholder="fecha" value="{{$notas->fecha}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nota">Nota</label>
                                <textarea name="nota" id="nota" cols="10" rows="3" class="form-control" disabled>{{$notas->nota}}</textarea>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pagoedit{{$notas->id}}" >

                            <div class="row text-center">
                                <div class="col-3" style="background-color: #bb546c; color: #fff;">Fecha</div>
                                <div class="col-3" style="background-color: #bb546c; color: #fff;">Pago</div>
                                <div class="col-3" style="background-color: #bb546c; color: #fff;">Num sesion</div>
                                <div class="col-3" style="background-color: #bb546c; color: #fff;">Metodo de pago</div>


                                <p style="display: none">{{ $resultado = 0; }}</p>
                                @foreach ($pago as $item)
                                    @if ($item->id_nota == $notas->id)
                                    <p style="display: none">{{ $resultado += $item->pago; }}</p>
                                    <div class="col-3 mb-2"><input name="fecha_pago[]" type="date" class="form-control text-center" id="fecha_pago[]"
                                            value="{{$item->fecha}}" disabled>
                                    </div>

                                    <div class="col-3 mb-2"><input name="pago[]" type="number" class="form-control text-center" id="pago[]"
                                            value="{{$item->pago}}" disabled></div>
                                    <div class="col-3 mb-2"><input name="num_sesion[]" type="number" class="form-control text-center" id="num_sesion[]"
                                        value="{{$item->num_sesion}}" disabled>
                                    </div>

                                    <div class="col-3 mb-2"><input name="forma_pago[]" type="text" class="form-control text-center" id="forma_pago[]"
                                        value="{{$item->forma_pago}}" disabled>
                                    </div>
                                    @endif
                                @endforeach

                            </div>
                                <div id="formulario" class="mt-4">
                                    <h3><strong>Saldo a favor:</strong>  $ {{ $resultado; }} .00  MXN</h3>
                                    @php
                                        $servicio = $notas->Servicios->precio;
                                        $resuletado_suma =$resultado;
                                        $saldo_pendeinte = $servicio - $resuletado_suma;
                                    @endphp
                                    <h3><strong>Restante:</strong>  ${{ $saldo_pendeinte }} .00  MXN</h3>


                                    <label for="Material">Pago</label>
                                    <button type="button" class="clonar btn btn-secondary btn-sm">+</button>
                                    <div class="clonars">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="fecha">Fecha</label>
                                                    <input  id="fecha_pago[]" name="fecha_pago[]" type="date" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="pago">Pago</label>
                                                    <input  id="pago[]" name="pago[]" type="number" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="num_sesion">Num sesion</label>
                                                    <input  id="num_sesion[]" name="num_sesion[]" type="number" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="num_sesion">Metodo de pago</label>
                                                    <select id="forma_pago[]" name="forma_pago[]" class="form-control">
                                                        <option value="Efectivo">Efectivo</option>
                                                        <option value="Transferencia">Transferencia</option>
                                                        <option value="Mercado Pago">Mercado Pago</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn close-btn" data-dismiss="modal" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Cancelar</button>
                            <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Actualizar</button>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>
