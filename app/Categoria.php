<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = [
    	'categoria', 'icono', 'descripcion', 'orden','slug', 'visible'
    ];

    public function documentos(){
    	return $this->hasMany('App\Documento');
    }
}
