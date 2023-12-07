<!-- Modal -->
<div class="modal fade" id="showComida" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Hora de comida</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach ($registros_hoy as $registro_hoy)
                        <form method="post" action="{{ route('pagos.comida', $registro_hoy->cosmetologo_id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-12 form-group">
                                    <p></p>
                                    <h5 for="descuento">{{$registro_hoy->cosmetologo->name}}</h5>
                                </div>

                                <div class="col-4 form-group">
                                    <label for="descuento">Hora Ida</label>
                                    <input class="form-control" type="time" id="hora_ida" name="hora_ida"
                                    value="{{ $registro_hoy->hora_inicio_comida ? $registro_hoy->hora_inicio_comida : date('H:00') }}">
                                </div>

                                <div class="col-4 form-group">
                                    <label for="descuento">Hora Regreso</label>
                                    <input class="form-control" type="time" id="hora_reg" name="hora_reg"
                                    value="{{ $registro_hoy->hora_fin_comida ? $registro_hoy->hora_fin_comida : date('H:00') }}">
                                </div>

                                <div class="col-4 form-group">
                                    <br>
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
