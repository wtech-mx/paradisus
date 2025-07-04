<div class="col-1">
    <div class="form-check">
        <label class="custom-control-label" for="descuento" style="font-size: 15px;">Contado</label><br>
        <input class="form-check-input" type="checkbox" name="es-contado" id="es-contado" value="1">
    </div>
</div>

<div class="col-3">
    <label for="total-suma">Total a Pagar</label>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">
            <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
        </span>
        <input type="text" id="total-suma" name="total-suma" class="form-control" value="{{$servicio->precio}}" readonly>
    </div>
</div>

<div class="col-4">
    <label for="total-suma">Restante</label>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">
            <img src="{{ asset('assets/icons/money.png') }}" alt="" width="25px">
        </span>
        <input type="text" id="restante" name="restante" class="form-control" readonly>
    </div>
</div>

<div class="col-4">
    <label for="total-suma">Cambio</label>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">
            <img src="{{ asset('assets/icons/cambio.png') }}" alt="" width="25px">
        </span>
        <input type="text" id="cambio" name="cambio" class="form-control" readonly>
    </div>
</div>

<div class="col-3">
    <label for="total-suma">Fecha</label>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">
            <img src="{{ asset('assets/icons/calenda.png') }}" alt="" width="25px">
        </span>
        <input  id="fecha_pago" name="fecha_pago" type="date" class="form-control" value="{{$fechaActual}}">
    </div>
</div>

<div class="col-3">
    <label for="total-suma">Cajera</label>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">
            <img src="{{ asset('assets/icons/skincare.png') }}" alt="" width="25px">
        </span>
        <select class="form-control"  data-toggle="select" id="id_user" name="id_user" required>
            <option value="">Seleccionar cosme</option>
            @foreach ($user as $item)
                <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="col-2">
    <label for="total-suma">Monto a pagar</label>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">
            <img src="{{ asset('assets/icons/cash-machine.png') }}" alt="" width="25px">
        </span>
        <input  id="pago" name="pago" type="number" class="form-control" required step="any">
    </div>
</div>

<div class="col-2">
    <label for="total-suma">Dinero recibido</label>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">
            <img src="{{ asset('assets/icons/payment-method.png') }}" alt="" width="25px">
        </span>
        <input  id="dinero_recibido_create" name="dinero_recibido" type="number" class="form-control" required step="any">
    </div>
</div>

<div class="col-2">
    <label for="num_sesion">Metodo Pago</label>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">
            <img src="{{ asset('assets/icons/transferir.png') }}" alt="" width="25px">
        </span>
        <select id="forma_pago" name="forma_pago" class="form-control">
            <option value="Efectivo">Efectivo</option>
            <option value="Transferencia">Transferencia</option>
            <option value="Mercado Pago">Mercado Pago</option>
            <option value="Tarjeta">Tarjeta</option>
            <option value="Nota">Nota</option>
        </select>
    </div>
</div>

<div class="col-2">
    <div class="form-group">
        <label for="nota">Nota</label>
        <textarea class="form-control" id="nota_pago" name="nota_pago" rows="2"></textarea>
    </div>
</div>

<div class="col-6">
    <div class="form-group">
        <label for="nota">Foto</label>
        <input type="file" id="foto" class="form-control" name="foto">
    </div>
</div>
