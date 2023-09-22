<div class="col-1">
    <div class="form-check">
        <label class="custom-control-label" for="descuento" style="font-size: 15px;">Contado</label><br>
        <input class="form-check-input" type="checkbox" name="es-contado" id="es-contado" value="1">
    </div>
</div>

<div class="col-3">
    <div class="form-group">
        <label for="total-suma">Total a Pagar</label>
        <input type="text" id="total-suma" name="total-suma" class="form-control" value="${{$servicio->precio}}" readonly>
    </div>
</div>

<div class="col-4">
    <div class="form-group">
        <label for="restante">Restante</label>
        <input type="text" id="restante" name="restante" class="form-control" readonly>
    </div>
</div>

<div class="col-4">
    <div class="form-group">
        <label for="restante">Cambio</label>
        <input type="text" id="cambio" name="cambio" class="form-control" readonly>
    </div>
</div>

<div class="col-3">
    <div class="form-group">
        <label for="fecha">Fecha</label>
        <input  id="fecha_pago" name="fecha_pago" type="date" class="form-control" value="{{$fechaActual}}">
    </div>
</div>

<div class="col-3">
    <div class="form-group">
        <label for="fecha">Cosme</label>
        <select class="form-control"  data-toggle="select" id="id_user" name="id_user">
            <option value="">Seleccionar</option>
            @foreach ($user as $item)
                <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="col-2">
    <div class="form-group">
        <label for="pago">Pago</label>
        <input  id="pago" name="pago" type="text" class="form-control" required>
    </div>
</div>

<div class="col-2">
    <div class="form-group">
        <label for="num_sesion">Metodo Pago</label>
        <select id="forma_pago" name="forma_pago" class="form-control">
            <option value="Efectivo">Efectivo</option>
            <option value="Transferencia">Transferencia</option>
            <option value="Mercado Pago">Mercado Pago</option>
            <option value="Tarjeta">Tarjeta</option>
            <option value="Gift Card">Gift Card</option>
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
