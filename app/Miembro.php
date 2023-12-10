<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Miembro extends Model
{
    protected $table = "miembros";

    protected $fillable = [
    	'nombre', 'imagen', 'cargo', 'puesto', 'tipo', 'facebook', 'twitter', 'email', 'orden', 'link'
    ];
}
