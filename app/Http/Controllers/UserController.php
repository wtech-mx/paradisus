<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Alertas;
use App\Models\CustomTerms;
use App\Models\Encuestas;
use App\Models\User;
use App\Models\Horario;
use App\Models\NotasCosmes;
use App\Models\NotasPedidos;
use App\Models\NotasPropinas;
use App\Models\Pagos;
use App\Models\Paquete2;
use App\Models\Paquete3;
use App\Models\Paquetes;
use App\Models\PaquetesPago;
use App\Models\RegCosmesSum;
use App\Models\RegistroSemanal;
use App\Models\RegistroSueldoSemanal;
use App\Models\AlertasCosmes;

use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->get();
        return view('users.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->color = $request->get('color');
        $user->resourceId = $request->get('resourceId');
        $user->puesto = $request->get('puesto');
        $user->sueldo_base = $request->get('sueldo_base');
        $user->comision_despedida = $request->get('comision_despedida');
        $user->sueldo_hora = $request->get('sueldo_hora');
        $user->password = Hash::make($request->get('password'));
        $user->assignRole($request->input('roles'));
        $user->bono_comida = $request->get('bono_comida');
        $user->bono_puntualidad = $request->get('bono_puntualidad');
        $user->save();

        $horario = new Horario;
        $horario->id_user = $user->id;
        $horario->lunes = $request->get('lunes');
        $horario->martes = $request->get('martes');
        $horario->miercoles = $request->get('miercoles');
        $horario->jueves = $request->get('jueves');
        $horario->viernes = $request->get('viernes');
        $horario->sabado = $request->get('sabado');
        $horario->domingo = $request->get('domingo');
        $horario->save();



        Session::flash('success', 'Se ha guardado sus datos con exito');
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $horario = Horario::where('id_user', '=', $id)->first();
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole', 'horario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->puesto = $request->get('puesto');
        $user->photo = $request->get('photo');
        $user->color = $request->get('color');
        $user->resourceId = $request->get('resourceId');
        $user->sueldo_base = $request->get('sueldo_base');
        $user->comision_despedida = $request->get('comision_despedida');
        $user->sueldo_hora = $request->get('sueldo_hora');
        $user->bono_comida = $request->get('bono_comida');
        $user->bono_puntualidad = $request->get('bono_puntualidad');
        if(!empty($request->get('password'))){
            $user->password = Hash::make($request->get('password'));
        }else{
            // $user = Arr::except($user,array('password'));
        }
        $user->assignRole($request->input('roles'));
        $user->update();


    // Encontrar todas las alertas asociadas al usuario en AlertasCosmes
    $alertasCosmes = AlertasCosmes::where('id_user', $id)->get();

    // Actualizar el color de las alertas asociadas
    foreach ($alertasCosmes as $alertaCosmes) {
        $alerta = Alertas::find($alertaCosmes->id_alerta);
        if ($alerta) {
            $alerta->color = $user->color;
            $alerta->update();
        }
    }

        $horario = Horario::find($user->id);
        $horario->id_user = $user->id;
        $horario->lunes = $request->get('lunes');
        $horario->martes = $request->get('martes');
        $horario->miercoles = $request->get('miercoles');
        $horario->jueves = $request->get('jueves');
        $horario->viernes = $request->get('viernes');
        $horario->sabado = $request->get('sabado');
        $horario->domingo = $request->get('domingo');
        $horario->update();


        Session::flash('edit', 'Se ha editado sus datos con exito');
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario_a_eliminar = $id;
        $usuario_reemplazo_id = 27;

            $usuario = User::find($usuario_a_eliminar);
            // Obtén todas las notas relacionadas con ese usuario
            $customterms = CustomTerms::where('id_user', $usuario_a_eliminar)->get();

            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
            foreach ($customterms as $nota) {
                $nota->id_user = $usuario_reemplazo_id;
                $nota->save();
            }

            $encuestas = Encuestas::where('id_user', $usuario_a_eliminar)->get();

            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
            foreach ($encuestas as $nota) {
                $nota->id_user = $usuario_reemplazo_id;
                $nota->save();
            }

            // Obtén todas las notas relacionadas con ese usuario
            $registros_semanales = RegistroSemanal::where('cosmetologo_id', $usuario_a_eliminar)->get();

            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
            foreach ($registros_semanales as $nota) {
                $nota->cosmetologo_id = $usuario_reemplazo_id;
                $nota->save();
            }

            // Obtén todas las notas relacionadas con ese usuario
            $registro_sueldo_semanal = RegistroSueldoSemanal::where('id_cosme', $usuario_a_eliminar)->get();

            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
            foreach ($registro_sueldo_semanal as $nota) {
                $nota->id_cosme = $usuario_reemplazo_id;
                $nota->save();
            }

            // Obtén todas las notas relacionadas con ese usuario
            $reg_cosmes_sum = RegCosmesSum::where('id_cosme', $usuario_a_eliminar)->get();

            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
            foreach ($reg_cosmes_sum as $nota) {
                $nota->id_cosme = $usuario_reemplazo_id;
                $nota->save();
            }

            // Obtén todas las notas relacionadas con ese usuario
            $notas_relacionadas = NotasCosmes::where('id_user', $usuario_a_eliminar)->get();

            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
            foreach ($notas_relacionadas as $nota) {
                $nota->id_user = $usuario_reemplazo_id;
                $nota->save();
            }

            // Obtén todas las notas relacionadas con ese usuario
            $notas_relacionadas2 = NotasPedidos::where('id_user', $usuario_a_eliminar)->get();

            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
            foreach ($notas_relacionadas2 as $nota) {
                $nota->id_user = $usuario_reemplazo_id;
                $nota->save();
            }

            // Obtén todas las notas relacionadas con ese usuario
            $notas_relacionadas3 = NotasPropinas::where('id_user', $usuario_a_eliminar)->get();

            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
            foreach ($notas_relacionadas3 as $nota) {
                $nota->id_user = $usuario_reemplazo_id;
                $nota->save();
            }

            // Obtén todas las notas relacionadas con ese usuario
            $notas_relacionadas4 = Pagos::where('cosmetologa', $usuario_a_eliminar)->get();

            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
            foreach ($notas_relacionadas4 as $nota) {
                $nota->cosmetologa = $usuario_reemplazo_id;
                $nota->save();
            }

            // Obtén todas las notas relacionadas con ese usuario
            $notas_relacionadas5 = PaquetesPago::where('id_user', $usuario_a_eliminar)->get();

            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
            foreach ($notas_relacionadas5 as $nota) {
                $nota->id_user = $usuario_reemplazo_id;
                $nota->save();
            }

            // Obtén todas las notas relacionadas con ese usuario
            $notas_relacionadas6 = Paquetes::where('id_user1', $usuario_a_eliminar)->get();

            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
            foreach ($notas_relacionadas6 as $nota) {
                $nota->id_user1 = $usuario_reemplazo_id;
                $nota->save();
            }

                // Obtén todas las notas relacionadas con ese usuario
                $notas_relacionadas61 = Paquetes::where('id_user2', $usuario_a_eliminar)->get();

                // Itera sobre cada nota y reasígnales el ID del nuevo usuario
                foreach ($notas_relacionadas61 as $nota) {
                    $nota->id_user2 = $usuario_reemplazo_id;
                    $nota->save();
                }

                            // Obtén todas las notas relacionadas con ese usuario
                            $notas_relacionadas62 = Paquetes::where('id_user3', $usuario_a_eliminar)->get();

                            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
                            foreach ($notas_relacionadas62 as $nota) {
                                $nota->id_user3 = $usuario_reemplazo_id;
                                $nota->save();
                            }

                                        // Obtén todas las notas relacionadas con ese usuario
                                        $notas_relacionadas63 = Paquetes::where('id_user4', $usuario_a_eliminar)->get();

                                        // Itera sobre cada nota y reasígnales el ID del nuevo usuario
                                        foreach ($notas_relacionadas63 as $nota) {
                                            $nota->id_user4 = $usuario_reemplazo_id;
                                            $nota->save();
                                        }


            // Obtén todas las notas relacionadas con ese usuario
            $notas_relacionadas7 = Paquete2::where('id_user5', $usuario_a_eliminar)->get();

            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
            foreach ($notas_relacionadas7 as $nota) {
                $nota->id_user5 = $usuario_reemplazo_id;
                $nota->save();
            }

                // Obtén todas las notas relacionadas con ese usuario
                $notas_relacionadas71 = Paquete2::where('id_user6', $usuario_a_eliminar)->get();

                // Itera sobre cada nota y reasígnales el ID del nuevo usuario
                foreach ($notas_relacionadas71 as $nota) {
                    $nota->id_user6 = $usuario_reemplazo_id;
                    $nota->save();
                }

                            // Obtén todas las notas relacionadas con ese usuario
                            $notas_relacionadas72 = Paquete2::where('id_user7', $usuario_a_eliminar)->get();

                            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
                            foreach ($notas_relacionadas72 as $nota) {
                                $nota->id_user7 = $usuario_reemplazo_id;
                                $nota->save();
                            }

                                        // Obtén todas las notas relacionadas con ese usuario
                                        $notas_relacionadas73 = Paquete2::where('id_user8', $usuario_a_eliminar)->get();

                                        // Itera sobre cada nota y reasígnales el ID del nuevo usuario
                                        foreach ($notas_relacionadas73 as $nota) {
                                            $nota->id_user8 = $usuario_reemplazo_id;
                                            $nota->save();
                                        }

            // Obtén todas las notas relacionadas con ese usuario
            $notas_relacionadas8 = Paquete3::where('id_user9', $usuario_a_eliminar)->get();

            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
            foreach ($notas_relacionadas8 as $nota) {
                $nota->id_user9 = $usuario_reemplazo_id;
                $nota->save();
            }

                // Obtén todas las notas relacionadas con ese usuario
                $notas_relacionadas81 = Paquete3::where('id_user10', $usuario_a_eliminar)->get();

                // Itera sobre cada nota y reasígnales el ID del nuevo usuario
                foreach ($notas_relacionadas81 as $nota) {
                    $nota->id_user10 = $usuario_reemplazo_id;
                    $nota->save();
                }

                DB::table('horario')
                ->where('id_user', $usuario_a_eliminar)
                ->delete();

                            // Obtén todas las notas relacionadas con ese usuario
            $notas_relacionadas9 = Alertas::where('id_especialist', $usuario_a_eliminar)->get();

            // Itera sobre cada nota y reasígnales el ID del nuevo usuario
            foreach ($notas_relacionadas9 as $nota) {
                $nota->id_especialist = $usuario_reemplazo_id;
                $nota->save();
            }
            // Elimina el usuario una vez que las notas se han reasignado
            $usuario->delete();

        Session::flash('delete', 'Se ha eliminado sus datos con exito');
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}
