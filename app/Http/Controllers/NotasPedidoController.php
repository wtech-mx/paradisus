<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\NotasPedidos;
use App\Models\Pedido;
use App\Models\User;
use Codexshaper\WooCommerce\Models\Product;
use Session;
use Illuminate\Http\Request;

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
        $cosme = auth()->user();
        $nota_pedido = NotasPedidos::orderBy('id','DESC')->get();
        $pedido = Pedido::get();
        $nota_pedido_cosme = NotasPedidos::where('id_user', '=',$cosme->id)->get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::get();

        return view('notas_pedidos.index', compact('pedido', 'cosme', 'client','user','nota_pedido', 'nota_pedido_cosme'));
    }

    public function create()
    {
        $cosme = auth()->user();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::get();

        // $woocomerce = new Product(
        //     'https://imnasmexico.com/new/wp-json/wc/v3/products?category=202',
        //     'ck_9868525631eee54f198be17abf22ee6e2a1bb221',
        //     'cs_7b2f0584b817cf11e6dabae2d113b72e6315f186',
        //     [
        //         'wp_api' => true,
        //         'version' => 'wc/v3',
        //         'query_string_auth' => true,
        //     ]
        // );

        //  //Trae datos de db to jason
        //  $product_bandas = $data2['products'] = $woocomerce->all(['per_page'=> '50','category'=>'213']);
        //  $product_bb = $data2['products'] = $woocomerce->all(['per_page'=> '50','category'=>'223']);
        //  $product_keraluxe = $data2['products'] = $woocomerce->all(['per_page'=> '50','category'=>'224']);
        //  $product_limp = $data2['products'] = $woocomerce->all(['per_page'=> '50','category'=>'222']);
        //  $product_apoyo = $data2['products'] = $woocomerce->all(['per_page'=> '50','category'=>'218']);
        //  $product_loci = $data2['products'] = $woocomerce->all(['per_page'=> '50','category'=>'206']);
        //  $product_mas = $data2['products'] = $woocomerce->all(['per_page'=> '50','category'=>'193']);
        //  $product_paque = $data2['products'] = $woocomerce->all(['per_page'=> '50','category'=>'187']);
        //  $product_sueros = $data2['products'] = $woocomerce->all(['per_page'=> '50','category'=>'197']);

        //  //los convieerte en array
        //  $decode = json_decode($product_bandas);
        //  $decode2 = json_decode($product_bb);
        //  $decode3 = json_decode($product_keraluxe);
        //  $decode4 = json_decode($product_limp);
        //  $decode5 = json_decode($product_apoyo);
        //  $decode6 = json_decode($product_loci);
        //  $decode7 = json_decode($product_mas);
        //  $decode8 = json_decode($product_paque);
        //  $decode9 = json_decode($product_sueros);

        //  //Une los array en uno solo
        //  $resultado = array_merge($decode,$decode2,$decode3,$decode4,$decode5,$decode6,$decode7,$decode8,$decode9);
        //  $json = json_encode($resultado);
        //  $json2 = json_decode($json);

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

        $nota->save();

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

        $sum = 0;
        $sum =array_sum($importe);
        $nota = NotasPedidos::find($nota->id);
        $nota->total = $sum;
        $nota->update();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('notas_pedidos.index')
                        ->with('success','Nota Productos Creado.');
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

    public function update(Request $request, $id)
    {

        $nota = NotasPedidos::find($id);
        // $nota->id_user = $request->get('id_user');
        // $nota->id_client = $request->get('id_client');
        // $nota->metodo_pago = $request->get('metodo_pago');
        // $nota->fecha = $request->get('fecha');
        // $nota->update();

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
