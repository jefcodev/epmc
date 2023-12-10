<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Articulo;

class Articulos extends Controller
{
    var $datos= [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->datos['articulos'] = Articulo::orderBy('orden','desc')->get();
        return view('back.articulos.index',$this->datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.articulos.create',$this->datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $consulta = new Articulo($request->all());
        $consulta->save();

        return redirect()->route('articulos.index')->with('success','Articulo creada correctamente!');
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
        $this->datos['articulo'] = Articulo::find($id);
        return view('back.articulos.edit',$this->datos);
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
        $consulta = Articulo::find($id);
        $consulta->fill($request->all());
        $consulta->save();

        return redirect()->route('articulos.index')->with('success','Articulo actualizada correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $consulta = Articulo::find($id);
        $consulta->delete();

        if($request->ajax())
        {
            return response()->json(['success'=>TRUE,'id'=>$id]);
        }else{
            return redirect()->route('articulos.index');
        }
    }
}
