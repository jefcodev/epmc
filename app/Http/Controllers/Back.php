<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Turno;
use App\Placa;
use App\Sucursal;

class Back extends Controller
{

	var $datos;

	public function __construct(){

	}

    public function index(){
    	$this->datos['sucursales'] = Sucursal::all();

    	$this->datos['placas_totales'] = Placa::count();
    	$this->datos['placas_entregadas'] = Placa::where('entregada','=',true)->count();
    	$this->datos['placas_hoy'] = Placa::where('entregada','=',true)->whereDate('updated_at',date('y-m-d'))->count();

    	return view('admin', $this->datos);
    }
}
