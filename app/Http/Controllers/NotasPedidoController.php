<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\NotasPedidos;
use App\Models\Pedido;
use App\Models\User;
use Session;
use Illuminate\Http\Request;
use Product;

class NotasPedidoController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nota_pedido = NotasPedidos::paginate();
        $pedido = Pedido::paginate();
        $user = User::get();
        $client = Client::get();
        //$products = Product::get();
        // dd($products);

        return view('notas_pedidos.index', compact('pedido', 'user', 'client', 'nota_pedido'))
            ->with('i', (request()->input('page', 1) - 1) * $nota_pedido->perPage());
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

        $nota = new NotasPedidos;
        $nota->id_user = $request->get('id_user');
        $nota->id_client = $request->get('id_client');
        $nota->metodo_pago = $request->get('metodo_pago');
        $nota->fecha = $request->get('fecha');

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
                        ->with('success','User created successfully');
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
        $this->validate($request, [
            'id_user' => 'required',
            'id_client' => 'required',
            'id_servicio' => 'required'
        ]);

        $nota = NotasPedidos::find($id);
        $nota->id_user = $request->get('id_user');
        $nota->id_client = $request->get('id_client');
        $nota->metodo_pago = $request->get('metodo_pago');
        $nota->fecha = $request->get('fecha');
        $nota->update();

        $concepto = $request->get('concepto');
        $cantidad = $request->get('cantidad');
        $importe = $request->get('importe');

        for ($count = 0; $count < count($concepto); $count++) {
            $data = array(
                'id_nota' => $nota->id,
                'fecha' => $concepto[$count],
                'cantidad' => $cantidad[$count],
                'importe' => $importe[$count],
            );
            $insert_data[] = $data;
        }

        Pedido::insert($insert_data);

        return redirect()->route('notas_pedidos.index')
        ->with('edit','nota Has Been updated successfully');
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
