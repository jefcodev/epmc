<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Placa;

use App\Imports\PlacasImport;
use Maatwebsite\Excel\Facades\Excel;

class Placas extends Controller
{
	var $datos = [];


    public function index(){
    	$this->datos['placas'] = Placa::all();
    	return view('back.placas.index',$this->datos);
    }

    /**
     * Muestra el formulario para cargar el documento de excel con las placas
     */
    public function create(){
    	return view('back.placas.upload',$this->datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	if($request->has('documento')){
            $file = $request->file('documento');
            $name = 'f_'.time().'.'.$file->getClientOriginalExtension();
            $path = public_path().'/uploads/placas/';
            $file->move($path,$name);
            //dd($path.$name);
            Excel::import(new PlacasImport, $path.$name);
        }
        return redirect()->route('placas.index')->with('success','Placa creada correctamente!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $placa = Placa::find($id);
        if($request->entregada=="true")
            $placa->entregada = true;
        else
            $placa->entregada = false;
        $placa->save();
        
        if($request->ajax())
        {
            return response()->json(['success'=>TRUE,'id'=>$id]);
        }else{
            return redirect()->route('placas.index')->with('success','Placa actualizada correctamente!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $placa = Placa::find($id);
        $placa->delete();

        if($request->ajax())
        {
            return response()->json(['success'=>TRUE,'id'=>$id]);
        }else{
            return redirect()->route('placas.index');
        }
    }

}
