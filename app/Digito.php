<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Digito extends Model
{
    protected $table = "digitos";

    protected $fillable = [
        'desde', 'hasta', 'digito', 'nombre', 'descripcion','habilitado'
    ];

    protected $casts = [
        'habilitado'    =>  'boolean'
    ];

    protected $dates = ['desde','hasta'];

}
