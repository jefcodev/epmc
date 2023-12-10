<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursales';

    protected $fillable = [
    	'nombre','direccion','canton','telefono','email','slug','imagen'
    ];

    public function turnos(){
    	return $this->hasMany('App\Turno');
    }

    public function turnero(){
    	return $this->hasOne('App\TurneroSucursal','sucursal_id','id');
    }


}
