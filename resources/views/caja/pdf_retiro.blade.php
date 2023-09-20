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
        <h5>Retiro</h5>
        <p><strong>Recepcionista: </strong> <br> {{ auth()->user()->name }}<br> <br></p>

        <p style="font-size: 13px">
            <strong>Retiro:   </strong> <br> ${{  $caja->egresos }}.0 <br> <br>
            <strong>Concepto:   </strong> <br>  {{ $caja->concepto }} <br> <br>
        </p>



    </div>
</body>

</html>
