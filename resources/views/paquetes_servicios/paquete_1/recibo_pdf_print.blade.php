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
        <h3>Paradisus</h3> <br>
        <h5>Ticket # </h5>
        <h5>Fecha inicial: {{ $paquete->fecha_inicial }}</h5>
        <h5>Cliente: {{ $paquete->Client->name }} {{ $paquete->Client->last_name }} </h5><br>

        <p style="display: none">{{ $resultado = 0; }}</p>

        @foreach ($pago as $item)
        <p style="display: none">{{ $resultado += $item->pago; }}</p>
        <p style="font-size: 13px">
            <strong>Fecha:   </strong> <br>  {{$item->fecha}} <br>
            <strong>Cosmetologas:   </strong> <br> {{ $item->User->name }} <br>
            <strong>Pago: </strong> <br>    {{$item->pago}} <br>
            <strong>Metodo: </strong> <br>    {{$item->forma_pago}} <br>
            <strong>Nota: </strong> <br>    {{$item->nota}} <br>
            <strong> ------------------------------------------- </strong>
        </p>
        @endforeach
        <p style="font-size: 16px">
            <strong>Saldo a favor: </strong> <br>  $ {{ $resultado; }} .00  MXN <br>
            <strong>Restante: </strong> <br>  ${{$paquete->restante}} .00  MXN <br> <br>
        </p>

        <p class="centrado" style="font-size: 15px"><br>¡GRACIAS POR SU COMPRA!</p>
    </div>
</body>

</html>
