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
            <ul class="nav nav-pills nav-fill p-1" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" id="pills-home-tab">
                        <i class="ni ni-folder-17 text-sm me-2"></i> Nota
                    </a>

                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link mb-0 px-0 py-1" id="pills-profile-tab" data-bs-toggle="tab" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">
                        <i class="fa fa-solid fa-receipt"></i> Pedido

                    </a>
                </li>
            </ul>

            <form method="POST" action="{{ route('notas_pedidos.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body">
                    <div class="tab-content" id="pills-tabContent">

                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                            <div class="form-group">

                                @if (Auth::user()->hasRole('cosmetologa'))
                                <input type="text" id="id_user" class="form-control" name="id_user" value="{{ $cosme->id }}" style="display: none">
                                @else
                                <label for="nombre">Usuario</label>
                                <select class="form-control" id="id_user" name="id_user"
                                    value="{{ old('id_user') }}" required>
                                    @foreach ($user as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @endif
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
                                <select class="form-control js-example-basic-single" id="id_client" name="id_client"
                                    value="{{ old('id_client') }}" required>
                                    @foreach ($client as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input id="fecha" name="fecha" type="date" class="form-control" placeholder="fecha" value="{{ old('fecha') }}" required>
                            </div> --}}
                            <div class="form-group">
                                <label for="num_sesion">Metodo de pago</label>
                                <select id="metodo_pago" name="metodo_pago" class="form-control" value="{{old('metodo_pago')}}" required>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Transferencia">Transferencia</option>
                                    <option value="Mercado Pago">Mercado Pago</option>
                                    <option value="Tarjeta">Tarjeta</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nota">Foto</label>
                                <input type="file" id="foto" class="form-control" name="foto">
                            </div>
                        </div>


                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div id="formulario" class="mt-4">

                                <button type="button" class="clonar btn btn-secondary btn-sm">Agregar</button>
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
