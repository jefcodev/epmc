<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = "sliders";

    protected $fillable = [
    	'title', 'subtitle', 'url', 'imagen', 'texto_boton', 'externo', 'orden', 'visible'
    ];
}
