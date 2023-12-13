<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;


use App\tur_turno;
use Illuminate\Http\Request;
use App\Turno;

class TurnoController extends Controller
{
    public function buscarForm()
    {
        return view('buscar');
    }

    public function buscar(Request $request)
    {
        $request->validate([
            'placa' => 'required|string',
        ]);

        $placa = $request->input('placa');

        $turno = Turno::whereRaw('LOWER(placa) = ?', [strtolower($placa)])->first();

        if ($turno) {
            // Verificar si la fecha del turno es igual a la fecha actual
            $fechaTurno = new \DateTime($turno->fecha);
            $fechaActual = new \DateTime();

            if ($fechaTurno->format('Y-m-d') === $fechaActual->format('Y-m-d')) {
                // Verificar si la placa del turno coincide con la placa ingresada
                if (strtolower($turno->placa) === strtolower($placa)) {
                    return view('resultado', ['turno' => $turno]);
                } else {
                    return redirect()->route('buscar.form')->withErrors(['error' => 'No se encontró ningún turno con esa placa.']);
                }
            } else {
                return redirect()->route('buscar.form')->withErrors(['error' => 'No existe un turno para esta placa en la fecha actual.']);
            }
        } else {
            return redirect()->route('buscar.form')->withErrors(['error' => 'No se encontró ningún turno con esa placa.']);
        }
    }



    public function agregarTipo(Request $request,$id_turno, $tipo)
{
    $turno = Turno::find($id_turno);
    $numTurno = '001';

    if ($turno) {
        if (!empty($turno->turno) && !empty($turno->fecha)) {
            $horaActual = now()->toTimeString();

            $nuevoTurTurno = new tur_turno([
                'id_turno' => $id_turno,
                'turno' => $numTurno,
                'tipo' => $request->input('tipo'),
                'fecha' => $turno->fecha,
                'hora_inicio' => $horaActual,
                'hora_fin' => $horaActual,
                'estado' => 'Activo',
            ]);

            $nuevoTurTurno->save();

            // Obtener detalles del turno recién creado
            $detallesTurno = tur_turno::find($nuevoTurTurno->id);

            return redirect()->route('turno.nuevo')->with('success', 'Se ha generado el turno.')
                ->with('detallesTurno', $detallesTurno); // Pasar detallesTurno a la vista

        } else {
            return redirect()->route('turno.nuevo')->with('error', 'No se encontró información completa del turno.');
        }
    } else {
        return redirect()->route('turno.nuevo')->with('error', 'No se encontró el turno correspondiente.');
    }
}


    public function mostrarResultado()
{
    // Lógica para obtener los resultados y pasarlos a la vista
    return view('turno');
}

    public function generarTurnoPdf(){
        $pdf=PDF::loadView('turno.generarPdf');
        return $pdf->download('turno.generar.pdf');
    }

    
}
