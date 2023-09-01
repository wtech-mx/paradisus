<?php
$medidaTicket = 180;
?>
<!DOCTYPE html>
<html>

<head>

    <style>
        h1 {
            font-size: 18px;
        }

        .ticket {
            margin: 2px;
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
            margin: 0 auto;
        }

        td.precio {
            text-align: right;
            font-size: 9px;
        }

        td.cantidad {
            font-size: 9px;
        }

        td.producto {
            text-align: center;
        }

        th {
            text-align: center;
        }


        .centrado {
            text-align: center;
            align-content: center;
        }

        .left {
            text-align: left;
            align-content: left;
        }

        .ticket {
            width: {{ $medidaTicket }}px;
            max-width: {{ $medidaTicket }}px;
        }

        * {
            margin: 0;
            padding: 0;
        }

        .ticket {
            margin: 0;
            padding: 0;
        }

        body {
            text-align: left;
        }
    </style>
</head>

@foreach ($nota_cosme as $nota)
@php
    $cadena = $nota->User->name;
    $cadenaExplode = explode(" ", $cadena);
    $ultimoElemento = end($cadenaExplode);
@endphp
@endforeach

<body>
    <div class="ticket left" style="padding: 15px">
        <h3>Paradisus</h3> <br>
        <h5>Ticket #{{ $notas_pedidos->id }}</h5>
        <p><strong>Cliente:   </strong> <br> {{ $notas_pedidos->Client->name }} {{ $notas_pedidos->Client->last_name }}<br> <br></p>

        <p style="font-size: 13px">
            <strong>Cosmetologa:   </strong> <br> {{  $ultimoElemento }} <br> <br>
            <strong>Total:   </strong> <br>  ${{ $notas_pedidos->precio }}.0 <br> <br>
            <strong>Restante:   </strong> <br> ${{  $notas_pedidos->restante }}.0 <br> <br>
            <strong> ------------------------------------------- </strong>
        </p>

        @foreach ($pago as $item)
        <p style="font-size: 13px">
            <strong>Fecha:   </strong> <br> {{ $item->fecha }} <br> <br>
            <strong>Pago:   </strong> <br>  ${{ $item->pago }}.0 <br> <br>
            <strong>Cambio:   </strong> <br>  ${{ $item->cambio }}.0 <br> <br>
            <strong>Met. Pago: </strong> <br>    {{ $item->forma_pago }} <br> <br>
            <strong> ------------------------------------------- </strong>
        </p>
        @endforeach

        @foreach($notas_paquetes as $item)

        <p style="font-size: 13px">
        <strong>-</strong> <br>  {{ $item->Servicios->nombre }} <br> <br>

        @if($item->id_servicio2 != NULL || $item->id_servicio2 != 0)
        <strong>-</strong> <br>  {{ $item->Servicios2->nombre }} <br> <br>

        @endif
        @if($item->id_servicio3 != NULL || $item->id_servicio3 != 0)
        <strong>-</strong> <br>  {{ $item->Servicios3->nombre }} <br> <br>

        @endif
        @if($item->id_servicio4 != NULL || $item->id_servicio4 != 0)
        <strong>-</strong> <br>  {{ $item->Servicios4->nombre }} <br> <br>
        @endif
        </p>

        @endforeach


        <p class="centrado" style="font-size: 15px"><br>¡GRACIAS POR SU VISITA!</p>
    </div>
</body>

</html>
