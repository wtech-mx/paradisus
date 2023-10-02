<?php

namespace App\Http\Controllers;

use App\Models\CajaDia;
use App\Models\Client;
use App\Models\NotasPedidos;
use App\Models\Pedido;
use App\Models\Reporte;
use App\Models\User;
use App\Models\NotasCosmes;
use Codexshaper\WooCommerce\Models\Product;
use Session;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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
    public function index()
    {
        $nota_pedido = NotasPedidos::orderBy('id','DESC')->get();

        return view('notas_pedidos.index', compact('nota_pedido'));
    }

    public function create()
    {
        $cosme = auth()->user();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::get();

        return view('notas_pedidos.create', compact('cosme','user', 'client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_user' => 'required',
            'id_client' => 'required',
        ]);

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

        $nota->total = $request->get('totalSuma');
        $nota->restante = $request->get('restante');
        $nota->cambio = $request->get('cambio');
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

        $nota->save();

        // G U A R D A R  C A M B I O
        if($request->get('cambio') > '0'){
            $fechaActual = date('Y-m-d');
            $caja = new CajaDia;
            $caja->motivo = 'Retiro';
            $caja->egresos = $request->get('cambio');
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

        $nota_cosme = NotasCosmes::where('id_nota', '=', $nota->id)
        ->get();


        foreach ($nota_cosme as $notacosme){
            $cadena = $notacosme->User->name;
        }

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
            'cosmetologa' => $cadena,
            // Agrega cualquier otro dato necesario para el recibo
        ];

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
         $user = User::get();

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
        $sum =array_sum($importe) + $nota->total;
        $nota->total = $sum;
        $nota->update();

        $reporte = new Reporte;
        $reporte->id_producto = $nota->id;
        $reporte->fecha = $nota->fecha;
        $reporte->tipo = 'NOTA PRODUCTOS';
        $reporte->id_client = $nota->id_client;
        $reporte->metodo_pago = $nota->forma_pago;
        $reporte->monto = $nota->total;
        $reporte->restante = 0;
        $reporte->save();

        return redirect()->route('notas_pedidos.index')
        ->with('edit','Nota Productos Actualizado.');
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
