<!-- Modal -->
<div class="modal fade" id="productoModal-{{$cosme->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Venta de productos vendidos</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h3><b>Productos</b></h3>
            @foreach ($notasPedidos as $notaPedido)
                @if ($cosme->id == $notaPedido->id_user)
                    <div class="row">
                        <div class="col-4">
                            {{ \Carbon\Carbon::parse($notaPedido->fecha)->format('d \d\e F \d\e\l Y') }}
                        </div>
                        <div class="col-4">
                            Numero de nota: {{$notaPedido->id}}
                        </div>
                        <div class="col-4">
                           <b>${{$notaPedido->total}}</b>
                        </div>
                    </div>
                @endif
            @endforeach
            <h3><b>Servicios</b></h3>
            @foreach ($notasServicios as $notaServicio)
                @if ($cosme->id == $notaServicio->NotasCosmes->id_user)
                    <div class="row">
                        <div class="col-4">
                            {{ \Carbon\Carbon::parse($notaServicio->fecha)->format('d \d\e F \d\e\l Y') }}
                        </div>
                        <div class="col-4">
                            Numero de nota: {{$notaServicio->id}}
                        </div>
                        <div class="col-4">
                        <b>${{$notaServicio->primer_pago}}</b>
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
