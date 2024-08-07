<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear Cliente</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <form method="POST" action="{{ route('clients.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nombre *</label>
                            <input id="name" name="name" type="text" class="form-control" placeholder="Nombre" required>@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name">Apellido *</label>
                            <input id="last_name" name="last_name" type="text" class="form-control" placeholder="Apellido" required>@error('last_name') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Correo</label>
                            <input id="email" name="email" type="email" class="form-control" placeholder="Correo">@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="phone">Telefono *</label>
                                    <input id="phone" name="phone" type="number" class="form-control" placeholder="Telefono" required>@error('phone') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="occupation">Ocupacion</label>
                                    <input id="occupation" name="occupation" type="text" class="form-control" placeholder="Ocupacion">@error('occupation') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="sanguineous">Sanguineo</label>
                                    <input id="sanguineous" name="sanguineous" type="text" class="form-control" placeholder="Sanguineo">@error('sanguineous') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="age">Edad</label>
                                    <input id="age" name="age" type="number" class="form-control" placeholder="Edad">@error('age') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="birth_date">Cumpleaños</label>
                                    <input id="birth_date" name="birth_date" type="date" class="form-control" value="23-11-2018">@error('birth_date') <span class="error text-danger">{{ $message }}</span> @enderror
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
