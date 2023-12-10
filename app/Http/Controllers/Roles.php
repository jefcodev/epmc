<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use DB;

class Roles extends Controller
{

	var $datos;

     /**
     * Muestra el Listado de los Roles del Sistema
     */
    public function index()
    {
        $this->datos['roles'] = Role::all();

        return view('back.usuarios.roles.index', $this->datos);
    }


    /**
     * Muestra el formulario para crear un Rol
     */
    public function create()
    {
        $this->datos['permisos'] = Permission::all();

        return view('back.usuarios.roles.create', $this->datos);
    }

    /**
     * Toma los datos del fomulario de creacion y Crea un Rol con sus respectivos permisos
     * @param  Request
     * @return [type]
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $role = Role::create(['name' => $request->name]);

            if ($request->has('permissions')) {
                $role->syncPermissions($request->permissions);
            }
            DB::commit();

            return redirect()->route('roles.index')->with('success','Rol creado correctamente!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->route('roles.index')->with('error','Error al crear rol!');
        }
    }

    /**
     * Muestra el formulario para editar un Rol
     */
    public function edit($id)
    {
        $this->datos['rol'] = Role::findOrFail($id);
        $this->datos['permisos'] = Permission::all();
        
        return view('back.usuarios.roles.edit', $this->datos);
    }
     /**
     * Toma los datos del fomulario de ediciion y edita un Rol con sus respectivos permisos
     * @param  [integer] 
     * @param  Request
     * @return [type]
     */
    public function update($id, Request $request)
    {
        DB::beginTransaction();
        try {
            //Updating Role
            $role = Role::findOrFail($id);

            $role->update(['name' => $request->name]);

            if ($request->has('permissions')) {
                $role->syncPermissions($request->permissions);
            }

            DB::commit();

            return redirect()->route('roles.index')->with('success','Rol actualizado correctamente!');
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->route('roles.index')->with('error','Error al actualizar rol!');
        }
    }

    /**
     * @param  Toma el id de un Rol y lo elimina con sus respectivos permisos
     */
    public function destroy($id, Request $request)
    {
        $rol = Role::find($id);
        $rol->delete();

        if($request->ajax())
        {
            return response()->json(['success'=>TRUE,'id'=>$id]);
        }else{
            return redirect()->route('usuarios.index')->with('success','Rol eliminado correctamente!');;
        }
    }
}
