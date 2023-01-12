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

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

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

    // =============== M O D U L O   N O T A S ===============================
    Route::get('/notas/servicios', [App\Http\Controllers\NotasController::class, 'index'])->name('notas.index');
    Route::post('/notas/servicios/create', [App\Http\Controllers\NotasController::class, 'store'])->name('notas.store');
    Route::patch('/notas/servicios/update/{id}', [App\Http\Controllers\NotasController::class, 'update'])->name('notas.update');
    Route::delete('/notas/servicios/delete/{id}', [App\Http\Controllers\NotasController::class, 'destroy'])->name('notas.destroy');

    // =============== M O D U L O   N O T A S  P E D I D O S ===============================
    Route::get('/notas/pedidos', [App\Http\Controllers\NotasPedidoController::class, 'index'])->name('notas_pedidos.index');
    Route::post('/notas/pedidos/create', [App\Http\Controllers\NotasPedidoController::class, 'store'])->name('notas_pedidos.store');
    Route::patch('/notas/pedidos/update/{id}', [App\Http\Controllers\NotasPedidoController::class, 'update'])->name('notas_pedidos.update');
    Route::delete('/notas/pedidos/delete/{id}', [App\Http\Controllers\NotasPedidoController::class, 'destroy'])->name('notas_pedidos.destroy');

    // =============== M O D U L O   C A J A ===============================
    Route::get('/caja', [App\Http\Controllers\CajaController::class, 'index'])->name('caja.index');
    Route::post('/caja/create', [App\Http\Controllers\CajaController::class, 'store'])->name('caja.store');
    Route::patch('/caja/update/{id}', [App\Http\Controllers\CajaController::class, 'update'])->name('caja.update');
    Route::delete('/caja/delete/{id}', [App\Http\Controllers\CajaController::class, 'destroy'])->name('caja.destroy');

    // =============== M O D U L O   C A L E N D A R I O ===============================
    Route::get('calendar', [App\Http\Controllers\AlertasController::class, 'index_calendar'])->name('calendar.index_calendar');
    Route::post('calendar', [App\Http\Controllers\AlertasController::class, 'store_calendar'])->name('calendar.store_calendar');
    Route::get('calendar/show', [App\Http\Controllers\AlertasController::class, 'show_calendar'])->name('calendar.show_calendar');
    Route::patch('calendar/destroy/{id}', [App\Http\Controllers\AlertasController::class, 'destroy_calendar'])->name('calendar.destroy_calendar');
    Route::patch('calendar/update/{id}', [App\Http\Controllers\AlertasController::class, 'update_calendar'])->name('calendar.update_calendar');

    // =============== M O D U L O   R E P O R T E S ===============================
    Route::get('/reporte', [App\Http\Controllers\ReporteController::class, 'index'])->name('reporte.index');
    Route::post('/reporte/create', [App\Http\Controllers\ReporteController::class, 'store'])->name('reporte.store');
    Route::patch('/reporte/update/{id}', [App\Http\Controllers\ReporteController::class, 'update'])->name('reporte.update');
    Route::delete('/reporte/delete/{id}', [App\Http\Controllers\ReporteController::class, 'destroy'])->name('reporte.destroy');
});

Route::get('/nota/usuario/servicio/{id}', [App\Http\Controllers\NotasController::class, 'usuario'])->name('notas.usuario');

//Route Hooks - Do not delete//
Route::view('/especialists', 'livewire.especialists.index')->middleware('auth');

/*|--------------------------------------------------------------------------
|Configuracion
|--------------------------------------------------------------------------*/
Route::get('/configuracion', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('index.configuracion');
Route::patch('/configuracion/update', [App\Http\Controllers\ConfiguracionController::class, 'update'])->name('update.configuracion');
