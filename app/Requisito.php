<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisito extends Model
{
    protected $table = "requisitos";

    protected $fillable = [
    	'nombre', 'ruta', 'descripcion', 'orden'
    ];

    public function turnos(){
    	return $this->hasMany('App\Turno');
    }
}
