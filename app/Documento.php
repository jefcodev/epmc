<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = "documentos";

    protected $fillable = [
    	'nombre', 'ruta', 'descripcion', 'orden','fecha','categoria_id'
    ];

    protected $dates = [ 'fecha'];
    
    public function categoria(){
    	return $this->belongsTo('App\Categoria');
    }
}
