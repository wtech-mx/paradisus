<div class="row text-center">
    <div class="col-2" style="background-color: #bb546c; color: #fff;">Fecha</div>
    <div class="col-2" style="background-color: #bb546c; color: #fff;">Usuario</div>
    <div class="col-2" style="background-color: #bb546c; color: #fff;">Pago</div>
    <div class="col-2" style="background-color: #bb546c; color: #fff;">Metodo </div>
    <div class="col-2" style="background-color: #bb546c; color: #fff;">Nota</div>
    <div class="col-1" style="background-color: #bb546c; color: #fff;">Foto</div>
    <div class="col-1" style="background-color: #bb546c; color: #fff;">Firma</div>


    <p style="display: none">{{ $resultado = 0; }}</p>
    @foreach ($pago as $item)
        <input  id="pago_id" name="pago_id" type="hidden"  class="form-control" value="{{$item->id}}">
        <p style="display: none">{{ $resultado += $item->pago; }}</p>

        <div class="col-2 py-2" ><input name="fecha_pago" type="date" class="form-control text-center" id="fecha_pago"
                value="{{$item->fecha}}" disabled>
        </div>

        <div class="col-2 py-2" >
            <select class="form-control toggle-class" id="cosmetologa" name="cosmetologa" disabled>
                <option value="{{$item->cosmetologa}}">{{ $item->User->name }}</option>
                @foreach ($user as $cosmes)
                    <option value="{{ $cosmes->id }}" >{{ $cosmes->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-2 py-2" >
            <input name="pago" type="number" class="form-control text-center" id="pago"
                value="{{$item->pago}}" disabled></div>

        <div class="col-2 py-2" ><input name="forma_pago" type="text" class="form-control text-center" id="forma_pago"
            value="{{$item->forma_pago}}" disabled>
        </div>

        <div class="col-2 py-2" ><textarea class="form-control text-center" name="nota" id="nota" cols="3" rows="1" disabled>{{$item->nota}}</textarea>

        </div>

        <div class="col-1 py-2">
            @if ($item->foto == NULL)
                <a href=""></a>
            @else
                <a target="_blank" href="{{asset('foto_paquetes/'.$item->foto)}}">Ver</a>
            @endif
        </div>
        <div class="col-1 py-2">
            @if ($item->firma == NULL)
                <a href=""></a>
            @else
                <a target="_blank" href="{{asset('firma_pago/'.$item->firma)}}">Ver</a>
            @endif
        </div>
    @endforeach
</div>

<div class="col-3">
    <div class="form-group">
        <label for="total-suma">Total a Pagar</label>
        <input type="text" id="total-suma" name="total-suma" class="form-control" readonly value="{{$paquete->monto}}">
    </div>
</div>

<div class="col-3">
    <div class="form-group">
        <label for="restante">Saldo a favor</label>
        <input type="text" class="form-control" readonly value="$ {{ $resultado; }} MXN">
    </div>
</div>

<div class="col-3">
    <div class="form-group">
        <label for="restante">Restante</label>
        <input type="text" id="restante" name="restante_paquetes" class="form-control" readonly value="{{$paquete->restante}}">
    </div>
</div>

<div class="col-3">
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
            <option value="{{ $paquete2->talla1_a }}">Seleccionar</option>
            @foreach ($user as $item)
                <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="col-2">
    <div class="form-group">
        <label for="pago">Pago</label>
        <input  id="nuevo-pago" name="pago" type="text" class="form-control">
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
