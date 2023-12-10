<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Periodo;
use App\Lotaip;
use App\Articulo;
use App\Categoria;
use App\Documento;

use File;

class LotaipController extends Controller
{
    var $datos= [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($anio = "2020")
    {
        $this->datos['periodos'] = Periodo::orderBy('anio','desc')->get();
        $this->datos['articulos'] = Articulo::orderBy('orden','asc')->get();
        $this->datos['meses']= $this->_meses($anio);
        $this->datos['categorias'] = Categoria::orderBy('id','desc')->get()->pluck('categoria','id');
        $this->datos['anio']= $anio;
        return view('back.lotaip.index',$this->datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipo = $request->tipo;

        if($tipo == "documento"){

            $documento = new Documento($request->all());
            if($request->file('documento'))
            {
                $file = $request->file('documento');
                $name = 'lotaip_'.time().'.'.$file->getClientOriginalExtension();
                
                $path = public_path().'/uploads/';
                $file->move($path,$name);
                $documento->ruta=$name;
            }
            $documento->save();

            $lotaip = new Lotaip();
            $lotaip->anio = $request->anio;
            $lotaip->mes = $request->mes;
            $lotaip->tipo = $request->tipo;
            $lotaip->documento_id = $documento->id;
            $lotaip->articulo_id = $request->articulo_id;
            //$lotaip->url_documento = $articulo->id;
            $lotaip->save();
            //dd($request->all());
        }

        return redirect()->route('lotaip.index',$request->anio)->with('success','Documento cargado correctamente!');
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function enlazar(Request $request)
    {
        
        $tipo = $request->tipo;

        if($tipo == "documento"){

            $lotaip = new Lotaip();
            $lotaip->anio = $request->anio;
            $lotaip->mes = $request->mes;
            $lotaip->tipo = $request->tipo;
            $lotaip->documento_id = $request->documento_id;
            $lotaip->articulo_id = $request->articulo_id;
            //$lotaip->url_documento = $articulo->id;
            $lotaip->save();
            //dd($request->all());
        }

        return redirect()->route('lotaip.index')->with('success','Documento cargado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $lotaip = Lotaip::find($id);
        File::delete(public_path().'/uploads/'.$lotaip->documento->ruta);
        $lotaip->documento->delete();
        $lotaip->delete();


        if($request->ajax())
        {
            return response()->json(['success'=>TRUE,'id'=>$id]);
        }else{
            return redirect()->route('lotaip.index');
        }
    }

    /**
     * Devuelve los meses de un anio
     */
    private function _meses($anio = "2020"){
    	$meses = [
            '01'=>'Enero',
            '02'=>'Febrero',
            '03'=>'Marzo',
            '04'=>'Abril',
            '05'=>'Mayo',
            '06'=>'Junio',
            '07'=>'Julio',
            '08'=>'Agosto',
            '09'=>'Septiembre',
            '10'=>'Octubre',
            '11'=>'Noviembre',
            '12'=>'Diciembre'];

    	$n_meses = 12;

    	$anio_actual = date('Y');
    	if($anio==$anio_actual){
    		$n_meses = (int)date('m');
    	}
    	//dd($n_meses);
    	return array_slice($meses,0, $n_meses);
    }
}
