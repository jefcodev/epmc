<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    protected $tables = "turnos";

    protected $fillable = [
    	'fecha',
        'requisito_id',
        'cedula',
        'placa',
        'turno',
        'codigo',
        'codigo_aux',
        'especial',
        'sucursal_id',
        'user_id',
    ];

    public function requisito(){
    	return $this->belongsTo('App\Requisito');
    }

    public function sucursal(){
    	return $this->belongsTo('App\Sucursal');
    }
    
    public function user(){
    	return $this->belongsTo('App\User');
    }

    protected $dates = ['fecha'];
    
    public function getCreatedUTCAttribute()
    {
        return $this->created_at->addHours(-5)->translatedFormat('Y-m-d H:i:s');
    }
}
