<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tur_turno extends Model
{
    protected $fillable = [
        'id_turno', 'turno', 'tipo', 'fecha', 'hora_turno', 'hora_fin', 'hora_turno', 'estado','calificacion'
    ];
}
