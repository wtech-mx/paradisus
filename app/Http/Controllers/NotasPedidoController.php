<?php

namespace App\Http\Controllers;

use App\Models\CajaDia;
use App\Models\Client;
use App\Models\NotasPedidos;
use App\Models\Pedido;
use App\Models\Reporte;
use App\Models\User;
use App\Models\NotasCosmes;
use App\Models\ProductosNAS;
use App\Models\RegCosmesSum;
use Codexshaper\WooCommerce\Models\Product;
use Session;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use GuzzleHttp\Client as GuzzleClient;

// use Automattic\WooCommerce\Client;

// use Product;
// use Codexshaper\WooCommerce\Facades\Product;

class NotasPedidoController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Capturamos los parámetros de fecha
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Verificamos si los parámetros están presentes para filtrar
        if ($startDate && $endDate) {
            // Filtramos por el rango de fechas
            $nota_pedido = NotasPedidos::whereBetween('fecha', [$startDate, $endDate])
                            ->orderBy('id', 'DESC')
                            ->get();
        } else {
            // Si no se proporcionan fechas, traemos los registros del mes actual
            $nota_pedido = NotasPedidos::whereMonth('fecha', date('m'))
                            ->whereYear('fecha', date('Y'))
                            ->orderBy('id', 'DESC')
                            ->get();
        }

        $nota_pedidoCancelado = NotasPedidos::where('estatus', '=', 'Cancelada')
                                ->orderBy('id', 'DESC')
                                ->get();

        return view('notas_pedidos.index', compact('nota_pedido', 'nota_pedidoCancelado'));
    }


    public function create()
    {
        $cosme = auth()->user();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('id', '!=', 1)->get();
        $products = ProductosNAS::get();

        return view('notas_pedidos.create', compact('cosme','user', 'client', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'phone' => [
                Rule::unique('clients')->where(function ($query) use ($request) {
                    return $query->where('phone', $request->input('phone'));
                }),
            ],
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $fechaActual = date('Y-m-d');

        if($request->get('name') != NULL){
            $client = new Client;
            $client->name = $request->get('name');
            $client->last_name = $request->get('last_name');
            $client->phone = $request->get('phone');
            $client->email = $request->get('email');
            $client->save();
        }

        $nota = new NotasPedidos;
        $nota->id_user = $request->get('id_user');

        $nota->estatus = 'Aprobada';
        $nota->aprobado_hora_y_guia = date("Y-m-d H:i:s");

        if($request->get('name') != NULL){
            $nota->id_client = $client->id;

        }else{
            $nota->id_client = $request->get('id_client');
        }

        $nota->metodo_pago = $request->get('metodo_pago');
        $nota->fecha = $fechaActual;

        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = public_path() . '/foto_producto';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $nota->foto = $fileName;
        }

        $nota->descuento = $request->get('descuento_porcentaje');
        $nota->total = $request->get('totalSuma');
        $nota->restante = $request->get('restante');
        $nota->dinero_recibido = $request->get('dinero_recibido');

        if($request->get('dinero_recibido2') > '0' ){
            $nota->dinero_recibido2 = $request->get('dinero_recibido2');
            $nota->metodo_pago2 = $request->get('metodo_pago2');

            if ($request->hasFile("foto2")) {
                $file = $request->file('foto2');
                $path = public_path() . '/foto_producto';
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $nota->foto2 = $fileName;
            }
        }
        $suma_pagos = $request->get('dinero_recibido') + $request->get('dinero_recibido2');
        if(($request->get('dinero_recibido') > $request->get('totalSuma')) && ($request->get('metodo_pago') == 'Efectivo')){
            $cambio = $request->get('dinero_recibido') - $request->get('totalSuma');
            $nota->cambio = $cambio;
        }elseif($suma_pagos > $request->get('totalSuma')){
            $cambio = $suma_pagos - $request->get('totalSuma');
            $nota->cambio = $cambio;
        }else{
            $nota->cambio = '0';
        }



        $nota->save();

        if($request->get('metodo_pago') == 'Tarjeta' or $request->get('metodo_pago2')){


            // Define las credenciales de la API
            $apiKey = '70f7c836-9e76-4303-ad9f-e9768633da6d';
            $clave = '0d32cc34-098a-455b-8873-f4c0434e44e0';
            // Genera el token de autorización
            $token = base64_encode($apiKey . ':' . $clave);

            if($request->get('name') != NULL){
               $nombre_cliente = $request->get('name');
            }else{
                $client =  Client::find($request->get('id_client'));
                $nombre_cliente = $client->name;
            }

            $cajera_id =  User::find($nota->id_user);
            $cajera = $cajera_id->name;


            $amount = $nota->total;
            $assigned_user = 'ventas@paradisus.com.mx';
            $reference = $nota->id;
            $message = 'Nota Product :#'.$nota->id.' / Cajero : '.$cajera.' / Cliente : '.$nombre_cliente;

            // Realiza la solicitud GET a la API de Clip
            $client = new GuzzleClient();

            // Formatear los datos como JSON
            $data_items = [
                'amount' => (int)$amount,
                'assigned_user' => $assigned_user,
                'reference' => $reference,
                'message' => $message
            ];

            $jsonData = json_encode($data_items);

            $response = $client->request('POST', 'https://api-gw.payclip.com/paymentrequest', [
                'body' => $jsonData,
                'headers' => [
                    'accept' => 'application/vnd.com.payclip.v1+json',
                    'content-type' => 'application/json; charset=UTF-8',
                    'x-api-key' => 'Basic ' . $token,
                  ],

            ]);

            $body = $response->getBody()->getContents();

            // Decodificar el cuerpo si es JSON
            $data = json_decode($body, true);

        }

        // G U A R D A R  C A M B I O
        $suma_pagos = $request->get('dinero_recibido') + $request->get('dinero_recibido2');

        if($request->get('dinero_recibido') > $request->get('totalSuma') && $request->get('metodo_pago') == 'Efectivo'){
            $cambio = $request->get('dinero_recibido') - $request->get('totalSuma');
            $fechaActual = date('Y-m-d');
            $caja = new CajaDia;
            $caja->motivo = 'Retiro';
            $caja->egresos = $cambio;
            $caja->concepto = 'Cambio nota productos: ' . $nota->id;
            $caja->fecha = $fechaActual;
            $caja->save();
        }elseif($suma_pagos > $request->get('totalSuma')){
            $cambio = $suma_pagos - $request->get('totalSuma');
            $fechaActual = date('Y-m-d');
            $caja = new CajaDia;
            $caja->motivo = 'Retiro';
            $caja->egresos = $cambio;
            $caja->concepto = 'Cambio nota productos: ' . $nota->id;
            $caja->fecha = $fechaActual;
            $caja->save();
        }

        $concepto = $request->get('concepto');
        $cantidad = $request->get('cantidad');
        $importe = $request->get('importe');

        for ($count = 0; $count < count($concepto); $count++) {
            $data = array(
                'id_nota' => $nota->id,
                'concepto' => $concepto[$count],
                'cantidad' => $cantidad[$count],
                'importe' => $importe[$count],
            );
            $insert_data[] = $data;
        }

        Pedido::insert($insert_data);

        $pedidos = Pedido::where('id_nota', '=', $nota->id)->get();

        $user_cosme = User::where('id','=',$request->get('id_user'))->first();

        foreach ($pedidos as $item) {

            $pedido = [];

            $pedido[] = $item->cantidad;
            $pedido[] = $item->concepto;
            $pedido[] = $item->importe;

            $pedido_paquetes_data[] = [
                'pedido' => $pedido,
            ];
        }

        $recibo = [
            "id" => $nota->id,
            "fecha" => $nota->fecha,
            "Metodo_pago" => $nota->metodo_pago,
            "Metodo_pago_2" => $request->get('metodo_pago2'),
            "Cliente" => $nota->Client->name,
            "Total" => $nota->total,
            "Restante" => $nota->restante,
            "Cambio" => $nota->cambio,
            "dinero_recibido" => $nota->dinero_recibido,
            "nombreImpresora" => "ZJ-58",
            'pago' => $pedido_paquetes_data,
            'cosmetologa' => $user_cosme->name,
            // Agrega cualquier otro dato necesario para el recibo
        ];

        //==============================COMISIONES POR VENTA ==================================================
        if($request->get('id_user') == 14 || $request->get('id_user') == 16 || $request->get('id_user') == 21 || $request->get('id_user') == 26){
        }else{
            $notaTotal = $nota->total;

            // Define las escalas y porcentajes de comisión
            $escalasComision = [
                ['min' => 2000, 'max' => 2999, 'porcentaje' => 0.03],
                ['min' => 3000, 'max' => 3999, 'porcentaje' => 0.05],
                ['min' => 4000, 'max' => 6999, 'porcentaje' => 0.06],
                ['min' => 7000, 'max' => 7999, 'porcentaje' => 0.07],
                ['min' => 8000, 'max' => 8999, 'porcentaje' => 0.08],
                ['min' => 9000, 'max' => 9999, 'porcentaje' => 0.09],
                ['min' => 10000, 'porcentaje' => 0.10],
            ];
            $fecha = date('Y-m-d');
            // Encuentra la escala correspondiente
            $escalaActual = null;
            foreach ($escalasComision as $escala) {
                if (isset($escala['max']) && $notaTotal >= $escala['min'] && $notaTotal <= $escala['max']) {
                    $escalaActual = $escala;
                    break;
                } elseif (!isset($escala['max']) && $notaTotal >= $escala['min']) {
                    $escalaActual = $escala;
                    break;
                }
            }

            // Calcula el monto de la comisión
            if ($escalaActual) {
                $montoComision = $notaTotal * $escalaActual['porcentaje'];
                // Ahora puedes usar $montoComision en tu código
                $registroSemanal = new RegCosmesSum;
                $registroSemanal->id_cosme = $request->get('id_user');
                $registroSemanal->tipo = 'Extra';
                $registroSemanal->concepto = 'Bono Venta Producto en nota: ' . $nota->id;
                $registroSemanal->id_nota = $nota->id;
                $registroSemanal->fecha = $fecha;
                $registroSemanal->monto = $montoComision;
                $registroSemanal->save();
            }
        }

        // Devuelve los datos en formato JSON
        return response()->json(['success' => true, 'recibo' => $recibo]);

        // Session::flash('success', 'Se ha guardado sus datos con exito');
        // return redirect()->route('notas_pedidos.index')
        //                 ->with('success','Nota Productos Creado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nota = NotasPedidos::find($id);

        return view('notas_pedidos.show', compact('nota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Notas $nota
     * @return \Illuminate\Http\Response
     */

    public function edit($id){
         $cosme = auth()->user();
         $nota_pedido = NotasPedidos::find($id);
         $pedido = Pedido::get();
         $nota_pedido_cosme = NotasPedidos::where('id_user', '=',$cosme->id)->get();
         $client = Client::orderBy('name','ASC')->get();
         $user = User::where('id', '!=', 1)->get();

         return view('notas_pedidos.edit', compact('pedido', 'cosme', 'client','user','nota_pedido', 'nota_pedido_cosme'));
     }

     public function imprimir($id){
        $cosme = auth()->user();
        $nota_pedido = NotasPedidos::find($id);
        $pedido = Pedido::get();
        $nota_pedido_cosme = NotasPedidos::where('id_user', '=',$cosme->id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::get();

        $pdf = PDF::loadView('notas_pedidos.recibo_pdf_print',compact('pedido', 'cosme', 'client','user','nota_pedido', 'nota_pedido_cosme'));

        // Para cambiar la medida se deben pasar milimetros a putnos
        $pdf->setPaper([0, 0, 165, 500], 'portrait'); // Ancho: 58 mm, Alto: 500 mm (ajustar según tus necesidades)

        return $pdf->download('Recibo_'.$id.'.pdf');
    }

    public function update(Request $request, $id)
    {

        $nota = NotasPedidos::find($id);

        $concepto = $request->get('concepto');
        $cantidad = $request->get('cantidad');
        $importe = $request->get('importe');

        for ($count = 0; $count < count($concepto); $count++) {
            $data = array(
                'id_nota' => $nota->id,
                'cantidad' => $cantidad[$count],
                'concepto' => $concepto[$count],
                'importe' => $importe[$count],
            );
            $insert_data[] = $data;
        }

        Pedido::insert($insert_data);

        $sum = 0;
        $nota = NotasPedidos::find($nota->id);
        if($request->get('descuento_porcentaje') == NULL){
            $sum =array_sum($importe) + $nota->total;
        }else{
            $suma =array_sum($importe) + $nota->total;
            $descuento = ($suma * $request->get('descuento_porcentaje')) / 100;
            $total_final = $suma - $descuento;
            $sum = $total_final;
        }
        $nota->total = $sum;
        $nota->descuento = $request->get('descuento_porcentaje');
        $nota->metodo_pago = $request->get('metodo_pago');
        $nota->dinero_recibido = $request->get('dinero_recibido');
        $nota->metodo_pago2 = $request->get('metodo_pago2');
        $nota->dinero_recibido2 = $request->get('dinero_recibido2');

        if ($request->hasFile("foto")) {
            $file = $request->file('foto');
            $path = public_path() . '/foto_producto';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $nota->foto = $fileName;
        }
        $nota->update();

        // G U A R D A R  C A M B I O
        $suma_pagos = $request->get('dinero_recibido') + $request->get('dinero_recibido2');

        if($request->get('dinero_recibido') > $nota->total && $request->get('metodo_pago') == 'Efectivo'){
            $cambio = $request->get('dinero_recibido') - $nota->total;
            $fechaActual = date('Y-m-d');
            $caja = new CajaDia;
            $caja->motivo = 'Retiro';
            $caja->egresos = $cambio;
            $caja->concepto = 'Cambio nota productos: ' . $nota->id;
            $caja->fecha = $fechaActual;
            $caja->save();
        }elseif($suma_pagos > $nota->total){
            $cambio = $suma_pagos - $nota->total;
            $fechaActual = date('Y-m-d');
            $caja = new CajaDia;
            $caja->motivo = 'Retiro';
            $caja->egresos = $cambio;
            $caja->concepto = 'Cambio nota productos: ' . $nota->id;
            $caja->fecha = $fechaActual;
            $caja->save();
        }

        return redirect()->back()
        ->with('edit','Nota Productos Actualizado.');
    }

    public function update_estatus(Request $request, $id){
        $nota = NotasPedidos::find($id);
        $nota->estatus = $request->get('estatus_cotizacion');
        $nota->update();

        return redirect()->back()->with('edit','Nota Productos Actualizado.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
//         $pago = Pagos::where('id_nota', '=', $id)->delete();
// dd($pago);
        // for(){

        // }

        $nota = NotasPedidos::find($id)->delete();

        Session::flash('delete', 'Se ha eliminado sus datos con exito');
        return redirect()->route('notas_pedidos.index')
            ->with('success', 'nota deleted successfully');
    }
}
