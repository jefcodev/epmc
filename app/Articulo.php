<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $table = "articulos";

    protected $fillable = [
    	'literal', 'articulo', 'descripcion', 'orden'
    ];

    public function lotaips(){
    	return $this->belongsToMany('App\Lotaip');
    }

    public function scopeDocumentoPeriodo($query, $anio, $mes){
    	$articulo_id = $this->id;
        //dd($query->get());
    	//$res = $query->where('anio','=',$anio)->where('mes','=',$mes)->get();
    	/*$res = $query->where('id','=',$articulo_id)
            ->whereIn('id',function($sq) use( $anio, $mes ){
    		$sq->select('articulo_id');
    		$sq->from('lotaips');
    		$sq->where('anio','=',$anio)->where('mes','=',$mes);
    	})->get();*/

        $res = Lotaip::where('articulo_id','=',$articulo_id)->where('anio','=',$anio)->where('mes','=',$mes)->get();

    	return $res;
    }
}
