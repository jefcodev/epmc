<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Formulario;

class Formularios extends Controller
{
    var $datos= [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->datos['formularios'] = Formulario::orderBy('orden','desc')->get();
        return view('back.formularios.index',$this->datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.formularios.create',$this->datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formulario = new Formulario($request->all());

        if($request->file('documento'))
        {
            $file = $request->file('documento');
            $name = 'f_'.time().'.'.$file->getClientOriginalExtension();
            
            $path = public_path().'/uploads/';
            $file->move($path,$name);
            $formulario->ruta=$name;
        }

        $formulario->save();

        return redirect()->route('formularios.index')->with('success','Formulario creada correctamente!');
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
        $this->datos['formulario'] = Formulario::find($id);
        return view('back.formularios.edit',$this->datos);
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
        $formulario = Formulario::find($id);
        $formulario->fill($request->all());
        if($request->file('documento'))
        {
            $file = $request->file('documento');
            $name = 'f_'.time().'.'.$file->getClientOriginalExtension();
            
            $path = public_path().'/uploads/';
            $file->move($path,$name);
            $formulario->ruta=$name;
        }

        $formulario->save();

        return redirect()->route('formularios.index')->with('success','Formulario actualizada correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $formulario = Formulario::find($id);
        $formulario->delete();

        if($request->ajax())
        {
            return response()->json(['success'=>TRUE,'id'=>$id]);
        }else{
            return redirect()->route('formularios.index');
        }
    }
}
