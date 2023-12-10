<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Digito;
use App\General;

class Digitos extends Controller
{
    var $datos= [];

    public function __construct(){
        $this->datos['general'] = General::get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->datos['digitos'] = Digito::orderBy('digito','asc')->get();
        return view('back.turnos.digitos.index',$this->datos);
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
    public function edit($digito_id)
    {
        $this->datos['digito'] = Digito::find($digito_id);
        return view('back.turnos.digitos.edit',$this->datos);
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
        $digito = Digito::find($id);
        $digito->fill($request->all());
        if($request->has('habilitado')){
            $digito->habilitado = $request->habilitado == 'false' ? false: true;
        }
        $digito->save();
        if($request->ajax())
        {
            return response()->json(['success'=>TRUE,'id'=>$id,'digito'=>$digito]);
        }else{
            return redirect()->route('digitos.index')->with('success','Dígito actualizado correctamente!');
        }
    }

}
