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

<body>
    <div class="ticket left" style="padding: 15px">
        <h3>Paradisus - Laser</h3> <br>
        <h5>Ticket #{{ $nota_laser->id }}</h5>
        <h5>Fecha: {{$nota_laser->fecha}}</h5>
        <h5>Cosmetologa: {{ $nota_laser->User->name }}</h5>
        <h5>Cliente: {{ $nota_laser->Client->name }} {{ $nota_laser->Client->last_name }}</h5><br>
        <h5>{{ $nota_laser->tipo }}</h5><br>
        <strong> ------------------------------------------- </strong>

        @foreach ($pagos as $item)
            <p style="font-size: 13px">
                <strong>Fecha:   </strong> <br> {{ $item->fecha }} <br> <br>
                <strong>Pago:   </strong> <br>  ${{ $item->pago }}.0 <br> <br>
                <strong>Cambio:   </strong> <br>  ${{ $item->cambio }}.0 <br> <br>
                <strong>Met. Pago: </strong> <br>    {{ $item->forma_pago }} <br> <br>
                <strong> ------------------------------------------- </strong>
            </p>
        @endforeach

        <p style="font-size: 13px">
            <strong>Total:   </strong> <br>  ${{ $nota_laser->total }}.0 <br> <br>
            <strong>Restante:   </strong> <br> ${{  $nota_laser->restante }}.0 <br> <br>
            <strong> ------------------------------------------- </strong>
        </p>

        @foreach ($zonas_laser as $item)
            <p style="font-size: 13px">
                <strong>Zona:   </strong> <br>  {{$item->Zona->zona}} <br>
                <strong>Sesiones Compradas:   </strong> <br>  {{$item->sesiones_compradas}} <br>
                <strong>Sesiones Restante: </strong> <br>    {{$item->sesiones_restantes}} <br>
                <strong> ------------------------------------------- </strong>
            </p>
        @endforeach

        <p class="centrado" style="font-size: 15px"><br>¡GRACIAS POR SU COMPRA!</p>
    </div>
</body>

</html>
