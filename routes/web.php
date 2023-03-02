<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PermisosController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Auth::routes();

Route::get('iniciar_sesion', function () {
    return view('auth.iniciar_sesion');
});

Route::get('/nota/usuario/servicio/{id}', [App\Http\Controllers\NotasController::class, 'usuario'])->name('notas.usuario');


// =============== M O D U L O   login custom ===============================

Route::get('dashboard', [App\Http\Controllers\CustomAuthController::class, 'dashboard']);
Route::get('login', [App\Http\Controllers\CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [App\Http\Controllers\CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [App\Http\Controllers\CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [App\Http\Controllers\CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [App\Http\Controllers\CustomAuthController::class, 'signOut'])->name('signout');

// =============== M O D U L O   login custom ===============================

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::get('/paquetes/servicios/edit/figura_ideal/firma/{id}', [App\Http\Controllers\PaquetesController::class, 'firma_uno'])->name('firma_paquete_uno.firma_edit_uno');
Route::get('/paquetes/servicios/edit/lipoescultura/firma/{id}', [App\Http\Controllers\PaquetesController::class, 'firma_dos'])->name('firma_paquete_dos.firma_edit_dos');
Route::get('/paquetes/servicios/edit/moldeante/firma/{id}', [App\Http\Controllers\PaquetesController::class, 'firma_tres'])->name('firma_paquete_tres.firma_edit_tres');
Route::get('/paquetes/servicios/edit/drenante/firma/{id}', [App\Http\Controllers\PaquetesController::class, 'firma_cuatro'])->name('firma_paquete_cuatro.firma_edit_cuatro');
Route::get('/paquetes/servicios/edit/gluteos/firma/{id}', [App\Http\Controllers\PaquetesController::class, 'firma_cinco'])->name('firma_paquete_cinco.firma_edit_cinco');

Route::post('/paquete/usuario/firma/{id}', [App\Http\Controllers\PaquetesController::class, 'store_firma'])->name('paquetes_firma.store_firma');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/show/{id}', [App\Http\Controllers\RoleController::class, 'show'])->name('roles.show');
    Route::get('/roles/create', [App\Http\Controllers\RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles/create', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/edit/{id}', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
    Route::patch('/roles/update/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/delete/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('destroy.roles');

    Route::resource('permisos', PermisosController::class);
    Route::resource('users', UserController::class);

    // =============== M O D U L O   C L I E N T S ===============================
    Route::get('/clients', [App\Http\Controllers\ClientController::class, 'index'])->name('clients.index');
    Route::post('/clients/create', [App\Http\Controllers\ClientController::class, 'store'])->name('clients.store');
    Route::patch('/clients/update/{id}', [App\Http\Controllers\ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/delete/{id}', [App\Http\Controllers\ClientController::class, 'destroy'])->name('clients.destroy');

    // =============== M O D U L O   S E R V I C I O S ===============================
    Route::get('/servicios', [App\Http\Controllers\ServiciosController::class, 'index'])->name('servicio.index');
    Route::post('/servicios/create', [App\Http\Controllers\ServiciosController::class, 'store'])->name('servicio.store');
    Route::patch('/servicios/update/{id}', [App\Http\Controllers\ServiciosController::class, 'update'])->name('servicio.update');
    Route::delete('/servicios/delete/{id}', [App\Http\Controllers\ServiciosController::class, 'destroy'])->name('servicio.destroy');

    Route::get('changeStatus', [App\Http\Controllers\ServiciosController::class, 'ChangeServicioStatus'])->name('ChangeServicioStatus.servicio');

    // =============== M O D U L O   N O T A S ===============================
    Route::get('/notas/servicios', [App\Http\Controllers\NotasController::class, 'index'])->name('notas.index');
    Route::get('/notas/servicios/store', [App\Http\Controllers\NotasController::class, 'create'])->name('notas.create');
    Route::post('/notas/servicios/create', [App\Http\Controllers\NotasController::class, 'store'])->name('notas.store');
    Route::get('/notas/servicios/edit/{id}', [App\Http\Controllers\NotasController::class, 'edit'])->name('notas.edit');
    Route::patch('/notas/servicios/update/{id}', [App\Http\Controllers\NotasController::class, 'update'])->name('notas.update');
    Route::delete('/notas/servicios/delete/{id}', [App\Http\Controllers\NotasController::class, 'destroy'])->name('notas.destroy');
    Route::get('/notas/servicios/print/{id}', [App\Http\Controllers\NotasController::class, 'usuario_print'])->name('notas.print');

    Route::get('/notas/servicios/changeCosme', [App\Http\Controllers\NotasController::class, 'ChangeCosme'])->name('notas.ChangeCosme');
    Route::get('/notas/servicios/changeServicio', [App\Http\Controllers\NotasController::class, 'ChangeServicio'])->name('notas.ChangeServicio');

    // =============== M O D U L O   N O T A S  P E D I D O S ===============================
    Route::get('/productos/show', [App\Http\Controllers\NotasPedidoController::class, 'show_productos'])->name('productos.show');
    Route::get('/notas/pedidos', [App\Http\Controllers\NotasPedidoController::class, 'index'])->name('notas_pedidos.index');
    Route::get('/notas/pedidos/create', [App\Http\Controllers\NotasPedidoController::class, 'create'])->name('notas_pedidos.create');
    Route::post('/notas/pedidos/store', [App\Http\Controllers\NotasPedidoController::class, 'store'])->name('notas_pedidos.store');
    Route::patch('/notas/pedidos/update/{id}', [App\Http\Controllers\NotasPedidoController::class, 'update'])->name('notas_pedidos.update');
    Route::delete('/notas/pedidos/delete/{id}', [App\Http\Controllers\NotasPedidoController::class, 'destroy'])->name('notas_pedidos.destroy');

    // =============== M O D U L O   P A Q U E T E S ===============================
    Route::get('/paquetes/servicios', [App\Http\Controllers\PaquetesController::class, 'index'])->name('paquetes_servicios.index');

    Route::get('/paquetes/servicios/create/figura_ideal', [App\Http\Controllers\PaquetesController::class, 'create_uno'])->name('create_paquete_uno.create_uno');
    Route::get('/paquetes/servicios/edit/figura_ideal/{id}', [App\Http\Controllers\PaquetesController::class, 'edit_uno'])->name('edit_paquete_uno.edit_uno');

    Route::get('/paquetes/servicios/create/lipoescultura', [App\Http\Controllers\PaquetesController::class, 'create_dos'])->name('create_paquete_dos.create_dos');
    Route::get('/paquetes/servicios/edit/lipoescultura/{id}', [App\Http\Controllers\PaquetesController::class, 'edit_dos'])->name('edit_paquete_dos.edit_dos');

    Route::get('/paquetes/servicios/create/moldeante', [App\Http\Controllers\PaquetesController::class, 'create_tres'])->name('create_paquete_tres.create_tres');
    Route::get('/paquetes/servicios/edit/moldeante/{id}', [App\Http\Controllers\PaquetesController::class, 'edit_tres'])->name('edit_paquete_tres.edit_tres');

    Route::get('/paquetes/servicios/create/drenante', [App\Http\Controllers\PaquetesController::class, 'create_cuatro'])->name('create_paquete_cuatro.create_cuatro');
    Route::get('/paquetes/servicios/edit/drenante/{id}', [App\Http\Controllers\PaquetesController::class, 'edit_cuatro'])->name('edit_paquete_cuatro.edit_cuatro');

    Route::get('/paquetes/servicios/create/gluteos', [App\Http\Controllers\PaquetesController::class, 'create_cinco'])->name('create_paquete_cinco.create_cinco');
    Route::get('/paquetes/servicios/edit/gluteos/{id}', [App\Http\Controllers\PaquetesController::class, 'edit_cinco'])->name('edit_paquete_cinco.edit_cinco');

    Route::post('/paquetes/servicios/store', [App\Http\Controllers\PaquetesController::class, 'store'])->name('paquetes_servicios.store');
    Route::patch('/paquetes/servicios/update/{id}', [App\Http\Controllers\PaquetesController::class, 'update'])->name('paquetes_servicios.update');
    Route::delete('/paquetes/servicios/delete/{id}', [App\Http\Controllers\PaquetesController::class, 'destroy'])->name('paquetes_servicios.destroy');

    // =============== M O D U L O   C A J A ===============================
    Route::get('/caja', [App\Http\Controllers\CajaController::class, 'index'])->name('caja.index');
    Route::post('/caja/create', [App\Http\Controllers\CajaController::class, 'store'])->name('caja.store');
    Route::post('/caja/inicial/', [App\Http\Controllers\CajaController::class, 'caja_inicial'])->name('caja.caja_inicial');
    Route::get('/reporte/imprimir/caja', [App\Http\Controllers\CajaController::class, 'imprimir_caja'])->name('caja.print_caja');
    Route::get('/reporte/imprimir/corte', [App\Http\Controllers\CajaController::class, 'imprimir_corte'])->name('caja.print_corte');

    // =============== M O D U L O   C A L E N D A R I O ===============================
    Route::get('calendar', [App\Http\Controllers\AlertasController::class, 'index_calendar'])->name('calendar.index_calendar');
    Route::post('calendar', [App\Http\Controllers\AlertasController::class, 'store_calendar'])->name('calendar.store_calendar');
    Route::get('calendar/show', [App\Http\Controllers\AlertasController::class, 'show_calendar'])->name('calendar.show_calendar');
    Route::patch('calendar/destroy/{id}', [App\Http\Controllers\AlertasController::class, 'destroy_calendar'])->name('calendar.destroy_calendar');
    Route::patch('calendar/update/{id}', [App\Http\Controllers\AlertasController::class, 'update_calendar'])->name('calendar.update_calendar');

    // =============== M O D U L O   R E P O R T E S ===============================
    Route::get('/reporte', [App\Http\Controllers\ReporteController::class, 'index'])->name('reporte.index');
    Route::get('/reporte/imprimir/serv', [App\Http\Controllers\ReporteController::class, 'imprimir_serv'])->name('reporte.print_serv');
    Route::get('/reporte/imprimir/prod', [App\Http\Controllers\ReporteController::class, 'imprimir_prod'])->name('reporte.print_prod');
    Route::get('/reporte/advance', [App\Http\Controllers\ReporteController::class, 'advance'])->name('advance_search');
});


//Route Hooks - Do not delete//
Route::view('/especialists', 'livewire.especialists.index')->middleware('auth');

/*|--------------------------------------------------------------------------
|Configuracion
|--------------------------------------------------------------------------*/
Route::get('/configuracion', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('index.configuracion');
Route::patch('/configuracion/update', [App\Http\Controllers\ConfiguracionController::class, 'update'])->name('update.configuracion');
