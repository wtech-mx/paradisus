<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Horario;
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
        $user->puesto = $request->get('puesto');
        $user->password = Hash::make('password');
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

        $user = User::create($user);
        $user->assignRole($request->input('roles'));

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

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->puesto = $request->get('puesto');
        if(!empty($user['password'])){
            $user['password'] = Hash::make($user['password']);
        }else{
            $user = Arr::except($user,array('password'));
        }
        $user->update();

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


        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));

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
        User::find($id)->delete();

        Session::flash('delete', 'Se ha eliminado sus datos con exito');
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}
