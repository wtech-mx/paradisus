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
        <h5>Ticket #{{ $nota_pedido->id }}</h5>
        <h5>Fecha: {{$nota_pedido->fecha}}</h5>
        <h5>Cosmetologa: {{ $nota_pedido->User->name }}</h5>
        <h5>Cliente: {{ $nota_pedido->Client->name }} {{ $nota_pedido->Client->last_name }}</h5><br>
        <h5>{{ $nota_pedido->fecha }}</h5><br>

        @foreach ($pedido as $item)
        @if ($item->id_nota == $nota_pedido->id)
        <p style="font-size: 13px">
            <strong>Concepto:   </strong> <br>  {{$item->concepto}} <br>
            <strong>Cantidad:   </strong> <br>  {{$item->cantidad}} <br>
            <strong>Importe: </strong> <br>    {{$item->importe}} <br>
            <strong> ------------------------------------------- </strong>
        </p>
        @endif
        @endforeach

        <p style="font-size: 16px">
            <strong>Metodo de pago: </strong> <br>  {{$nota_pedido->metodo_pago}}<br>
            <strong>Total: </strong> <br>  {{$nota_pedido->total}} <br> <br>
        </p>

        <p class="centrado" style="font-size: 15px"><br>¡GRACIAS POR SU COMPRA!</p>
    </div>
</body>

</html>
