<!-- Modal -->
<div class="modal fade" id="showDataModal{{$notas->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="showDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showDataModalLabel">Ver notas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
                <div class="modal-body">
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
                            <label for="nota"></label>
                            <textarea disabled name="nota" id="nota" cols="10" rows="3" class="form-control">{{$notas->nota}}</textarea>
                        </div>
                </div>
        </div>
    </div>
</div>
