<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $table = "noticias";

    protected $fillable = [
    	'titulo', 'subtitulo', 'slug', 'contenido', 'descripcion', 'estado', 'tags', 'autor_id','fecha', 'link', 'imagen', 'destacada'
    ];

    protected $dates = [ 'fecha'];

    public function autor(){
    	return $this->belongsTo('App\User','autor_id','id');
    }

    /**
     * Devuelve las imagenes de una noticia
     * @param  [type] $query [description]
     * @return App/Imagen       Coleccion de Objetos tipo Imagen
     */
    public function scopeImagenes($query){
        return Imagen::where('tabla_referencia',$this->table)
                ->where('id_referencia',$this->id);
    }
}
