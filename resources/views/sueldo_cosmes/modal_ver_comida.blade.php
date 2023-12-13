<!-- Modal -->
<div class="modal fade" id="comidaModal-{{$cosme->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Horas de comida</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-4">
                   <b> Fecha </b>
                </div>
                <div class="col-4">
                   <b> Hora de Ida </b>
                </div>
                <div class="col-4">
                   <b> Hora Regreso </b>
                </div>
            </div>
            @foreach ($registros_sueldo as $sueldo_base)
                @if ($cosme->id == $sueldo_base->cosmetologo_id)
                    <div class="row">
                        <div class="col-4">
                            {{ \Carbon\Carbon::parse($sueldo_base->fecha)->format('d \d\e F \d\e\l Y') }}
                        </div>
                        <div class="col-4">
                            @if ($sueldo_base->hora_inicio_comida == NULL)
                                Sin Registro
                            @else
                                {{ \Carbon\Carbon::parse($sueldo_base->hora_inicio_comida)->format('h:i A') }}
                            @endif
                        </div>
                        <div class="col-4">
                            @if ($sueldo_base->hora_fin_comida == NULL)
                                Sin Registro
                            @else
                                {{ \Carbon\Carbon::parse($sueldo_base->hora_fin_comida)->format('h:i A') }}
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
