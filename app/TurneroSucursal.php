<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TurneroSucursal extends Model
{
    protected $table = "turnero_sucursal";

    public $incrementing = false;

    protected $primaryKey = "sucursal_id";

    protected $fillable = [
    	'sucursal_id',
    	'turnos_habilitados',
    	'mensaje_turnos_habilitados',
    	'minutos_x_turno',
        'minutos_x_intervalo',
        'turnos_x_intervalo',
    	'turnos_diarios',
    	'turnos_separados', 
    	'turnos_hora_inicio',
    	'turnos_especiales_hora_inicio',
    	'turnos_hora_fin',
        'numero_dias',
        'sabado',
        'domingo'
    ];

    public function sucursal(){
    	return $this->belongsTo('App\Sucursal','sucursal_id','id');
    }
}
