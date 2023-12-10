<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    protected $table = "formularios";

    protected $fillable = [
    	'nombre', 'ruta', 'descripcion', 'orden', 'fecha'
    ];
}
