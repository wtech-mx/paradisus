<!-- Modal -->
<div class="modal fade" id="productoModal-{{$cosme->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Venta de productos/servicios vendidos</h1>
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
                            <a href="{{ route('notas_pedidos.edit',$notaPedido->id) }}" target="_blank">Numero de nota producto: {{$notaPedido->id}}</a>
                        </div>
                        <div class="col-4">
                           <b>${{$notaPedido->total}}</b>
                        </div>
                    </div>
                @endif
            @endforeach
            <h3><b>Servicios</b></h3>
            @if ($cosme->id == 9)
                @foreach ($notasMaFer as $notaServicio)
                    @if ($cosme->id == $notaServicio->NotasCosmes->id_user)
                        <div class="row">
                            <div class="col-4">
                                {{ \Carbon\Carbon::parse($notaServicio->fecha)->format('d \d\e F \d\e\l Y') }}
                            </div>
                            <div class="col-4">
                                <a href="{{ route('notas.edit',$notaServicio->id) }}" target="_blank">Numero de nota: {{$notaServicio->id}}</a>
                            </div>
                            <div class="col-4">
                            <b>${{$notaServicio->precio}}</b>
                            </div>
                        </div>
                    @endif
                @endforeach
                @foreach ($paquetes_vendidos as $paquete_vendido)
                    @if ($cosme->id == $paquete_vendido->id_cosme)
                        <div class="row">
                            <div class="col-4">{{ \Carbon\Carbon::parse($paquete_vendido->fecha)->format('d \d\e F \d\e\l Y') }}</div>
                            <div class="col-4">Paquete Vendido</div>
                            <div class="col-4"><b>${{$paquete_vendido->monto}}</b></div>
                            <div></div>
                        </div>
                    @endif
                @endforeach
            @else
                @foreach ($notasServicios as $notaServicio)
                    @if ($cosme->id == $notaServicio->NotasCosmes->id_user)
                        <div class="row">
                            <div class="col-4">
                                {{ \Carbon\Carbon::parse($notaServicio->fecha)->format('d \d\e F \d\e\l Y') }}
                            </div>
                            <div class="col-4">
                                <a href="{{ route('notas.edit',$notaServicio->id) }}" target="_blank">Numero de nota: {{$notaServicio->id}}</a>
                            </div>
                            <div class="col-4">
                            <b>${{$notaServicio->primer_pago}}</b>
                            </div>
                        </div>
                    @endif
                @endforeach

                    @foreach ($paquetesFaciales as $notaServicio)
                        @if ($cosme->id == $notaServicio->NotasCosmes->id_user)
                            @php
                                $servicios = array_filter([
                                    $notaServicio->id_servicio,
                                    $notaServicio->id_servicio2,
                                    $notaServicio->id_servicio3,
                                    $notaServicio->id_servicio4,
                                ]);
                            @endphp

                            @if (count(array_intersect($servicios, [138, 139, 140, 141, 142])) > 0)
                                @if (count(array_diff($servicios, [138, 139, 140, 141, 142])) > 0)
                                    <div class="row">
                                        <div class="col-4">
                                            {{ \Carbon\Carbon::parse($notaServicio->fecha)->format('d \d\e F \d\e\l Y') }}
                                        </div>
                                        <div class="col-4">
                                            <a href="{{ route('notas.edit',$notaServicio->id) }}" target="_blank">Numero de nota: {{$notaServicio->id}}</a>
                                        </div>
                                        <div class="col-4">
                                        <b>${{$notaServicio->primer_pago}}</b>
                                        </div>
                                    </div>
                                @endif
                            @endif

                        @endif
                    @endforeach
            @endif

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
