<?php

namespace App\Http\Controllers;

use App\Models\CajaDia;
use App\Models\Client;
use App\Models\ConfiguracionLaser;
use App\Models\Laser;
use App\Models\NotasLacer;
use App\Models\User;
use App\Models\ZonasLaser;
use App\Models\PagosLaser;
use App\Models\RegistroZonas;
Use Alert;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class NotasLacerController extends Controller
{
    public function index_consentimiento(){
        return view('notas_lacer.index_consentimiento');
    }

    public function imagen_depiladora(){
        return view('notas_lacer.imagen_depiladora');
    }

    public function index_hoja_salud(){
        return view('notas_lacer.hoja_salud');
    }

    public function index(){
        $nota_lacer = NotasLacer::orderBy('id','DESC')->get();

        return view('notas_lacer.index', compact('nota_lacer'));
    }

    public function getZonasByTipoZona($tipoZona){
        try {
            $data = Laser::where('tipo_zona', $tipoZona)->get(['id', 'zona', 'costo_paquete']);

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error en el servidor'], 500);
        }
    }

    public function crear(){
        $zonas = Laser::get();
        $client = Client::orderBy('name','ASC')->get();
        $user = User::where('puesto', '=', 'Cosme')->orwhere('puesto', '=', 'Recepcionista')->get();

        return view('notas_lacer.crear',compact('client', 'user', 'zonas'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'tipo_servicio' => 'required',
        ]);

        if ($validator->fails()) {
            dd($validator);
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $fechaActual = date('Y-m-d');

        // N U E V O  U S U A R I O
        if($request->get('name') != NULL){
           $client = new Client;
           $client->name = $request->get('name');
           $client->last_name = $request->get('last_name');
           $client->phone = $request->get('phone');
           //$client->email = $request->get('email');
           $client->save();
        }

        // G U A R D A R  N O T A  P R I N C I P A L
        $nota_laser = new NotasLacer;

        $nota_laser->id_user = $request->get('id_user');

        if($request->get('name') != NULL){
            $nota_laser->id_client = $client->id;
        }else{
            $nota_laser->id_client = $request->get('id_client');
        }

        if($request->get('tipo_servicio') == 'paquete'){
            $tipo = $request->get('paquete_select');
        }else{
            $tipo = 'Sesiones';
        }

        $nota_laser->total =  $request->get('total_suma');
        $nota_laser->restante = $request->get('restante');
        $nota_laser->tipo = $tipo;
        $nota_laser->fecha = $fechaActual;
        $nota_laser->save();

        $cambio = $request->get('dinero_recibido') - $request->get('pago');

        // G U A R D A R  C A M B I O
            if($cambio > 0 && $request->get('forma_pago') == 'Efectivo'){
                $fechaActual = date('Y-m-d');
                $caja = new CajaDia;
                $caja->egresos = $request->get('cambio');
                $caja->motivo = 'Retiro';
                $caja->concepto = 'Cambio nota laser: ' . $nota_laser->id;
                $caja->fecha = $fechaActual;
                $caja->save();
            }

        // G U A R D A R  S E R V I C I O

        if($request->get('tipo_servicio') == 'sesion'){

            for ($i = 1; $i <= 4; $i++) {
                $zonaSelect = $request->get("zona_select_$i");

                if ($zonaSelect !== NULL) {
                    $zona_laser = new ZonasLaser;
                    $zona_laser->id_nota = $nota_laser->id;
                    $zona_laser->id_zona = $zonaSelect;
                    $zona_laser->sesiones_compradas = $request->get("cantidad_$i");
                    $zona_laser->sesiones_restantes = $request->get("cantidad_$i");
                    $zona_laser->subtotal = $request->get("subtotal_$i");
                    $zona_laser->save();
                }
            }

        }else{
            if($request->get('paquete_select') == 'Zona Mini' || $request->get('paquete_select') == 'Zonas Pequeñas'){
                $sesiones = 12;
            }else if($request->get('paquete_select') == 'Zonas Medianas' || $request->get('paquete_select') == 'Zonas Grandes'){
                $sesiones = 15;
            }
            for ($i = 1; $i <= 2; $i++) {
                $zonaSelect = $request->get("zona_paquete_$i");

                $zona_laser = new ZonasLaser;
                $zona_laser->id_nota = $nota_laser->id;
                $zona_laser->id_zona = $zonaSelect;
                $zona_laser->sesiones_compradas = $sesiones;
                $zona_laser->sesiones_restantes = $sesiones;
                $zona_laser->save();
            }
        }


        // G U A R D A R  P A G O
        if($request->get('pago') != NULL){

            $pago = new PagosLaser;
            $pago->id_nota = $nota_laser->id;
            $pago->fecha = $request->get('fecha_pago');
            $pago->id_user = $request->get('cosmetologa');
            $pago->pago = $request->get('pago');
            $pago->dinero_recibido = $request->get('dinero_recibido');
            $pago->forma_pago = $request->get('forma_pago');
            $pago->nota = $request->get('nota2');
            $pago->cambio = $request->get('cambio');

            if ($request->hasFile("foto")) {
                $file = $request->file('foto');
                $path = public_path() . '/foto_laser';
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $pago->foto = $fileName;
            }
            $pago->save();
        }

        $recibo = [
            "id" => $nota_laser->id,
            "Cliente" => $nota_laser->Client->name,
            "Total" => $nota_laser->precio,
            "Restante" => $nota_laser->restante,
            "nombreImpresora" => "ZJ-58",
            'pago' => [$pago],
            'cosmetologa' => $nota_laser->User->name,
            // Agrega cualquier otro dato necesario para el recibo
        ];

        // Devuelve los datos en formato JSON
        return response()->json(['success' => true, 'recibo' => $recibo]);


    }

    public function store_sesion(Request $request){

        $validator = Validator::make($request->all(), [
            'parametros' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Faltan campos. Por favor, completa todos los campos correctamente.');
        }

        try {
            // G U A R D A R  N O T A  P R I N C I P A L
            $fechaActual = date('Y-m-d');
            $registrosZonas = new RegistroZonas;
            $registrosZonas->id_nota = $request->get('id_nota');
            $registrosZonas->id_zona = $request->get('id_zona');
            $registrosZonas->sesion = $request->get('sesion');
            $registrosZonas->parametros = $request->get('parametros');
            $registrosZonas->nota = $request->get('nota');
            $registrosZonas->fecha = $fechaActual;
            $registrosZonas->save();

            alert()->success('Creado con éxito', 'Operación exitosa');
            return back();
        } catch (\Exception $e) {
            // En caso de error, regresa con un mensaje de error
            return back()
                ->with('error', 'Se produjo un error al procesar la solicitud. Por favor, inténtalo de nuevo.');
        }

    }

    public function edit($id){
        $zonas = Laser::get();
        $nota_laser = NotasLacer::find($id);
        $pago = PagosLaser::where('id_nota', '=', $id)->get();
        $zonas_lacer = ZonasLaser::where('id_nota', '=', $id)->get();
        $configuraciones_laser = ConfiguracionLaser::where('id_cliente', '=', $nota_laser->id_client)->get();

        $registrosZonas  = RegistroZonas::where('id_nota', '=', $id)->get();

        $zonas = Laser::get();
        $user = User::where('puesto', '=', 'Cosme')->orwhere('puesto', '=', 'Recepcionista')->get();

        return view('notas_lacer.index_laser',compact('user', 'zonas', 'nota_laser', 'pago', 'zonas_lacer', 'registrosZonas', 'configuraciones_laser'));
    }

    public function update(Request $request, $id)
    {

        // G U A R D A R  P A G O S
        if($request->get('pago') != NULL){
            $pago = new PagosLaser;
            $pago->id_nota = $id;
            $pago->fecha = $request->get('fecha_pago');
            $pago->id_user = $request->get('cosmetologa');
            $pago->pago = $request->get('pago');
            $pago->dinero_recibido = $request->get('dinero_recibido');
            $pago->forma_pago = $request->get('forma_pago');
            $pago->nota = $request->get('nota2');
            $pago->cambio = $request->get('cambio');

            if ($request->hasFile("foto")) {
                $file = $request->file('foto');
                $path = public_path() . '/foto_laser';
                $fileName = uniqid() . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $pago->foto = $fileName;
            }

            $pago->save();
        }else{
            $pago = '';
        }

            $pagos = PagosLaser::where('id_nota', $id)->get();
            $totalPagos = $pagos->sum('pago');
            $restante =  $pago->pago - $totalPagos;

            $nota = NotasLacer::find($id);
            $nota->restante = $restante;
            $nota->update();


        $recibo = [
            "id" => $nota->id,
            "Cliente" => $nota->Client->name,
            "Total" => $nota->total,
            "Restante" => $nota->restante,
            "nombreImpresora" => "ZJ-58",
            'pago' => [$pago],
            // Agrega cualquier otro dato necesario para el recibo
        ];
        // Devuelve los datos en formato JSON
        return response()->json(['success' => true, 'recibo' => $recibo]);


        Alert::success('Actualizado con exito ');

        return redirect()->back()->with('edit','Nota Laser Pago Actualizado.');
    }

    public function store_config(Request $request){
        $validator = Validator::make($request->all(), [
            'area' => 'required',
            'skyn_type' => 'required',
            'hair_type' => 'required',
            'hair_density' => 'required',
            'hair_tickness' => 'required',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Faltan campos. Por favor, completa todos los campos correctamente.');
        }

        try {
            $area = $request->get('area');
            $skyn_type = $request->get('skyn_type');
            $hair_type = $request->get('hair_type');
            $hair_density = $request->get('hair_density');
            $hair_tickness = $request->get('hair_tickness');

            for ($count = 0; $count < count($area); $count++) {
                $data = array(
                    'id_cliente' => $request->get('id_client'),
                    'area' => $area[$count],
                    'skyn_type' => $skyn_type[$count],
                    'hair_type' => $hair_type[$count],
                    'hair_density' => $hair_density[$count],
                    'hair_tickness' => $hair_tickness[$count],
                );
                $insert_data[] = $data;
            }

            ConfiguracionLaser::insert($insert_data);

            alert()->success('Creado con éxito', 'Operación exitosa');
            return back();
        } catch (\Exception $e) {
            // En caso de error, regresa con un mensaje de error
            return back()
                ->with('error', 'Se produjo un error al procesar la solicitud. Por favor, inténtalo de nuevo.');
        }
    }
}
