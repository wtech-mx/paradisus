<?php

namespace App\Http\Controllers;

use App\Models\Notas;
use App\Models\NotasPaquetes;
use App\Models\NotasExtras;
use App\Models\NotasPropinas;
use App\Models\Pagos;
use App\Models\LinkPago;
use App\Models\User;
use App\Models\Client;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use MercadoPago\{Exception, SDK, Preference, Item};
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
class LinkPagoController extends Controller
{
    /**
     * Mostrar listado (index).
     */
    public function index()
    {
        // Obtiene todos los registros para la tabla
        // (en AJAX usaremos JSON solo para store/update/destroy,
        //  index devolverá la vista completa con $linkPagos).
        $linkPagos = LinkPago::orderBy('id','desc')->get();
        return view('admin.link_pago.index', compact('linkPagos'));
    }

    public function custom_link_pago($id)
    {
        // Obtiene todos los registros para la tabla
        // (en AJAX usaremos JSON solo para store/update/destroy,
        //  index devolverá la vista completa con $linkPagos).
        $linkPago = LinkPago::find($id);
        return view('admin.link_pago.customlinkpago', compact('linkPago'));
    }

    public function link_pago_servicio($itemId, $notaId)
    {
        // Por ejemplo, buscas ambos modelos:
        $nota = Notas::find($notaId);

        $user = Client::where('id', '=',$nota->id_client)->first();

        $pago = Pagos::where('id_nota', '=', $notaId)->get();

        // Pasa ambas variables a la vista
        return view('admin.link_pago.linkpagoservicio', compact('nota', 'pago','user'));
    }

    /**
     * Almacenar nuevo LinkPago (store vía AJAX).
     */
    public function store(Request $request)
    {
        // Validar campos
        $data = $request->validate([
            'cliente'     => 'required|string|max:191',
            'titulo'      => 'required|string|max:191',
            'descripcion' => 'nullable|string',
            'estatus'     => ['required', Rule::in(['Activo','Inactivo'])],
            'monto'       => 'required|numeric|min:0',
        ]);

        $nuevo = LinkPago::create($data);

        // Devolver JSON con el nuevo registro
        return response()->json([
            'success' => true,
            'linkPago' => $nuevo,
            'message' => 'Link de pago creado correctamente.'
        ], 201);
    }

    /**
     * Obtener datos de un LinkPago para editar (edit vía AJAX).
     */
    public function edit($id)
    {
        $lp = LinkPago::find($id);
        if (! $lp) {
            return response()->json(['success' => false, 'message' => 'Registro no encontrado.'], 404);
        }
        return response()->json(['success' => true, 'linkPago' => $lp]);
    }

    /**
     * Actualizar un LinkPago existente (update vía AJAX).
     */
    public function update(Request $request, $id)
    {
        $lp = LinkPago::find($id);
        if (! $lp) {
            return response()->json(['success' => false, 'message' => 'Registro no encontrado.'], 404);
        }

        $data = $request->validate([
            'cliente'     => 'required|string|max:191',
            'titulo'      => 'required|string|max:191',
            'descripcion' => 'nullable|string',
            'estatus'     => ['required', Rule::in(['Activo','Inactivo'])],
            'monto'       => 'required|numeric|min:0',
        ]);

        $lp->update($data);

        return response()->json([
            'success' => true,
            'linkPago' => $lp,
            'message' => 'Link de pago actualizado correctamente.'
        ]);
    }

    /**
     * Eliminar un LinkPago (destroy vía AJAX).
     */
    public function destroy($id)
    {
        $lp = LinkPago::find($id);
        if (! $lp) {
            return response()->json(['success' => false, 'message' => 'Registro no encontrado.'], 404);
        }
        $lp->delete();

        return response()->json([
            'success' => true,
            'message' => 'Link de pago eliminado correctamente.'
        ]);
    }

    public function processPayment_custom(Request $request){
        // Configurar el SDK de Mercado Pago con las credenciales de API
       SDK::setAccessToken(config('services.mercadopago.token'));
        // Crear un objeto de preferencia de pago
        $preference = new Preference();
        $code = Str::random(8);

        $item = new Item();
        $item->title = $request->get('titulo').' #'.$request->get('folio');
        $item->quantity = 1;
        $item->unit_price = $request->get('total');
        $ticketss = array($item);

        // Crear un objeto de preferencias de pago
        $preference = new \MercadoPago\Preference();

        $preference->back_urls = array(
            "success" => route('link_pago.pay'),
            "pending" => route('link_pago.pay'),
            "failure" => "https://plataforma.imnasmexico.com/",
        );

        $preference->auto_return = "approved";
        $preference->external_reference = $code;
        $preference->items = $ticketss;


        try {
            // Crear la preferencia en Mercado Pago
            $preference->save();

            // Redirigir al usuario al proceso de pago de Mercado Pago
            return Redirect::to($preference->init_point);
        } catch (Exception $e) {
            // Manejar errores de Mercado Pago
            return Redirect::back()->withErrors(['message' => $e->getMessage()]);
        } catch (Throwable $e) {
            // Manejar errores de PHP
            return Redirect::back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function pay(Request $request)
    {
        $payment_id = $request->get('payment_id');
        $external_reference = $request->get('external_reference');

        $dominio = $request->getHost();
        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-3926055628216617-062614-106d3ac7dd26f29d980d1927b7dc35ad-2084225921");

        $response = json_decode($response);
        if (isset($response->error)) {
            return redirect()->route('return.link_pago')->with('error', 'Hubo un problema al verificar el pago.');
        }
        $status = $response->status ?? null;
        $external_reference_api = $response->external_reference ?? null;
        $external_reference = $external_reference_api ?: $external_reference;

        // Si no se encuentra el external_reference, redirige con error
        if (!$external_reference) {
            return redirect()->route('return.link_pago')->with('error', 'No se pudo verificar el pago. Falta external_reference.');
        }

        return redirect()->route('return.link_pago');
    }

    public function return(){

        return view('admin.link_pago.link_pago_success');
    }
}
