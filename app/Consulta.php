<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $table = "consultas";

    protected $fillable = [
    	'nombre', 'url', 'descripcion', 'orden', 'externo'
    ];
}
