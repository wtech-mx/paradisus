<!-- Modal -->
    <div class="modal fade" id="createDataModal" tabindex="-1" role="dialog" aria-labelledby="createDataModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear Nota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Nota</button>

                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Pedido</button>
                </li>
              </ul>

            <form method="POST" action="{{ route('notas_pedidos.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body">
                    <div class="tab-content" id="pills-tabContent">

                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                            <div class="form-group">
                                <label for="nombre">Usuario</label>
                                <select class="form-control" id="id_user" name="id_user"
                                    value="{{ old('id_user') }}" required>
                                    @foreach ($user as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="descripcion">Cliente</label>
                                <select class="form-control js-example-basic-single" id="id_client" name="id_client"
                                    value="{{ old('id_client') }}" required>
                                    @foreach ($client as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input id="fecha" name="fecha" type="date" class="form-control" placeholder="fecha" value="{{ old('fecha') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="num_sesion">Metodo de pago</label>
                                <select id="metodo_pago" name="metodo_pago" class="form-control" value="{{old('metodo_pago')}}" required>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Transferencia">Transferencia</option>
                                    <option value="Mercado Pago">Mercado Pago</option>
                                </select>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">.
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
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="descripcion">concepto</label>
                                                <input  id="concepto[]" name="concepto[]" type="text" class="form-control">
                                                {{-- <select class="form-control js-example-basic-single" id="concepto[]" name="concepto[]"
                                                    value="{{ old('concepto') }}" required>
                                                    @foreach ($products as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }} {{ $item->price }}</option>
                                                    @endforeach
                                                </select> --}}
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="num_sesion">Importe</label>
                                                <input  id="importe[]" name="importe[]" type="number" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Cancelar</button>
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>

            </form>
        </div>
    </div>
</div>
