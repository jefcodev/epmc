<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\General;

use URL;

class Generales extends Controller
{
	var $datos;

    public function index(){
    	$this->datos['general'] = General::get();
        return view('back.generales.index',$this->datos);
    }

    public function store(Request $request){
        $ignorar_de_request = ['_token', 'turnos' ];
        
    	foreach ($request->all() as $key => $value) {
            //si el key no esta entre los ignorados
            if(!in_array($key, $ignorar_de_request)){
                //busco o creo la configuracion con el nombre especificado
    			$configuracion = General::firstOrNew(['nombre'=>$key]);
    			$configuracion->valor = $value;
    			$configuracion->save();
            }		
    	}

    	if($request->has('turnos')){
            $checkbox_configs = ['turnos_habilitados','sabado','domingo'];

            foreach ($checkbox_configs as $value) {
                $configuracion = General::firstOrNew(['nombre'=>$value]);
                if($request->has($value)){
				    $configuracion->valor=true;
                }else{
				    $configuracion->valor=false;
                }
                $configuracion->save();
            }

            return redirect()->route('turnos.config')->with('success','Configuraciones actualizadas correctamente!');
		}

    	return redirect()->route('generales.index');
    }

}
