<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class Usuarios extends Controller
{
    var $datos= [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->datos['usuarios'] = User::where('id', '!=', '1')->paginate(10); // Paginar los resultados, 10 por página
        return view('back.usuarios.index', $this->datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->datos['roles'] = Role::get()->pluck('name','id');
        return view('back.usuarios.create',$this->datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new User($request->all());
        $usuario->password = bcrypt($request->password);

        if($request->file('imagen'))
        {
            $file = $request->file('imagen');
            $name = 'user_'.time().'.'.$file->getClientOriginalExtension();
            
            $path = public_path().'/front/img/users/';
            $file->move($path,$name);
            $usuario->imagen=$name;
        }

        $usuario->save();

        if ($request->has('roles_id')) {
            $usuario->syncRoles($request->roles_id);
        }

        return redirect()->route('usuarios.index')->with('success','User creado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->datos['usuario'] = User::find($id);
        $this->datos['roles'] = Role::get()->pluck('name','id');
        return view('back.usuarios.edit',$this->datos);
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
        $usuario = User::find($id);
        $usuario->fill($request->all());
        
        if($request->has('password') && $request->password!=null){
            $usuario->password = bcrypt($request->password);
        }else{
            unset($usuario->password);
        }
        
        if($request->file('imagen'))
        {
            $file = $request->file('imagen');
            $name = 'user_'.time().'.'.$file->getClientOriginalExtension();
            
            $path = public_path().'/front/img/users/';
            $file->move($path,$name);
            $usuario->imagen=$name;
        }

        if ($request->has('roles_id')) {
            $usuario->syncRoles($request->roles_id);
        }
        $usuario->save();

        return redirect()->route('usuarios.index')->with('success','User actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $usuario = User::find($id);
        $usuario->delete();

        if($request->ajax())
        {
            return response()->json(['success'=>TRUE,'id'=>$id]);
        }else{
            return redirect()->route('usuarios.index');
        }
    }
}
