<!-- Modal -->
<div class="modal fade" id="corteAsistenciaCosmes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Corte Cosmes</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('pagos.corte') }}">
                    @csrf
                    <div class="row">
                        @foreach ($registros_hoy as $registro_hoy)
                            <div class="col-6 form-group">
                                <p></p>
                                <h5 for="descuento">{{$registro_hoy->cosmetologo->name}}</h5>
                            </div>

                            <div class="col-6 form-group">
                                <label for="descuento">Hora Fin</label>
                                <input class="form-control" type="time" id="hora_fin_{{$registro_hoy->cosmetologo->id}}" name="hora_fin_{{$registro_hoy->cosmetologo->id}}" value="19:00">
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
