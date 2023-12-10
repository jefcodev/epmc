<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = "imagenes";

    protected $fillable = [
    	'ruta','nombre','creditos','tabla_referencia','id_referencia'
    ];

}