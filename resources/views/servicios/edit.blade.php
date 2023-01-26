<!-- Modal -->
<div class="modal fade" id="editDataModal{{$servicios->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataModalLabel">Editar Servicio</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form method="POST" action="{{ route('servicio.update', $servicios->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre" value="{{$servicios->nombre}}">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" cols="10" rows="2" placeholder="Descripción">{{$servicios->descripcion}}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="precio">Precio</label>
                                    <input id="precio" name="precio" type="number" class="form-control" placeholder="Precio" value="{{$servicios->precio}}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="duracion">Duracion 1</label>
                                    <input id="duracion" name="duracion" type="text" class="form-control" placeholder="duracion" value="{{$servicios->duracion}}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="num_sesiones">Num sesiones 1</label>
                                    <input id="num_sesiones" name="num_sesiones" type="number" class="form-control" placeholder="num sesiones" value="{{$servicios->num_sesiones}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="categoria">Categoria</label>
                                    <input id="categoria" name="categoria" type="text" class="form-control" placeholder="Categoria" value="{{$servicios->categoria}}">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="descuento">Descuento</label>
                                    <input id="descuento" name="descuento" type="number" class="form-control" placeholder="Descuento" value="{{$servicios->descuento}}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="color">Color</label>
                                    <input id="color" name="color" type="color" class="form-control" placeholder="color" value="{{$servicios->color}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            {{-- <div class="col-4">
                                <div class="form-group" >
                                    <label for="descuento">Act Descuento</label><br>
                                    <input id="act_descuento" name="act_descuento" type="checkbox" class="toggle-class" value="1">@error('descuento') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div> --}}
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="num_sesiones2">Num. Sesiones 2</label>
                                    <input id="num_sesiones2" name="num_sesiones2" type="number" class="form-control" value="{{$servicios->num_sesiones2}}">@error('num_sesiones2') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="duracion">Duración 2</label>
                                    <input id="duracion2" name="duracion2" type="text" class="form-control" value="{{$servicios->duracion2}}">@error('duracion2') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn close-btn" data-bs-dismiss="modal" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Cancelar</button>
                            <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Actualizar</button>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>
