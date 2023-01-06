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
                  <a data-toggle="tab" href="#home" style="color: #bb546c;margin-left: 20px;">Servicio</a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="#menu1" style="color: #bb546c;margin-left: 20px;">Pago</a>
                </li>
              </ul>
            <form method="POST" action="{{ route('notas.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active show" id="home">
                            <div class="form-group">
                                <label for="nombre">Seleccione Cosmetologa</label>
                                <select class="select2-multiple form-control " id="id_user[]" name="id_user[]" multiple="multiple" id="select2Multiple"
                                    value="{{ old('submarca') }}" multiple="" data-live-search="true" required>
                                    @foreach ($user as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Cliente</label>
                                <select class="form-control " id="id_client" name="id_client"
                                    value="{{ old('submarca') }}" required>
                                    <option>Seleccionar cliente</option>
                                    @foreach ($client as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="precio">Servicio</label>
                                <select class="form-control " id="opciones" name="id_servicio" onchange="cambioOpciones();" required>
                                    <option>Seleccionar servicio</option>
                                    @foreach ($servicio as $item)
                                        <option value="{{ $item->id }}" rel="{{ $item->precio }}_{{ $item->num_sesiones }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="form-group">
                                <label for="fecha">Fecha y hora</label>
                                <input id="fecha" name="fecha" type="datetime-local" class="form-control">@error('fecha') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div> --}}
                            <div class="form-group">
                                <label for="descuento">Nota</label>
                                <textarea name="nota" id="nota" cols="10" rows="3" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="menu1" >
                            <div class="row" style="display: none">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nombre">Precio</label>
                                        <input  id="showId" type="number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="nombre">Número Sesiones</label>
                                        <input  id="concepto" type="number" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div id="formulario">
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

                                        <div class="col-2">
                                            <div class="form-group">
                                                <label for="pago">Pago</label>
                                                <input  id="pago[]" name="pago[]" type="number" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            <div class="form-group">
                                                <label for="num_sesion">Num sesion</label>
                                                <input  id="num_sesion[]" name="num_sesion[]" type="number" class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            <div class="form-group">
                                                <label for="num_sesion">Metodo Pago</label>
                                                <select id="forma_pago[]" name="forma_pago[]" class="form-control">
                                                    <option value="Efectivo">Efectivo</option>
                                                    <option value="Transferencia">Transferencia</option>
                                                    <option value="Mercado Pago">Mercado Pago</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="nota">Nota</label>
                                                <textarea class="form-control" id="nota2[]" name="nota2[]" rows="2"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- <table class="table table-bordered" id="tabla_script">
                                <thead class="table-dark">
                                    <tr class="text-center">
                                        <th>Fecha de pago</th>
                                        <th>Pago</th>
                                        <th>Num sesión</th>
                                        <th>Método de pago</th>
                                    </tr>
                                </thead>
                            </table>

                            <a href="javascript:;" id="agregar" class="btn" style="background-color:#001d3d;color:  #41CC2E!important; border: 2px solid #41CC2E!important;">Agregar
                                servicio</a> --}}
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
