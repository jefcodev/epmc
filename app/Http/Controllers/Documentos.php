<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Documento;
use App\Categoria;
use App\Lotaip;

class Documentos extends Controller
{
    var $datos= [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->datos['categorias'] = Categoria::all()->pluck('categoria','id');
        
        if($request->has('categoria')){
            $this->datos['categoria']=$request->categoria;
            if($request->categoria=="all"){
                $this->datos['documentos'] = Documento::orderBy('fecha','desc')->get();
            }else{
                $this->datos['documentos'] = Documento::where('categoria_id','=',$request->categoria)->orderBy('fecha','desc')->get();
            }
        }else{
            $this->datos['categoria']='all';
            $this->datos['documentos'] = Documento::orderBy('fecha','desc')->get();
        }
            
        return view('back.documentos.index',$this->datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$this->datos['categorias'] = Categoria::all()->pluck('categoria','id');
        return view('back.documentos.create',$this->datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $documento = new Documento($request->all());

        if($request->file('documento'))
        {
            $file = $request->file('documento');
            $name = 'f_'.time().'.'.$file->getClientOriginalExtension();
            
            $path = public_path().'/uploads/';
            $file->move($path,$name);
            $documento->ruta=$name;
        }

        $documento->save();

        return redirect()->route('documentos.index')->with('success','Documento creado correctamente!');
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
        $this->datos['documento'] = Documento::find($id);
        $this->datos['categorias'] = Categoria::all()->pluck('categoria','id');
        return view('back.documentos.edit',$this->datos);
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
        $documento = Documento::find($id);
        $documento->fill($request->all());
        if($request->file('documento'))
        {
            $file = $request->file('documento');
            $name = 'f_'.time().'.'.$file->getClientOriginalExtension();
            
            $path = public_path().'/uploads/';
            $file->move($path,$name);
            $documento->ruta=$name;
        }

        $documento->save();

        return redirect()->route('documentos.index')->with('success','Documento actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $documento = Documento::find($id);
        $documento->delete();

        Lotaip::where('documento_id','=',$id)->delete();

        if($request->ajax())
        {
            return response()->json(['success'=>TRUE,'id'=>$id]);
        }else{
            return redirect()->route('documentos.index');
        }
    }

    public function dropdownGrouped(){
        $docs = [];
        $select = "<select name='documento_id' class='form-control' id='document_id'>";

        $categorias = Categoria::orderBy('id','desc')->get();
        foreach ($categorias as $key => $categoria) {
            $docs[$categoria->categoria]=[];
            $select .= "<optgroup label='".$categoria->categoria."'>";

            foreach ($categoria->documentos as $key2 => $documento) {
                $select .= "<option value='".$documento->id."'>".$documento->nombre.'</option>';
                $docs[$categoria->categoria][$documento->id]=$documento->nombre;
            }
            $select .= "</optgroup>";
        }
        $select .= "</select";

        return $select;
        return $docs;
    }
}
