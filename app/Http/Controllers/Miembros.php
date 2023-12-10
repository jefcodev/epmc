<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Miembro;

class Miembros extends Controller
{
     var $datos= [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->datos['miembros'] = Miembro::orderBy('tipo','asc')->get();
        return view('back.miembros.index',$this->datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.miembros.create',$this->datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $miembro = new Miembro($request->all());

        if($request->file('imagen'))
        {
            $file = $request->file('imagen');
            $name = 'f_'.time().'.'.$file->getClientOriginalExtension();
            
            $path = public_path().'/team/';
            $file->move($path,$name);
            $miembro->imagen=$name;
        }

        $miembro->save();

        return redirect()->route('miembros.index')->with('success','Miembro creado correctamente!');
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
        $this->datos['miembro'] = Miembro::find($id);
        return view('back.miembros.edit',$this->datos);
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
        $miembro = Miembro::find($id);
        $miembro->fill($request->all());
        if($request->file('imagen'))
        {
            $file = $request->file('imagen');
            $name = 'f_'.time().'.'.$file->getClientOriginalExtension();
            
            $path = public_path().'/team/';
            $file->move($path,$name);
            $miembro->imagen=$name;
        }

        $miembro->save();

        return redirect()->route('miembros.index')->with('success','Miembro actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $miembro = Miembro::find($id);
        $miembro->delete();

        if($request->ajax())
        {
            return response()->json(['success'=>TRUE,'id'=>$id]);
        }else{
            return redirect()->route('miembros.index');
        }
    }
}
