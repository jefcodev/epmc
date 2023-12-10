<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Categoria;
use Illuminate\Support\Str;

class Categorias extends Controller
{
    var $datos= [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->datos['categorias'] = Categoria::orderBy('orden','desc')->get();
        return view('back.categorias.index',$this->datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.categorias.create',$this->datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoria = new Categoria($request->all());
        $categoria->slug = Str::slug($categoria->categoria);
        if($request->has('visible')){
            $categoria->visible = true;
        }else{
            $categoria->visible = false;
        }
        $categoria->save();

        return redirect()->route('categorias.index')->with('success','Categoria creada correctamente!');
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
        $this->datos['categoria'] = Categoria::find($id);
        return view('back.categorias.edit',$this->datos);
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
        $categoria = Categoria::find($id);
        $categoria->fill($request->all());
        $categoria->slug = Str::slug($categoria->categoria);
        if($request->has('visible')){
            $categoria->visible = true;
        }else{
            $categoria->visible = false;
        }
        $categoria->save();

        return redirect()->route('categorias.index')->with('success','Categoria actualizada correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();

        if($request->ajax())
        {
            return response()->json(['success'=>TRUE,'id'=>$id]);
        }else{
            return redirect()->route('categorias.index');
        }
    }
}
