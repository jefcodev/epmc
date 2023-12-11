<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Turno;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TurnosBuscar extends Controller
{


    public function buscar(Request $request)
    {
        $request->validate([
            'q' => 'required|string|max:255',
        ]);

        $resultados = Turno::where('placa', $request->q)
            ->select('cedula', 'requisito_id', 'sucursal_id')
            ->get();

        return view('turnos.turnos', compact('resultados'));
    }


}
