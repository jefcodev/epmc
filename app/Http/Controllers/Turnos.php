<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Importamos el modelo Turno para poder trabajar con la 
 * tabla de turnos de la base de datos
 */
use App\Turno;
/**
 * Importamos el modelo General para poder obtener todas las
 * configuraciones del turnero almacenadas en la base de datos
 */
use App\General;

use App\Requisito;

use App\Dia_especial as Dia;

use Carbon\Carbon;

use App\Sucursal;

use App\Exports\TurnosExport;
use App\User;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;

/**
 * Se encarga de la administración del turnero
 */
class Turnos extends Controller
{

	var $datos;

    /**
     * Obtiene las configuraciones generales desde la base de datos
     */
    public function __construct(){
        $this->datos['general'] = General::get();
    }

    /**
     * Obtiene todos los turnos ordenados por fecha para pasarlos
     * a la vista con el listado de turnos
     */
    public function index(Request $request){
        if($request->ajax())
        {
            $data = Turno::with(['requisito','sucursal']);
            
            return DataTables::of($data)
                    ->addColumn('action', function($data){
                        return view('back.turnos.partials.actions',['turno'=>$data]);
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        $this->datos['turnos']= Turno::orderBy('fecha','desc')->paginate(10);
    	return view('back.turnos.index',$this->datos);
    }

    /**
     * Obtiene todos los turnos ordenados por fecha para pasarlos
     * a la vista con el calendario de turnos
     */
    public function calendario($sucursal_id){
        $this->datos['sucursal'] = Sucursal::find($sucursal_id);
        $this->datos['turnos']= Turno::orderBy('fecha','desc')->get();
        $this->datos['dias']= Dia::orderBy('fecha','desc')->get();
        return view('back.turnos.calendario',$this->datos);
    }

    public function configs(){
        $this->datos['general'] = General::get();
        return view('back.turnos.configs',$this->datos);   
    }

    /**
     * Muestra el formulario para crear un nuevo turno
     */
    public function create(){
        $this->datos['sucursales_data'] = Sucursal::all()->pluck('nombre','id');
        $this->datos['requisitos'] = Requisito::all()->pluck('nombre','id');
        $this->datos['clientes'] = User::role('cliente')->get();
        $this->datos['last_turno'] = Turno::where('especial','=',true)->whereDate('fecha','=',new Carbon())->orderBy('fecha','desc')->first();

        $turnos_existentes_diarios = Turno::where('especial','=',true)->whereDate('fecha','=',new Carbon())->count();
        $numero_turno = ($turnos_existentes_diarios+1);

        $this->datos['next_turno'] = $numero_turno;
        $dias_excluidos = Dia::where('turnos_habilitados','=',false)->get();

        $dias_excluidos->each(function($d){
            $d->date = $d->fecha->format('Y-m-d');
        });
        $this->datos['dias_excluidos'] =  json_encode($dias_excluidos->pluck('date'));

        return view('back.turnos.create', $this->datos);
    }

    /**
     * Toma los datos desde el formulario para crear un nuevo turno
     * y lo genera tomando en cuenta las configuraciones y finalmente
     * lo almacena en la base de datos
     */
    public function store(Request $request){
        
        $sucursal = Sucursal::find($request->sucursal_id);
        $minutos_x_turno = $sucursal->turnero->minutos_x_turno;
        //si se trata de un turno especial
        if($request->has('especial')){
            //obtengo los turnos existentes para le fecha seleccionada
            $turnos_especiales_existentes_diarios = Turno::where('especial','=',true)->whereDate('fecha','=',new Carbon($request->fecha))->where('sucursal_id','=',$sucursal->id)->count();
            
             //Si es el primer turno del dia
            if($turnos_especiales_existentes_diarios == 0){
                //Obtengo la hora inicial para la generación de turnos
                $hora_inicio = $sucursal->turnero->turnos_especiales_hora_inicio;
                $fecha_completa = new Carbon($request->fecha.' '.$hora_inicio);
            }else{
                //Si ya existen turnos para un dia, se selecciona el ultimo turno y se obtiene la fecha
                $fecha_completa = Turno::where('especial','=',true)->whereDate('fecha','=',new Carbon($request->fecha))->where('sucursal_id','=',$sucursal->id)->orderBy('fecha','desc')->first()->fecha;
                //Añado los N minutos para cada ticket
                $fecha_completa->addSeconds($minutos_x_turno*60);
            }
            $numero_turno = ($turnos_especiales_existentes_diarios)+1;
            $turno = new Turno($request->all());
            $turno->especial = true;
            $turno->fecha = $fecha_completa;
            $turno->turno= $numero_turno;
            $turno->codigo = "ep-mc; ".$fecha_completa.';'.$turno->placa;
            $turno->codigo_aux = $turno->cedula.'-'.$turno->turno.'-'.$turno->sucursal->nombre;
            $turno->save();
        }else{
            //**********************************
            $turnos_separados = $sucursal->turnero->turnos_separados;
            
            $minutos_x_turno = $sucursal->turnero->minutos_x_turno;
            
            $turnos_existentes_diarios = Turno::where('especial','=',false)->whereDate('fecha','=',new Carbon($request->fecha))->where('sucursal_id','=',$sucursal->id)->count();

            $numero_turno = ($turnos_separados + $turnos_existentes_diarios)+1;

            //Si es el primer turno del dia
            if($turnos_existentes_diarios == 0){
                //Obtengo la hora inicial para la generación de turnos
                $hora_inicio = $sucursal->turnero->turnos_hora_inicio;
                $fecha_completa = new Carbon($request->fecha.' '.$hora_inicio);
            }else{
                //Si ya existen turnos para un dia, se selecciona el ultimo turno y se obtiene la fecha
                $fecha_completa = Turno::whereDate('fecha','=',new Carbon($request->fecha))->where('sucursal_id','=',$sucursal->id)->orderBy('fecha','desc')->first()->fecha;
                //Añado los N minutos para cada ticket
                $fecha_completa->addSeconds($minutos_x_turno*60);
            }

            //***********************************

            //primero verifico si ya no existe un turno con los datos solicitados
            //con el objetivo de no duplicar turnos para el mismo usuario el mismo dia
            $turno = Turno::where('requisito_id','=', $request->requisito_id)
                            ->whereDate('fecha' , $request->fecha)
                            ->where('placa' ,'=', $request->placa)
                            ->where('cedula' ,'=', $request->cedula)
                            ->first();
            
            //Si es un nuevo turno, le seteamos la nueva fecha y nu nuevo numero
            if (!$turno){
            
                $turno = new Turno($request->all());
                $turno->fecha = $fecha_completa;

                $turno->turno= $numero_turno;

                $turno->codigo = "epmc; ".$fecha_completa.';'.$turno->placa;
                $turno->codigo_aux = $turno->cedula.'-'.$turno->turno.'-'.$turno->sucursal->nombre;
            }

        }

        $turno->save();

        return redirect()->route('turnos.index')->with('success','Turno creado correctamente!');
    }

    /**
     * Devuelve el listado de turnos y las configuraciones del calendario 
     * en formato JSON para que el calendario sea llenado y configurado
     */
    public function listado($sucursal_id){
        $turnos = Turno::where('sucursal_id','=',$sucursal_id)->get();
        $turnos->each(function($e){
            $e->title = $e->turno.'-['.$e->fecha->format('H:i').']) '.$e->placa.':'.$e->cedula;
            $e->start = $e->fecha;
            //$e->allDay=false;
            //$e->end = $e->fecha->addMinutes(2);
        });

        $dias_excluidos = Dia::where('turnos_habilitados','=',false)->get();

        $dias_excluidos->each(function($d){
            $d->time = $d->fecha->ValueOf()+18000000;
            $d->x = $d->fecha->second;
            $d->X = $d->fecha->micro;
            $d->dayOfWeek = $d->fecha->dayOfWeek;
            $d->micromtime = $d->fecha->ValueOf();
            //dd($d->fecha,$d->time);
        });
        
        $dias_configurados = Dia::where('turnos_habilitados','=',true)->get();
        
        $response = [
            'turnos' => $turnos,
            'dias_excluidos' => $dias_excluidos->pluck('time'),
            'dias' => $dias_excluidos,
            'dias_configurados' => $dias_configurados
        ];

        return response()->json($response);
    }

    public function edit(Turno $turno){
        $this->datos['turno'] = $turno;
        $this->datos['sucursales_data'] = Sucursal::all()->pluck('nombre','id');
        $this->datos['requisitos'] = Requisito::all()->pluck('nombre','id');
        $this->datos['clientes'] = User::role('cliente')->get();
        
        $dias_excluidos = Dia::where('turnos_habilitados','=',false)->get();

        $dias_excluidos->each(function($d){
            $d->date = $d->fecha->format('Y-m-d');
        });
        $this->datos['dias_excluidos'] =  json_encode($dias_excluidos->pluck('date'));

        return view('back.turnos.edit', $this->datos);
    }

    public function update(Turno $turno, Request $request){
        $turno->fill($request->all());
        $turno->save();

        return redirect()->route('turnos.index')->with('success','Turno actualizado correctamente!');
    }

    public function reportes(){
        $sucursales = Sucursal::all();
        $sucs = ['0'=>'Todas las sucursales'];
        foreach($sucursales as $s){
            $sucs[$s->id] = $s->nombre;
        }

        $this->datos['sucursales'] = $sucs;
        $this->datos['min_date'] = Carbon::parse(Turno::min('fecha'))->format('Y-m-d');
        $this->datos['max_date'] = Carbon::parse(Turno::max('fecha'))->format('Y-m-d');
        return view('back.turnos.reportes', $this->datos);
    }

    public function exportar(Request $request){
        return Excel::download(new TurnosExport($request->desde,$request->hasta, $request->sucursal_id), 'turnos '.$request->desde.' - '.$request->hasta.'.xlsx');
    }

    /**
     * Toma el id del turno y lo elimina de la base de datos permanentemente
     */
    public function destroy($id,Request $request){
        $turno = Turno::find($id);
        $turno->delete();

        if($request->ajax())
        {
            return response()->json(['success'=>TRUE,'id'=>$id]);
        }else{
            return redirect()->route('noticias.index')->with('success','Noticia eliminada correctamente!');
        }
    }
}
