<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class General extends Model
{
    protected $table = "generales";

    protected $fillable = [
    	'nombre', 'valor', 'autoload'
    ];

    public function scopeValor($query, $key){
        $valor =  $query->where('nombre',$key)->first();
        if($valor){
            $valor = $valor->valor;
        }else{
            $valor = '';
        }

        return $valor;
    }
}
