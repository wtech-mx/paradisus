<!-- Modal -->
<div class="modal fade" id="showDataModal{{$notas->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="showDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showDataModalLabel">Ver Nota</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <ul class="nav nav-pills nav-fill p-1" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#servicio{{$notas->id}}" role="tab" aria-controls="pills-home" aria-selected="true" id="pills-home-tab">
                        <i class="ni ni-folder-17 text-sm me-2"></i> Servicio
                    </a>

                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link mb-0 px-0 py-1" id="pills-profile-tab" data-bs-toggle="tab" href="#pago{{$notas->id}}" role="tab" aria-controls="pills-profile" aria-selected="true">
                        <i class="ni ni-credit-card text-sm me-2"></i> Pago
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#show-sesion{{$notas->id}}" role="tab" aria-controls="pills-sesion" aria-selected="true" id="pills-sesion-tab">
                        <i class="fa fa-calendar-day text-sm me-2"></i> Sesiones
                    </a>

                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#">
                        <i class="fa fa-money-bill text-sm me-2"></i> Extras
                    </a>
                </li>
            </ul>

            <div class="modal-body">
                <div class="tab-content">

                    <div class="tab-pane fade in active show" id="servicio{{$notas->id}}">
                        @if ($notas->cancelado == 1)
                                <div class="form-check">
                                    <label class="custom-control-label" for="cancelado" style="font-size: 15px;">cancelar</label>
                                    <input class="form-check-input" type="checkbox" name="cancelado" id="cancelado" value="{{$notas->cancelado}}" checked disabled>
                                </div>
                            @else
                                <div class="form-check">
                                    <label class="custom-control-label" for="cancelado" style="font-size: 15px;">cancelar</label>
                                    <input class="form-check-input" type="checkbox" name="cancelado" id="cancelado" value="1" disabled>
                                </div>
                        @endif
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
                            <select disabled class="form-control input-edit-car" id="id_client" name="id_client"
                                value="{{ old('id_client') }}" required>
                                <option value="{{ $notas->id_client }}">{{ $notas->Client->name }} {{ $notas->Client->last_name }}</option>
                                @foreach ($client as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="precio">Servicio</label>
                                    <select class="form-control input-edit-car" id="id_servicio" name="id_servicio"
                                        value="{{ old('id_servicio') }}" disabled>
                                        <option value="{{ $notas->Paquetes->id_servicio }}">{{ $notas->Paquetes->Servicios->nombre }}</option>
                                        @foreach ($servicio as $item)
                                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="precio">Num</label>
                                        <input type="number" id="num" name="num" class="form-control" value="{{ $notas->Paquetes->num }}" disabled>
                                </div>
                            </div>
                            <div class="col-2">
                                @if ($notas->Paquetes->descuento == 1)
                                        <div class="form-check">
                                            <label class="custom-control-label" for="descuento" style="font-size: 15px;">10%</label><br>
                                            <input class="form-check-input" type="checkbox" name="descuento" id="descuento" value="{{$notas->Paquetes->descuento}}" checked disabled>
                                        </div>
                                    @else
                                        <div class="form-check">
                                            <label class="custom-control-label" for="descuento" style="font-size: 15px;">10%</label><br>
                                            <input class="form-check-input" type="checkbox" name="descuento" id="descuento" value="1" disabled>
                                        </div>
                                @endif
                            </div>
                        </div>
                        {{-- M A S  S E R V I C I O S --}}
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="precio">Servicio 2</label><br>
                                        <select class="form-control " data-toggle="select" id="servicio2" name="id_servicio2" disabled>
                                            @if ($notas->Paquetes->id_servicio2 == NULL || $notas->Paquetes->id_servicio2 == 0)
                                                <option value="">Seleccione Servicio</option>
                                            @else
                                                <option value="{{ $notas->Paquetes->id_servicio2 }}">{{ $notas->Paquetes->Servicios2->nombre }}</option>
                                            @endif
                                            @foreach ($servicio as $item)
                                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="precio">Num 2</label>
                                            <input type="number" id="num2" name="num2" class="form-control" value="{{ $notas->Paquetes->num2 }}" disabled>
                                    </div>
                                </div>
                                <div class="col-2">
                                    @if ($notas->Paquetes->descuento2 == 1)
                                            <div class="form-check">
                                                <label class="custom-control-label" for="descuento2" style="font-size: 15px;">10%</label><br>
                                                <input class="form-check-input" type="checkbox" name="descuento2" id="descuento2" value="{{$notas->Paquetes->descuento2}}" checked disabled>
                                            </div>
                                        @else
                                            <div class="form-check">
                                                <label class="custom-control-label" for="descuento2" style="font-size: 15px;">10%</label><br>
                                                <input class="form-check-input" type="checkbox" name="descuento2" id="descuento2" value="1" disabled>
                                            </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="precio">Servicio 3</label><br>
                                        <select class="form-control " data-toggle="select" id="servicio3" name="id_servicio3" disabled>
                                            @if ($notas->Paquetes->id_servicio3 == NULL || $notas->Paquetes->id_servicio3 == 0)
                                                <option value="">Seleccione Servicio</option>
                                            @else
                                                <option value="{{ $notas->Paquetes->id_servicio3 }}">{{ $notas->Paquetes->Servicios3->nombre }}</option>
                                            @endif
                                            @foreach ($servicio as $item)
                                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="precio">Num 3</label>
                                            <input type="number" id="num3" name="num3" class="form-control" value="{{ $notas->Paquetes->num3 }}" disabled>
                                    </div>
                                </div>
                                <div class="col-2">
                                    @if ($notas->Paquetes->descuento3 == 1)
                                            <div class="form-check">
                                                <label class="custom-control-label" for="descuento3" style="font-size: 15px;">10%</label><br>
                                                <input class="form-check-input" type="checkbox" name="descuento3" id="descuento3" value="{{$notas->Paquetes->descuento3}}" checked disabled>
                                            </div>
                                        @else
                                            <div class="form-check">
                                                <label class="custom-control-label" for="descuento3" style="font-size: 15px;">10%</label><br>
                                                <input class="form-check-input" type="checkbox" name="descuento3" id="descuento3" value="1" disabled>
                                            </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="precio">Servicio 4</label><br>
                                        <select class="form-control " id="servicio4" name="id_servicio4" disabled>
                                            @if ($notas->Paquetes->id_servicio4 == NULL || $notas->Paquetes->id_servicio4 == 0)
                                                <option value="">Seleccione Servicio</option>
                                            @else
                                                <option value="{{ $notas->Paquetes->id_servicio4 }}">{{ $notas->Paquetes->Servicios4->nombre }}</option>
                                            @endif
                                            @foreach ($servicio as $item)
                                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="precio">Num 4</label>
                                            <input type="number" id="num4" name="num4" class="form-control" value="{{ $notas->Paquetes->num4 }}" disabled>
                                    </div>
                                </div>
                                <div class="col-2">
                                    @if ($notas->Paquetes->descuento4 == 1)
                                            <div class="form-check">
                                                <label class="custom-control-label" for="descuento4" style="font-size: 15px;">10%</label><br>
                                                <input class="form-check-input" type="checkbox" name="descuento4" id="descuento4" value="{{$notas->Paquetes->descuento4}}" checked disabled>
                                            </div>
                                        @else
                                            <div class="form-check">
                                                <label class="custom-control-label" for="descuento4" style="font-size: 15px;">10%</label><br>
                                                <input class="form-check-input" type="checkbox" name="descuento4" id="descuento4" value="1" disabled>
                                            </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- E N D  M A S  S E R V I C I O S --}}

                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input disabled id="fecha" name="fecha" type="date" class="form-control" placeholder="fecha" value="{{$notas->fecha}}">
                        </div>
                        <div class="form-group">
                            <label for="nota">Nota</label>
                            <textarea disabled name="nota" id="nota" cols="10" rows="3" class="form-control">{{$notas->nota}}</textarea>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pago{{$notas->id}}" >

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
                                    value="{{ $item->User->name }}" disabled>
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
                        <div id="formulario" class="mt-4">
                            <h5><strong>Saldo a favor:</strong>  $ {{ $resultado; }} .00  MXN</h5>

                            <h5><strong>Restante:</strong>  ${{$notas->restante}} .00  MXN</h5>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="show-sesion{{$notas->id}}" role="tabpanel" aria-labelledby="pills-sesion-tab">
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
                    </div>

                    <div class="tab-pane fade" id="pills-extra{{$notas->id}}" role="tabpanel" aria-labelledby="pills-extra-tab">
                        <h3>Extra</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
