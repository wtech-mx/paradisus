<!-- Modal -->
    <div class="modal fade" id="showDataModal{{$notas->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showDataModalLabel">Ver notas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item active">
                  <a data-toggle="tab" href="#servicio{{$notas->id}}" style="color: #bb546c;margin-left: 20px;">Nota</a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="#pago{{$notas->id}}" style="color: #bb546c;margin-left: 20px;">Pedido</a>
                </li>
            </ul>

            <div class="modal-body">
                <div class="tab-content">

                    <div class="tab-pane fade in active show" id="servicio{{$notas->id}}">
                        <div class="form-group">
                            <label for="nombre">Usuario</label>
                            <select disabled class="form-control input-edit-car" id="id_user" name="id_user"
                                value="{{ old('id_user') }}" required>
                                <option value="{{ $notas->id_user }}">{{ $notas->User->name }}</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                            <label for="fecha">Fecha</label>
                            <input disabled id="fecha" name="fecha" type="date" class="form-control" placeholder="fecha" value="{{$notas->fecha}}">
                        </div>
                        <div class="form-group">
                            <label for="nota">Total</label>
                            <input disabled id="total" name="total" type="number" class="form-control" placeholder="total" value="{{$notas->total}}">
                        </div>
                        <div class="form-group">
                            <label for="nota">Metodo Pago</label>
                            <input disabled id="metodo_pago" name="metodo_pago" type="number" class="form-control" placeholder="total" value="{{$notas->metodo_pago}}">
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pago{{$notas->id}}" >
                        <div class="row mt-4">
                            <div class="col-4" style="background-color: #212529; color: #fff;">Cantidad</div>
                            <div class="col-4" style="background-color: #212529; color: #fff;">Concepto</div>
                            <div class="col-4" style="background-color: #212529; color: #fff;">Importe</div>

                            <p style="display: none">{{ $resultado = 0; }}</p>
                            @foreach ($pedido as $item)
                                @if ($item->id_nota == $notas->id)
                                <div class="col-4"><input name="cantidad[]" type="number" class="form-control" id="cantidad[]"
                                        value="{{$item->cantidad}}" disabled></div>
                                <div class="col-4"><input name="concepto[]" type="text" class="form-control" id="concepto[]"
                                        value="{{$item->concepto}}" disabled></div>
                                <div class="col-4"><input name="importe[]" type="number" class="form-control" id="importe[]"
                                    value="{{$item->importe}}" disabled></div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
