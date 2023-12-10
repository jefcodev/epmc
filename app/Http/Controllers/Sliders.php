<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Slider;

class Sliders extends Controller
{
    var $datos= [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->datos['sliders'] = Slider::orderBy('orden','desc')->get();
        return view('back.sliders.index',$this->datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.sliders.create',$this->datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slider = new Slider($request->all());

        if($request->file('imagen'))
        {
            $file = $request->file('imagen');
            $name = 'user_'.time().'.'.$file->getClientOriginalExtension();
            
            $path = public_path().'/front/img/slider/';
            $file->move($path,$name);
            $slider->imagen=$name;
        }

        $slider->visible = $request->has('visible') ? true :false;
        $slider->externo = $request->has('externo') ? true :false;
        

        $slider->save();



        return redirect()->route('sliders.index')->with('success','Slider creado correctamente!');
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
        $this->datos['slider'] = Slider::find($id);
        return view('back.sliders.edit',$this->datos);
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
        $slider = Slider::find($id);

        $slider->fill($request->all());
        if($request->file('imagen'))
        {
            $file = $request->file('imagen');
            $name = 'user_'.time().'.'.$file->getClientOriginalExtension();
            
            $path = public_path().'/front/img/slider/';
            $file->move($path,$name);
            $slider->imagen=$name;
        }

        $slider->visible = $request->has('visible') ? true :false;
        $slider->externo = $request->has('externo') ? true :false;
        
        $slider->save();

        return redirect()->route('sliders.index')->with('success','Slider actualizado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $slider = Slider::find($id);
        $slider->delete();

        if($request->ajax())
        {
            return response()->json(['success'=>TRUE,'id'=>$id]);
        }else{
            return redirect()->route('sliders.index');
        }
    }
}
