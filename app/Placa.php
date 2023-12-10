<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Placa extends Model
{
    protected $table = "placas";

    protected $fillable = [
    	'placa', 'entregada', 'tipo', 'created_by'
    ];
}
