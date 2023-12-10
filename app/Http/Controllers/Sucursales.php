<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sucursal;
use Illuminate\Support\Str;

class Sucursales extends Controller
{
    var $datos= [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->datos['sucursales'] = Sucursal::get();
        return view('back.sucursales.index',$this->datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.sucursales.create',$this->datos);
    }

    public function configTurnero($id){
        $this->datos['sucursal'] = Sucursal::find($id);
        return view('back.sucursales.config_turnero',$this->datos);   
    }
    public function storeConfigTurnero($id, Request $request){
        $sucursal = Sucursal::find($id);
        $config = $sucursal->turnero;
        $config->fill($request->all());
        $config->turnos_habilitados = $request->turnos_habilitados ? true : false;
        $config->sabado = $request->sabado ? true : false;
        $config->domingo = $request->domingo ? true : false;
        $config->save();
        return redirect()->route('sucursales.index')->with('success','Configuración actualizada correctamente!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sucursal = new Sucursal($request->all());
        $sucursal->slug=Str::slug($sucursal->nombre);
        if($request->file('imagen'))
        {
            $file = $request->file('imagen');
            $name = 'user_'.time().'.'.$file->getClientOriginalExtension();
            
            $path = public_path().'/front/img/';
            $file->move($path,$name);
            $sucursal->imagen=$name;
        }
        

        $sucursal->save();



        return redirect()->route('sucursales.index')->with('success','Sucursal creado correctamente!');
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
        $this->datos['sucursal'] = Sucursal::find($id);
        return view('back.sucursales.edit',$this->datos);
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
        $sucursal = Sucursal::find($id);
        $sucursal->fill($request->all());
        $sucursal->slug=Str::slug($sucursal->nombre);
        if($request->file('imagen'))
        {
            $file = $request->file('imagen');
            $name = 'user_'.time().'.'.$file->getClientOriginalExtension();
            
            $path = public_path().'/front/img/';
            $file->move($path,$name);
            $sucursal->imagen=$name;
        }

        
        $sucursal->save();

        return redirect()->route('sucursales.index')->with('success','Sucursal actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $sucursal = Sucursal::find($id);
        $sucursal->delete();

        if($request->ajax())
        {
            return response()->json(['success'=>TRUE,'id'=>$id]);
        }else{
            return redirect()->route('sucursales.index');
        }
    }
}
