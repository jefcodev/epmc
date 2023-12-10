<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Dia_especial as Dia;
use App\General;
use App\Sucursal;

class Dias extends Controller
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
    public function index($id)
    {
        $this->datos['sucursal'] = Sucursal::find($id);
        $this->datos['dias_especiales'] = Dia::orderBy('fecha','desc')->get();
        return view('back.turnos.dias_especiales.index',$this->datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $this->datos['sucursal'] = Sucursal::find($id);
        $this->datos['sucursales_data'] = Sucursal::all()->pluck('nombre','id');
        return view('back.turnos.dias_especiales.create',$this->datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dia = new Dia($request->all());
        if($request->has('turnos_habilitados')){
            $dia->turnos_habilitados = true;
        }else{
            $dia->turnos_habilitados = false;
        }
        $dia->save();

        return redirect()->route('dias_especiales.index',$dia->sucursal_id)->with('success','Día creado correctamente!');
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
    public function edit($id, $dia_id)
    {
        $this->datos['sucursal'] = Sucursal::find($id);
        $this->datos['sucursales_data'] = Sucursal::all()->pluck('nombre','id');
        $this->datos['dia'] = Dia::find($dia_id);
        return view('back.turnos.dias_especiales.edit',$this->datos);
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
        $dia = Dia::find($id);
        $dia->fill($request->all());
        if($request->has('turnos_habilitados')){
            $dia->turnos_habilitados = true;
        }else{
            $dia->turnos_habilitados = false;
        }
        $dia->save();

        return redirect()->route('dias_especiales.index',$dia->sucursal_id)->with('success','Día actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $dia = Dia::find($id);
        $dia->delete();

        if($request->ajax())
        {
            return response()->json(['success'=>TRUE,'id'=>$id]);
        }else{
            return redirect()->route('dias_especiales.index',$dia->sucursal_id);
        }
    }
}
