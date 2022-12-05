<!-- Modal -->
<div class="modal fade" id="createDataModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear Nota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <form method="POST" action="{{ route('notas.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre">Usuario</label>
                            <select class="form-control input-edit-car" id="id_user" name="id_user"
                                value="{{ old('submarca') }}" required>
                                <option>Seleccionar usuario</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Cliente</label>
                            <select class="form-control input-edit-car" id="id_client" name="id_client"
                                value="{{ old('submarca') }}" required>
                                <option>Seleccionar cliente</option>
                                @foreach ($client as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="precio">Servicio</label>
                            <select class="form-control input-edit-car" id="id_servicio" name="id_servicio"
                                value="{{ old('submarca') }}" required>
                                <option>Seleccionar servicio</option>
                                @foreach ($servicio as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fecha">Fecha y hora</label>
                            <input id="fecha" name="fecha" type="datetime-local" class="form-control">@error('fecha') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="descuento">Nota</label>
                            <textarea name="nota" id="nota" cols="10" rows="3" class="form-control"></textarea>
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
