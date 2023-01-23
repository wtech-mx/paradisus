<!-- Modal -->
<div class="modal fade" id="createDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear Nota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

              <ul class="nav nav-pills nav-fill p-1" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" id="pills-home-tab">
                        <i class="ni ni-folder-17 text-sm me-2"></i> Servicio
                    </a>

                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link mb-0 px-0 py-1" id="pills-profile-tab" data-bs-toggle="tab" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">
                        <i class="ni ni-credit-card text-sm me-2"></i> Pago
                    </a>
                </li>
              </ul>

            <form method="POST" action="{{ route('notas.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="form-group">
                                <label for="nombre">Seleccione Cosmetologa</label>
                                <select class="form-control " id="id_user[]" name="id_user[]" multiple value="{{ old('submarca') }}" required>
                                    @foreach ($user as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Cliente</label>
                                <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    +
                                </button>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="nombre">Nombre *</label>
                                                <input  id="name" name="name" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="nombre">Apellido</label>
                                                <input  id="last_name" name="last_name" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="nombre">Telefono *</label>
                                                <input  id="phone" name="phone" type="number" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="nombre">Correo</label>
                                                <input  id="email" name="email" type="email" class="form-control">
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="precio">Cliente</label>
                                <select class="form-control cliente"  data-toggle="select" id="id_client" name="id_client" value="{{ old('submarca') }}">
                                    <option>Seleccionar cliente</option>
                                    @foreach ($client as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-10">
                                    <div class="form-group">
                                        <label for="precio">Servicio</label>
                                        <select class="form-control servicio" id="id_servicio" name="id_servicio">
                                            <option value="">Seleccionar servicio</option>
                                            @foreach ($servicio as $item)
                                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="precio">Num</label>
                                            <input type="number" id="num" name="num" class="form-control" value="1">
                                    </div>
                                </div>
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

                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
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
                                {{-- <button type="button" class="clonar btn btn-secondary btn-sm">+</button> --}}

                                <div class="clonars">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="fecha">Fecha</label>
                                                <input  id="fecha_pago" name="fecha_pago" type="date" class="form-control" value="{{$fechaActual}}">
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            <div class="form-group">
                                                <label for="pago">Pago</label>
                                                <input  id="pago" name="pago" type="number" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            <div class="form-group">
                                                <label for="num_sesion">Num sesion</label>
                                                <input  id="num_sesion" name="num_sesion" type="number" class="form-control" required>
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
                                                    <option value="Nota">Nota</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-3">
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
                                        <hr>
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
