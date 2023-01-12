<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\Caja;
use App\Models\Pagos;
use DB;
use App\Models\Client;
use App\Models\Notas;
use App\Models\NotasPedidos;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fechaActual = date('m');

        $caja = Caja::get();
        $clientes = Client::get();
        $pago = Pagos::get();
        $pago_pedidos = NotasPedidos::get();

        $servicios_individual = Notas::
        select(DB::raw('count(*) as filas'), DB::raw("DATE_FORMAT(fecha,'%c') as mes"), 'id_servicio')
        ->groupBy('mes')
        ->groupBy('id_servicio')
        ->get();

        $pedidos_total = DB::table('notas_pedidos')
        ->select(DB::raw('SUM(total) as total'), DB::raw("DATE_FORMAT(fecha,'%c') as months"))
        ->groupBy('months')
        ->get();

        // $data = [];
        // foreach($pedidos_total as $ped){
        //     $data['label'][] = $ped->months;
        //     $data['data'][] = $ped->total;
        // }
        // $data[] = json_encode($data);

        $servicios_total = DB::table('pagos')
        ->select(DB::raw("DATE_FORMAT(fecha,'%c') as mes"), DB::raw('SUM(pago) as pago'))
        ->groupBy('mes')
        ->get();
        return view('reportes.index', compact('fechaActual' ,'caja', 'pago', 'pago_pedidos', 'clientes', 'pedidos_total', 'servicios_individual', 'servicios_total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function show(Reporte $reporte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function edit(Reporte $reporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reporte $reporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reporte $reporte)
    {
        //
    }
}
