<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class Permisos extends Controller
{
    var $datos;

    public function index(){
    	$this->datos['permisos'] = Permission::all();
    	return view('back.usuarios.permisos.index', $this->datos);
    }
}
