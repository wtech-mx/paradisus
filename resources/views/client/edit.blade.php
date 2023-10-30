<!-- Modal -->
    <div class="modal fade" id="editClientModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="editClientModal{{$item->id}}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataModalLabel">Editar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form method="POST" action="{{ route('clients.update', $item->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nombre *</label>
                        <input id="name" name="name" type="text" class="form-control" placeholder="Nombre" required value="{{$item->name}}">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Apellido *</label>
                        <input id="last_name" name="last_name" type="text" class="form-control" placeholder="Apellido" required value="{{$item->last_name}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Correo</label>
                        <input id="email" name="email" type="email" class="form-control" placeholder="Correo" value="{{$item->email}}">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="phone">Telefono *</label>
                                <input id="phone" name="phone" type="number" class="form-control" placeholder="Telefono" required value="{{$item->phone}}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="occupation">Ocupacion</label>
                                <input id="occupation" name="occupation" type="text" class="form-control" placeholder="Ocupacion" value="{{$item->occupation}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="sanguineous">Sanguineo</label>
                                <input id="sanguineous" name="sanguineous" type="text" class="form-control" placeholder="Sanguineo" value="{{$item->sanguineous}}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="age">Edad</label>
                                <input id="age" name="age" type="number" class="form-control" placeholder="Edad" value="{{$item->age}}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="birth_date">Cumpleaños</label>
                                <input id="birth_date" name="birth_date" type="date" class="form-control" placeholder="birth_date" value="{{$item->birth_date}}">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn close-btn" data-dismiss="modal" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Cancelar</button>
                        <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Actualizar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
