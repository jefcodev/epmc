<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dia_especial extends Model
{
    protected $table = "dias_especiales";

    protected $fillable = [
    	'turnos_habilitados', 'fecha', 'turnos_diarios', 'turnos_separados', 
    	'turnos_hora_inicio', 'turnos_hora_fin','sucursal_id'
    ];

    protected $dates = [ 'fecha'];

    public function sucursal(){
        return $this->belongsTo(Sucursal::class,'sucursal_id','id');
    }
}
