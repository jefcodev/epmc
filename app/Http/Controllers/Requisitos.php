<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Requisito;

class Requisitos extends Controller
{
     var $datos= [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->datos['requisitos'] = Requisito::orderBy('orden','desc')->get();
        return view('back.requisitos.index',$this->datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.requisitos.create',$this->datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formulario = new Requisito($request->all());

        if($request->file('documento'))
        {
            $file = $request->file('documento');
            $name = 'f_'.time().'.'.$file->getClientOriginalExtension();
            
            $path = public_path().'/requisitos/';
            $file->move($path,$name);
            $formulario->ruta=$name;
        }

        $formulario->save();

        return redirect()->route('requisitos.index')->with('success','Requisito creado correctamente!');
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
        $this->datos['formulario'] = Requisito::find($id);
        return view('back.requisitos.edit',$this->datos);
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
        $formulario = Requisito::find($id);
        $formulario->fill($request->all());
        if($request->file('documento'))
        {
            $file = $request->file('documento');
            $name = 'f_'.time().'.'.$file->getClientOriginalExtension();
            
            $path = public_path().'/requisitos/';
            $file->move($path,$name);
            $formulario->ruta=$name;
        }

        $formulario->save();

        return redirect()->route('requisitos.index')->with('success','Requisito actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $formulario = Requisito::find($id);
        $formulario->delete();

        if($request->ajax())
        {
            return response()->json(['success'=>TRUE,'id'=>$id]);
        }else{
            return redirect()->route('requisitos.index');
        }
    }
}
