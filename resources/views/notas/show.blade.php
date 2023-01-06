<!-- Modal -->
<div class="modal fade" id="showDataModal{{$notas->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="showDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showDataModalLabel">Ver nota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item active">
                  <a data-toggle="tab" href="#servicio{{$notas->id}}" style="color: #bb546c;margin-left: 20px;">Servicio</a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="#pago{{$notas->id}}" style="color: #bb546c;margin-left: 20px;">Pago</a>
                </li>
                <li class="nav-item">
                    <strong><label style="color: #543325;margin-left: 20px;">Precio Servicio: {{ $notas->Servicios->precio }}</label></strong>
                 </li>
                 <li class="nav-item">
                     <strong><label style="color: #543325;margin-left: 20px;">Sesiones Servicio: {{ $notas->Servicios->num_sesiones }}</label></strong>
                 </li>
            </ul>

            <div class="modal-body">
                <div class="tab-content">

                    <div class="tab-pane fade in active show" id="servicio{{$notas->id}}">
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
                        <div class="form-group">
                            <label for="precio">Servicio</label>
                            <select disabled class="form-control input-edit-car" id="id_servicio" name="id_servicio"
                                value="{{ old('id_servicio') }}" required>
                                <option value="{{ $notas->id_servicio }}">{{ $notas->Servicios->nombre }}</option>
                                @foreach ($servicio as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fecha">Fecha y Hora</label>
                            <input disabled id="fecha" name="fecha" type="datetime-local" class="form-control" placeholder="fecha" value="{{$notas->fecha}}">
                        </div>
                        <div class="form-group">
                            <label for="nota">Nota</label>
                            <textarea disabled name="nota" id="nota" cols="10" rows="3" class="form-control">{{$notas->nota}}</textarea>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pago{{$notas->id}}" >

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

                            <h3><strong>Restante:</strong>  ${{$notas->restante}} .00  MXN</h3>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
