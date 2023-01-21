<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear Servicio</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <form method="POST" action="{{ route('servicio.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" cols="10" rows="2" placeholder="Descripción"></textarea>@error('descripcion') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="precio">Precio</label>
                                    <input id="precio" name="precio" type="number" class="form-control" placeholder="Precio">@error('precio') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="duracion">Duración</label>
                                    <input id="duracion" name="duracion" type="text" class="form-control" placeholder="duracion">@error('duracion') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="num_sesiones">Num. Sesiones</label>
                                    <input id="num_sesiones" name="num_sesiones" type="number" class="form-control" placeholder="num sesiones">@error('num_sesiones') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="categoria">Categoria</label>
                                    <input id="categoria" name="categoria" type="text" class="form-control" placeholder="Categoria">@error('categoria') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="descuento">Descuento</label>
                                    <input id="descuento" name="descuento" type="number" class="form-control" placeholder="Descuento">@error('descuento') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="color">Color</label>
                                    <input id="color" name="color" type="color" class="form-control" placeholder="color">
                                </div>
                            </div>
                        </div>
                            <div class="form-group" style="display: none">
                                <label for="descuento"></label>
                                <input id="act_descuento" name="act_descuento" type="number" class="form-control" placeholder="Descuento">@error('descuento') <span class="error text-danger">{{ $message }}</span> @enderror
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
