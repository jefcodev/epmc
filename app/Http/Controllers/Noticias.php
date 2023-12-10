<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Noticia;
use App\Imagen;
use Illuminate\Support\Str;

class Noticias extends Controller
{

    var $datos= [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->datos['noticias'] = Noticia::orderBy('fecha','desc')->get();
        return view('back.noticias.index',$this->datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.noticias.create',$this->datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $noticia = new Noticia($request->all());
        $noticia->slug = Str::slug($noticia->titulo);

        $noticia->destacada = $request->has('destacada') ? true : false;

        $latestSlug = Noticia::whereRaw("slug RLIKE '^{$noticia->slug}(-[0-9]*)?$'")
                                ->latest('id')
                                ->value('slug');
        if($latestSlug){
            $pieces = explode('-',$latestSlug);
            $number = intval(end($pieces));
            $noticia->slug .= '-' . ($number+1);
        }

        if($request->file('imagen'))
        {
            $file = $request->file('imagen');
            $name = 'new_'.time().'.'.$file->getClientOriginalExtension();
            
            $path = public_path().'/front/img/news/';
            $file->move($path,$name);
            $noticia->imagen=$name;
        }
        $noticia->save();

        if($request->hasFile('imagenes')){
            foreach ($request->file('imagenes') as $file){
                $name = 'pic_'.time().'.'.$file->getClientOriginalExtension();
                $path = public_path().'/front/img/news/';
                $file->move($path,$name);
                $imagen = new Imagen();
                $imagen->nombre = $noticia->titulo;
                $imagen->ruta = $name;
                $imagen->tabla_referencia = "noticias";
                $imagen->id_referencia = $noticia->id;
                $imagen->save();
            }
        }


        return redirect()->route('noticias.index')->with('success','Noticia creada correctamente!');
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
        $this->datos['noticia'] = Noticia::find($id);
        return view('back.noticias.edit',$this->datos);
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
        $noticia = Noticia::find($id);
        $noticia->fill($request->all());
        $noticia->slug = Str::slug($noticia->titulo);
        $noticia->destacada = $request->has('destacada') ? true : false;

        if($request->file('imagen'))
        {
            $file = $request->file('imagen');
            $name = 'f_'.time().'.'.$file->getClientOriginalExtension();
            
            $path = public_path().'/front/img/news/';
            $file->move($path,$name);
            $noticia->imagen=$name;
        }

        $noticia->save();

        return redirect()->route('noticias.index')->with('success','Noticia actualizada correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $noticia = Noticia::find($id);
        $noticia->delete();

        if($request->ajax())
        {
            return response()->json(['success'=>TRUE,'id'=>$id]);
        }else{
            return redirect()->route('noticias.index')->with('success','Noticia eliminada correctamente!');
        }
    }
}
