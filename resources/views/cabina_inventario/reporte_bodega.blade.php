<!doctype html>
<html lang="en">
<head>
  <style>
    body{
      font-family: sans-serif;
    }
    @page {
      margin: 160px 50px;
    }
    header { position: fixed;
      left: 0px;
      top: -160px;
      right: 0px;
      height: 100px;
      background-color: #CA87A6;
      color: #fff;
      text-align: center;
    }
    header h1{
      margin: 10px 0;
    }
    header h2{
      margin: 0 0 10px 0;
    }
    footer {
      position: fixed;
      left: 0px;
      bottom: -50px;
      right: 0px;
      height: 40px;
      border-bottom: 2px solid #CA87A6;
    }
    footer .page:after {
      content: counter(page);
    }
    footer table {
      width: 100%;
    }
    footer p {
      text-align: right;
    }
    footer .izq {
      text-align: left;
    }
    table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    td, th {
    text-align: center;
    padding: 8px;
    }

    tr:nth-child(even) {
    background-color: #F7EAED;
    }

    .page-break {
            page-break-before: always;
    }
  </style>
<body>
  <header>
    <h1>Reporte de Paradisus</h1>
    <h2>Bodega</h2>
  </header>

  <footer>
    <table>
      <tr>
        <td>
            <p class="izq">
               Fecha: {{$hoy}}
            </p>
        </td>
        <td>
          <p class="page">
            Página
          </p>
        </td>
      </tr>
    </table>
  </footer>

  <div id="content">

    <h2 style="text-align: center;">Inventario Bodega</h2>
    <table class="table text-center">
        <thead style="background-color: #8b87ca; color: #fff">
            <tr>
                <th>Productos</th>
                <th>Comentario</th>
                <th>Diferencia</th>
                <th>Cantidad en bodega</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos_bodega_inv as $producto_bodega_inv)
                @php
                    if($producto_bodega_inv->diferencia == 'No se modificó la cantidad'){
                        $diferenciaConSaltoYBr = $producto_bodega_inv->diferencia;
                    }else{
                        $diferencia = $producto_bodega_inv->diferencia;

                        // Separar la cadena en dos partes usando "A:" como delimitador
                        $partes = explode('A:', $diferencia);

                        // Obtener las partes individuales
                        $textoDe = trim($partes[0]); // trim() para eliminar posibles espacios en blanco al principio o al final
                        $textoA = trim($partes[1]);
                    }

                @endphp
                <tr>
                    <td>{{$producto_bodega_inv->Productos->nombre}}</td>
                    <td>{{$producto_bodega_inv->comentario}}</td>
                    <td>
                        @if($producto_bodega_inv->diferencia == 'No se modificó la cantidad')
                            {{$diferenciaConSaltoYBr}}
                         @else
                            {{$textoDe}} <br> A: {{$textoA}}
                         @endif
                    </td>
                    <td>{{$producto_bodega_inv->cantidad}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

  </div>
</body>
</html>
