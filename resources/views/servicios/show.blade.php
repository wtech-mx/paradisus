<!-- Modal -->
<div class="modal fade" id="showDataModal{{$servicios->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="showDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showDataModalLabel">Ver Servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label for="nombre"></label>
                            <input disabled id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre" value="{{$servicios->nombre}}">
                        </div>
                        <div class="form-group">
                            <label for="descripcion"></label>
                            <textarea disabled class="form-control" name="descripcion" id="descripcion" cols="10" rows="2" placeholder="Descripción">{{$servicios->descripcion}}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="precio"></label>
                                    <input disabled id="precio" name="precio" type="number" class="form-control" placeholder="Precio" value="{{$servicios->precio}}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="duracion"></label>
                                    <input disabled id="duracion" name="duracion" type="text" class="form-control" placeholder="duracion" value="{{$servicios->duracion}}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="num_sesiones"></label>
                                    <input disabled id="num_sesiones" name="num_sesiones" type="number" class="form-control" placeholder="num sesiones" value="{{$servicios->num_sesiones}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="categoria"></label>
                                    <input disabled id="categoria" name="categoria" type="text" class="form-control" placeholder="Categoria" value="{{$servicios->categoria}}">
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="descuento"></label>
                                    <input disabled id="descuento" name="descuento" type="number" class="form-control" placeholder="Descuento" value="{{$servicios->descuento}}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="color"></label>
                                    <input disabled id="color" name="color" type="color" class="form-control" placeholder="color" value="{{$servicios->color}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descuento"></label>
                            <input disabled id="act_descuento" name="act_descuento" type="number" class="form-control" value="{{$servicios->act_descuento}}" style="display: none">
                        </div>
                </div>
        </div>
    </div>
</div>
