<!-- Modal -->
    <div class="modal fade" id="editDataModal{{$notas->id}}" tabindex="-1" role="dialog" aria-labelledby="createDataModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataModalLabel">Editar Servicio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <ul class="nav nav-pills nav-fill p-1" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#notaedit{{$notas->id}}" role="tab" aria-controls="pills-home" aria-selected="true" id="pills-home-tab">
                        <i class="ni ni-folder-17 text-sm me-2"></i> Nota
                    </a>

                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link mb-0 px-0 py-1" id="pills-profile-tab" data-bs-toggle="tab" href="#pedidoedit{{$notas->id}}" role="tab" aria-controls="pills-profile" aria-selected="true">
                        <i class="ni ni-credit-card text-sm me-2"></i> Pedido
                    </a>
                </li>
            </ul>


            <form method="POST" action="{{ route('notas_pedidos.update', $notas->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body">
                    <div class="tab-content">

                        <div class="tab-pane fade in active show" id="notaedit{{$notas->id}}">
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
                                <input disabled id="fecha" name="fecha" type="date" class="form-control" placeholder="fecha" value="{{$notas->fecha}}" required>
                            </div>

                            <div class="form-group">
                                <label for="nota">Total</label>
                                <input disabled id="total" name="total" type="number" class="form-control" placeholder="total" value="{{$notas->total}}" required>
                            </div>

                            <div class="form-group">
                                <label for="num_sesion">Metodo de pago</label>
                                <select disabled id="metodo_pago" name="metodo_pago" class="form-control" required>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Transferencia">Transferencia</option>
                                    <option value="Mercado Pago">Mercado Pago</option>
                                </select>
                            </div>

                            @if ($notas->foto == NULL)
                                <a href=""></a>
                            @else
                                <div class="form-group">
                                    <a href="javascript:abrir('{{asset('foto_producto/'.$notas->foto)}}','500','500')">
                                        <img src="{{asset('foto_producto/'.$notas->foto)}}" style="width: 50%">
                                    </a>
                                </div>
                            @endif

                        </div>

                        <div class="tab-pane fade" id="pedidoedit{{$notas->id}}" >

                            <div class="row text-center">
                                <div class="row mt-4">
                                    <div class="col-4" style="background-color: #212529; color: #fff;">Cantidad</div>
                                    <div class="col-4" style="background-color: #212529; color: #fff;">Concepto</div>
                                    <div class="col-4" style="background-color: #212529; color: #fff;">Importe</div>

                                    <p style="display: none">{{ $resultado = 0; }}</p>
                                    @foreach ($pedido as $item)
                                        @if ($item->id_nota == $notas->id)
                                        <div class="col-4"><input disabled name="cantidad[]" type="number" class="form-control" id="cantidad[]"
                                                value="{{$item->cantidad}}"></div>
                                        <div class="col-4"><input disabled name="concepto[]" type="text" class="form-control" id="concepto[]"
                                                value="{{$item->concepto}}"></div>
                                        <div class="col-4"><input disabled name="importe[]" type="number" class="form-control" id="importe[]"
                                            value="{{$item->importe}}"></div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <div id="formulario" class="mt-4">

                                    <label for="Material">Pedido</label>
                                    <button type="button" class="clonar btn btn-secondary btn-sm">+</button>
                                    <div class="clonars">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="fecha">Cantidad</label>
                                                    <input  id="cantidad[]" name="cantidad[]" type="number" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="pago">Concepto</label>
                                                    <input  id="concepto[]" name="concepto[]" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="num_sesion">Importe</label>
                                                    <input  id="importe[]" name="importe[]" type="number" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>

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
