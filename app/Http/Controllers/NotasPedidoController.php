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
        $nota_pedido = NotasPedidos::orderBy('id','DESC')->get();
        $pedido = Pedido::get();
        $client = Client::get();
        //$products = Product::get();
        // dd($products);
        $fechaActual = date('N');
        if($fechaActual == '1'){
            $user = User::join('horario', 'users.id', '=', 'horario.id_user')
            ->where('horario.lunes', '=', 1)
            ->get();
        }elseif($fechaActual == '2'){
            $user = User::join('horario', 'users.id', '=', 'horario.id_user')
            ->where('horario.martes', '=', 1)
            ->get();
        }elseif($fechaActual == '3'){
            $user = User::join('horario', 'users.id', '=', 'horario.id_user')
            ->where('horario.miercoles', '=', 1)
            ->get();
        }elseif($fechaActual == '4'){
            $user = User::join('horario', 'users.id', '=', 'horario.id_user')
            ->where('horario.jueves', '=', 1)
            ->get();
        }elseif($fechaActual == '5'){
            $user = User::join('horario', 'users.id', '=', 'horario.id_user')
            ->where('horario.viernes', '=', 1)
            ->get();
        }elseif($fechaActual == '6'){
            $user = User::join('horario', 'users.id', '=', 'horario.id_user')
            ->where('horario.sabado', '=', 1)
            ->get();
        }elseif($fechaActual == '7'){
            $user = User::join('horario', 'users.id', '=', 'horario.id_user')
            ->where('horario.domingo', '=', 1)
            ->get();
        }

        return view('notas_pedidos.index', compact('pedido', 'user', 'client', 'nota_pedido'));
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
        $nota = new NotasPedidos;
        $nota->id_user = $request->get('id_user');
        $nota->id_client = $request->get('id_client');
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
