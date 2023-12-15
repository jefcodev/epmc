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



    public function agregarTipo(Request $request, $id_turno, $tipo)
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
                    'hora_turno' => $horaActual,
                    'estado' => 'espera',
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
    public function atender()
    {
        // Obtener el primer turno con estado "espera"
        $turnoProcesando = tur_turno::where('estado', 'espera')->orderBy('id')->first();
        // Verificar si se encontró un turno
        if ($turnoProcesando) {
            // Puedes acceder a los datos del turno así: $turnoProcesando->id_turno, $turnoProcesando->turno, $turnoProcesando->tipo
            return view('atender', ['turno' => $turnoProcesando]);
        } else {
            // Manejar el caso en que no haya turnos con estado "espera"
            return view('atender', ['turno' => null]);
        }
    }

    public function valorar(Request $request){
            // Actualizar el estado del turno a "atendido"
            
             
            $id_turno =$request->input('id_turno');
            $turnoProcesando =tur_turno::where('estado', 'espera')
                                        ->where('id_turno', $id_turno)
                                        ->orderBy('id')->first();
            $turnoProcesando->calificacion =$request->input('calificacion');
            $turnoProcesando->estado = 'Atendido';
            $turnoProcesando->save();
            return back();
    }


    public function atenderTurno()
    {
        return view('atenderTurno');
    }




    public function contarTurnosDisponibles(Request $request)
    {
        $fechaSeleccionada = $request->input('fecha');
        $horaSeleccionada = $request->input('hora');
    
        // Realizar la consulta para contar los turnos disponibles
        $turnosTotal = Turno::whereDate('fecha', $fechaSeleccionada)
            ->where('hora', $horaSeleccionada)
            ->count();
        $turnosDisponibles = 8 - $turnosTotal; 
        //dd('Turnos' . $turnosDisponibles);
        // Devolver el resultado como respuesta JSON
        return response()->json(['turnosDisponibles' => $turnosDisponibles]);
    }


    /* public function generarTurnoPdf(){
        $pdf=PDF::loadView('turno.generarPdf');
        return $pdf->download('turno.generar.pdf');
    } */
}
