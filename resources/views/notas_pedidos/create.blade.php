<!-- Modal -->
<div class="modal fade" id="createDataModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear Nota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item active">
                  <a data-toggle="tab" href="#home" style="color: #bb546c;margin-left: 20px;">Nota</a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="#menu1" style="color: #bb546c;margin-left: 20px;">Pedido</a>
                </li>
              </ul>
            <form method="POST" action="{{ route('notas_pedidos.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active show" id="home">
                            <div class="form-group">
                                <label for="nombre">Usuario</label>
                                <select class="form-control input-edit-car" id="id_user" name="id_user"
                                    value="{{ old('id_user') }}" required>
                                    @foreach ($user as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Cliente</label>
                                <select class="form-control input-edit-car" id="id_client" name="id_client"
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

                        <div class="tab-pane fade" id="menu1" >
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
                    <button type="button" class="btn close-btn" data-dismiss="modal" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Cancelar</button>
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
