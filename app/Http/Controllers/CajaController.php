<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caja;
use App\Models\CajaDia;
use App\Models\NotasPedidos;
use App\Models\Pagos;
use Session;

class CajaController extends Controller
{
    public function index()
    {
        $fechaActual = date('Y-m-d');

        $caja = Caja::get();
        $pago = Pagos::where('fecha', '=', $fechaActual)->where('forma_pago', '=', 'Efectivo')->get();
        $pago_pedidos = NotasPedidos::where('fecha', '=', $fechaActual)->where('metodo_pago', '=', 'Efectivo')->get();
        $caja_dia = CajaDia::get();

        return view('caja.index', compact('caja', 'pago', 'caja_dia', 'pago_pedidos'));
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
            'egresos' => 'required',
            'concepto' => 'required'
        ]);

        $fechaActual = date('Y-m-d');
        $caja = new CajaDia;
        $caja->egresos = $request->get('egresos');
        $caja->concepto = $request->get('concepto');
        $caja->fecha = $fechaActual;
        $caja->save();

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('caja.index')
            ->with('success', 'caja created successfully.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  caja $caja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, caja $caja, $id)
    {

        $caja = Caja::find($id);
        $input = $request->all();
        $caja->update($input);

        Session::flash('edit', 'Se ha editado sus datos con exito');
        return redirect()->route('caja.index')
            ->with('success', 'caja updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $client = Caja::find($id)->delete();

        Session::flash('delete', 'Se ha eliminado sus datos con exito');
        return redirect()->route('caja.index')
            ->with('success', 'Client deleted successfully');
    }
}
