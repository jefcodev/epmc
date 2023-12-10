<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lotaip extends Model
{
    protected $table = "lotaips";

    protected $fillable = [
    	'anio', 'mes', 'tipo', 'documento_id', 'url_documento', 'articulo_id'
    ];

    public function documento(){
    	return $this->belongsTo('App\Documento');
    }
}
