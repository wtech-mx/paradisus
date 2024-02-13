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
  </style>
<body>
  <header>
    <h1>Reporte de Paradisus</h1>
    <h2>Inventario</h2>
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

    <table class="table text-center">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>Productos por agotar</th>
                <th>Productos En stock</th>
                <th>Agotados</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $productos_por_agotar }}</td>

                <td>{{ $productos_agotado }}</td>

                <td>{{ $productos_stock }}</td>
            </tr>
        </tbody>
    </table>

    <h2 style="text-align: center;">
        Productos Cabina 1</h2>
    <table class="table text-center">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>Estatus</th>
                <th>SKU</th>
                <th>Producto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productosinvSemana1 as $producto)
                <tr>
                    @if ($producto->estatus == NULL)
                        <td>{{ $producto->cantidad }}</td>
                    @else
                        <td>{{ $producto->estatus }}</td>
                    @endif
                    <td>{{ $producto->Productos->sku }}</td>
                    <td>{{ $producto->Productos->nombre }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">
        Productos Cabina 2</h2>
    <table class="table text-center">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>Estatus</th>
                <th>SKU</th>
                <th>Producto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productosinvSemana2 as $producto)
                <tr>
                    @if ($producto->estatus == NULL)
                        <td>{{ $producto->cantidad }}</td>
                    @else
                        <td>{{ $producto->estatus }}</td>
                    @endif
                    <td>{{ $producto->Productos->sku }}</td>
                    <td>{{ $producto->Productos->nombre }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">
        Productos Cabina 3</h2>
    <table class="table text-center">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>Estatus</th>
                <th>SKU</th>
                <th>Producto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productosinvSemana3 as $producto)
                <tr>
                    @if ($producto->estatus == NULL)
                        <td>{{ $producto->cantidad }}</td>
                    @else
                        <td>{{ $producto->estatus }}</td>
                    @endif
                    <td>{{ $producto->Productos->sku }}</td>
                    <td>{{ $producto->Productos->nombre }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">
        Productos Cabina 4</h2>
    <table class="table text-center">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>Estatus</th>
                <th>SKU</th>
                <th>Producto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productosinvSemana4 as $producto)
                <tr>
                    @if ($producto->estatus == NULL)
                        <td>{{ $producto->cantidad }}</td>
                    @else
                        <td>{{ $producto->estatus }}</td>
                    @endif
                    <td>{{ $producto->Productos->sku }}</td>
                    <td>{{ $producto->Productos->nombre }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">
        Productos Cabina 5</h2>
    <table class="table text-center">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>Estatus</th>
                <th>SKU</th>
                <th>Producto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productosinvSemana5 as $producto)
                <tr>
                    @if ($producto->estatus == NULL)
                        <td>{{ $producto->cantidad }}</td>
                    @else
                        <td>{{ $producto->estatus }}</td>
                    @endif
                    <td>{{ $producto->Productos->sku }}</td>
                    <td>{{ $producto->Productos->nombre }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">Productos Bodega</h2>
    <table class="table text-center">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>Cantidad</th>
                <th>SKU</th>
                <th>Producto</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productosSemana as $producto)
                <tr>
                    @if ($producto->cantidad == 0)
                    <td>
                        <input type="text" class="form-control input-cantidad" style="color: #e30000;background-color: #e3000040;" value="{{ $producto->cantidad }}">
                    </td>
                    @elseif ($producto->cantidad <= 2 && $producto->cantidad >= 0)
                    <td>
                        <input type="text" class="form-control input-cantidad" style="color: #c54003;background-color: #c764023b;" value="{{ $producto->cantidad }}">
                    </td>
                    @else
                    <td>
                        <input type="text" class="form-control input-cantidad" style="color: #70b06a;background-color: #6ab06d61;" value="{{ $producto->cantidad }}">
                    </td>
                    @endif
                    <td>{{ $producto->sku }}</td>
                    <td>{{ $producto->nombre }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</body>
</html>
