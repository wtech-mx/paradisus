<!-- Modal -->
<div class="modal fade" id="modal_pedido_{{ $notas->id }}" tabindex="-1" aria-labelledby="modal_pedido_{{ $notas->id }}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal_pedido_{{ $notas->id }}Label">Artículos del Pedido</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($notas->pedidos->isEmpty())
                    <p>No hay artículos en este pedido.</p>
                @else
                    <ul>
                        @foreach ($notas->pedidos as $pedido)
                            <li>
                                <strong>Producto:</strong> {{ $pedido->concepto }} <br>
                                <strong>Cantidad:</strong> {{ $pedido->cantidad }} <br>
                                <strong>Importe:</strong> ${{ $pedido->importe }} mxn <br>
                            </li> <br>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
