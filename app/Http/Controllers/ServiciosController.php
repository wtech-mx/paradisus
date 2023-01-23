<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use Illuminate\Http\Request;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Session;

class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicio = Servicios::get();
        $servicio_promo = Servicios::where('act_descuento', '=', '1')->get();

        return view('servicios.index', compact('servicio', 'servicio_promo'));
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
            'nombre' => 'required',
            'precio' => 'required',
            'duracion' => 'required',
            'color' => 'required'
        ]);

        $input = $request->all();

        $servicio = Servicios::create($input);

        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('servicio.index')
                        ->with('success','User created successfully');
    }

    public function ChangeServicioStatus(Request $request)
    {
        $servicio = Servicios::find($request->id);
        $servicio->act_descuento = $request->act_descuento;
        $servicio->save();

        return response()->json(['success' => 'Se cambio el estado exitosamente.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $servicio = Servicios::find($id);

        return view('servicios.show', compact('servicio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $servicio = Servicios::find($id);

        return view('servicios.edit', compact('servicio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Servicios $servicio
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'precio' => 'required',
            'duracion' => 'required',
            'color' => 'required'
        ]);

        $input = $request->all();
        $servicio = Servicios::find($id);
        $servicio->update($input);

        return redirect()->route('servicio.index')
        ->with('edit','servicio Has Been updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $servicio = Servicios::find($id)->delete();

        Session::flash('delete', 'Se ha eliminado sus datos con exito');
        return redirect()->route('servicio.index')
            ->with('success', 'servicio deleted successfully');
    }
}
