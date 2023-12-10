<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
	protected $primaryKey = "anio";
	
    protected $table = "periodos";

    protected $fillable = [
    	'anio'
    ];
}
