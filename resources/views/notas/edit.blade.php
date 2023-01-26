<!-- Modal -->
<div class="modal fade" id="editDataModal{{$notas->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataModalLabel">Editar Nota</h5>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                       <strong><label style="color: #543325;margin-left: 20px; font-size:16px">Precio Servicio: {{ $notas->precio }}</label></strong> <br>

                    </li>
                    <li class="nav-item">
                        <strong><label style="color: #543325;margin-left: 20px; font-size:16px">Sesiones Servicio: {{ $notas->Servicios->num_sesiones }}</label></strong>
                    </li>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <ul class="nav nav-pills nav-fill p-1" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#servicioedit{{$notas->id}}" role="tab" aria-controls="pills-home" aria-selected="true" id="pills-home-tab">
                        <i class="ni ni-folder-17 text-sm me-2"></i> Servicio
                    </a>

                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link mb-0 px-0 py-1" id="pills-profile-tab" data-bs-toggle="tab" href="#pagoedit{{$notas->id}}" role="tab" aria-controls="pills-profile" aria-selected="true">
                        <i class="ni ni-credit-card text-sm me-2"></i> Pago
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#pills-sesion{{$notas->id}}" role="tab" aria-controls="pills-sesion" aria-selected="true" id="pills-sesion-tab">
                        <i class="fa fa-calendar-day text-sm me-2"></i> Sesiones
                    </a>

                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#">
                        <i class="fa fa-money-bill text-sm me-2"></i> Extras
                    </a>
                </li>
            </ul>
            <form method="POST" action="{{ route('notas.update', $notas->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body">
                    <div class="tab-content">

                        <div class="tab-pane fade in active show" id="servicioedit{{$notas->id}}">
                            <div class="form-group">
                                <label for="nombre">Cosmetologas</label>
                                <select disabled id="id_user[]" name="id_user[]" class="js-example-basic-multiple form-control" multiple="multiple">
                                    @foreach($nota_cosme as $item)
                                        @if ($item->id_nota == $notas->id)
                                            <option value="{{$item->id }}">{{$item->User->name}}</option>
                                        @endif
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
                            <div class="row">
                                <div class="col-10">
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
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="precio">Num</label>
                                            <input type="number" id="num" name="num" class="form-control" value="{{ $notas->num }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input id="fecha" name="fecha" type="date" class="form-control" placeholder="fecha" value="{{$notas->fecha}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nota">Nota</label>
                                <textarea name="nota" id="nota" cols="10" rows="3" class="form-control" disabled>{{$notas->nota}}</textarea>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pagoedit{{$notas->id}}" >

                            <div class="row text-center">
                                <div class="col-2" style="background-color: #bb546c; color: #fff;">Fecha</div>
                                <div class="col-3" style="background-color: #bb546c; color: #fff;">Cosme</div>
                                <div class="col-2" style="background-color: #bb546c; color: #fff;">Pago</div>
                                <div class="col-2" style="background-color: #bb546c; color: #fff;">Metodo </div>
                                <div class="col-2" style="background-color: #bb546c; color: #fff;">Nota</div>
                                <div class="col-1" style="background-color: #bb546c; color: #fff;">Foto</div>


                                <p style="display: none">{{ $resultado = 0; }}</p>
                                @foreach ($pago as $item)
                                    @if ($item->id_nota == $notas->id)
                                        <p style="display: none">{{ $resultado += $item->pago; }}</p>

                                        <div class="col-2 py-2" ><input name="fecha_pago" type="date" class="form-control text-center" id="fecha_pago"
                                                value="{{$item->fecha}}" disabled>
                                        </div>

                                        <div class="col-3 py-2" ><input name="cosmetologa" type="text" class="form-control text-center" id="cosmetologa"
                                                value="{{$item->cosmetologa}}" disabled>
                                        </div>

                                        <div class="col-2 py-2" >
                                            <input name="pago" type="number" class="form-control text-center" id="pago"
                                                value="{{$item->pago}}" disabled></div>

                                        <div class="col-2 py-2" ><input name="forma_pago" type="text" class="form-control text-center" id="forma_pago"
                                            value="{{$item->forma_pago}}" disabled>
                                        </div>

                                        <div class="col-2 py-2" ><textarea class="form-control text-center" name="nota[]" id="nota[]" cols="3" rows="1" disabled>{{$item->nota}}</textarea>

                                        </div>

                                        @if ($item->foto == NULL)
                                            <a href=""></a>
                                        @else
                                            <div class="col-1 py-2">
                                                <a href="javascript:abrir('{{asset('foto_servicios/'.$item->foto)}}','500','500')">Foto</a>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach

                            </div>
                            <div class="mt-4">
                                <h5><strong>Saldo a favor:</strong>  $ {{ $resultado; }} .00  MXN</h5>
                                <h5><strong>Restante:</strong>  ${{$notas->restante}} .00  MXN</h5>

                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="fecha">Fecha</label>
                                            <input  id="fecha_pago" name="fecha_pago" type="date" class="form-control" value="{{$fechaActual}}">
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="fecha">Cosme</label>
                                            <select class="form-control cosme"  data-toggle="select" id="cosmetologa" name="cosmetologa" value="">
                                                <option>Seleccionar</option>
                                                @foreach ($cosmetologas as $item)
                                                    <option value="{{ $item->name }} {{ $item->last_name }}">{{ $item->name }} {{ $item->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="pago">Pago</label>
                                            <input  id="pago" name="pago" type="number" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="num_sesion">Metodo Pago</label>
                                            <select id="forma_pago" name="forma_pago" class="form-control">
                                                <option value="Efectivo">Efectivo</option>
                                                <option value="Transferencia">Transferencia</option>
                                                <option value="Mercado Pago">Mercado Pago</option>
                                                <option value="Tarjeta">Tarjeta</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="nota">Nota</label>
                                            <textarea class="form-control" id="nota2" name="nota2" rows="2"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="nota">Foto</label>
                                            <input type="file" id="foto" class="form-control" name="foto">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-sesion{{$notas->id}}" role="tabpanel" aria-labelledby="pills-sesion-tab">
                            @foreach ($notas_sesiones as $item)
                                @if ($item->id_nota == $notas->id)
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="fecha">Fecha</label>
                                                <input  id="fecha_sesion" name="fecha_sesion" type="date" class="form-control" value="{{$item->fecha}}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            <div class="form-group">
                                                <label for="num_sesion">Num sesion</label>
                                                <input  id="sesion" name="sesion" type="number" class="form-control" value="{{$item->sesion}}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="fecha">Fecha</label>
                                        <input  id="fecha_sesion" name="fecha_sesion" type="date" class="form-control" value="{{$fechaActual}}">
                                    </div>
                                </div>

                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="num_sesion">Num sesion</label>
                                        <input  id="sesion" name="sesion" type="number" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-extra{{$notas->id}}" role="tabpanel" aria-labelledby="pills-extra-tab">
                            <h3>Extra</h3>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Cancelar</button>
                            <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Actualizar</button>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>
