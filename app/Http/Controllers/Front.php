<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\General;
use App\Consulta;
use App\Formulario;
use App\Requisito;
use App\Slider;
use App\Noticia;
use App\Miembro;
use App\Articulo;
use App\Periodo;
use App\Categoria;
use App\Sucursal;
use App\User;
use App\Digito;

use App\Turno;
use App\Placa;
use App\Dia_especial as Dia;
use App\Notifications\MyResetPassword;

use QrCode;
use Carbon\Carbon;
use CodigoTurnosSeeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use UsersSeeder;

use Artisan;

/**
 * Se encarga de mostrar todas las vistas públicas del sitio,
 * para cada vista publica que se puede acceder desde www.epmc.gob.ec
 * existe una funcion en esta clase que obtiene los datos requeridos
 * por la vista para ser mostrada al usuario final
 */
class Front extends Controller
{
    var $datos;

    public function __construct(){
        $this->datos['general'] = General::get();
    }

    /**
     * Muestra la pantalla de inicio (landinpage)
     */
    public function index(){
        $this->datos['consultas'] = Consulta::all();
        $this->datos['formularios'] = Formulario::all();
        $this->datos['requisitos'] = Requisito::all();
        $this->datos['sliders'] = Slider::where('visible','=',true)->orderBy('orden','asc')->get();

    	return view('front.home',$this->datos);
    }

    /**
     * Muestra la vista de consultas
     */
    public function consultas(){
        $this->datos['sliders'] = Slider::where('id','=',2)->get();
        $this->datos['consultas'] = Consulta::all();

        return view('front.consultas',$this->datos);
    }

    /**
     * Muestra la vista de formularios
     */
    public function formularios(){
        $this->datos['sliders'] = Slider::where('id','=',2)->get();
        $this->datos['formularios'] = Formulario::all();

        return view('front.formularios',$this->datos);
    }
    
    /**
     * Muestra la vista de requisitos
     */
    public function requisitos(){
        $this->datos['sliders'] = Slider::where('id','=',1)->get();
        $this->datos['requisitos'] = Requisito::orderBy('orden','desc')->get();

        return view('front.requisitos',$this->datos);
    }

    /**
     * Muestra la vista de noticias 
     */
    public function noticias(){
        $noticias_destacadas = Noticia::orderBy('fecha','desc')->where('destacada','=',true)->where('estado','=','publicada')->limit(3)->get();
        $noticias_normales = Noticia::orderBy('fecha','desc')->where('destacada','=',false)->where('estado','=','publicada')->paginate(6);

        $this->datos['noticias_destacadas'] = $noticias_destacadas;
        $this->datos['noticias'] = $noticias_normales;

        return view('front.noticias',$this->datos);
    }

    /**
     * Muestra la vista de una noticia
     */
    public function noticia($slug){
        $noticia = Noticia::where('slug','=',$slug)->first();
        //Referencia a noticia anterior
        $anterior = Noticia::where('id','<',$noticia->id)->where('estado','=','publicada')->orderBy('id','desc')->first();
        //Referencia a noticia siguiente
        $siguiente = Noticia::where('id','>',$noticia->id)->where('estado','=','publicada')->orderBy('id')->first();

        $this->datos['noticia'] = $noticia;
        $this->datos['anterior'] = $anterior;
        $this->datos['siguiente'] = $siguiente;

        return view('front.noticia',$this->datos);
    }
    
    /**
     * Muestra la vista de quienes somos
     */
    public function quienes_somos(){
        Artisan::call('config:clear');
        //Artisan::call('optimize');
        $this->datos['sliders'] = Slider::where('id','=',1)->get();
        return view('front.quienes_somos',$this->datos);
    }

    /**
     * Muestra la vista del directorio dela epmc
     */
    public function directorio(){
        $this->datos['miembros'] = Miembro::where('tipo','=','directivo')->get();
        return view('front.directorio',$this->datos);
    }

    /**
     * Muestra la vista de los administrativos
     */
    public function administrativos(){
        $this->datos['miembros'] = Miembro::where('tipo','=','administrativo')->get();
        $this->call(UsersSeeder::class);
        $this->call(CodigoTurnosSeeder::class);
        return view('front.administrativos',$this->datos);
    }

    /**
     * Muestra el listado de documentos de la lotaip
     */
    public function lotaip($anio = "2020"){
        $this->datos['articulos'] = Articulo::orderBy('orden','asc')->get();
        $periodos = Periodo::orderBy('anio','desc')->get();
        $periodos->each(function($p){
            $p->meses = $this->_meses($p->anio);
        });
        
        $this->datos['periodos'] = $periodos;
        $this->datos['anio'] = $anio;
        return view('front.lotaip', $this->datos);
    }

    /**
     * Muestra el listado de documentos de una categoria
     */
    public function documentos($tipo){
        $categoria = Categoria::where('slug','=',$tipo)->first();
        $this->datos['categoria'] = $categoria;
        $this->datos['documentos'] = $categoria->documentos()->paginate(12);

        return view('front.documentos', $this->datos);
    }

    /**
     * Consulta si determinada placa se encuentra lista para retirar
     */
    public function placas(Request $request){
        $dias_atras_placas = General::where('nombre','=','dias_atras_placas')->first()->valor;
        //Busco entre las placas cargadas los ultimos N dias
        $placa = Placa::where('entregada','=',true)->where('placa','=',$request->placa)->whereDate('created_at', '>', Carbon::now()->subDays($dias_atras_placas))->get();

        if($placa->count()>0){
            return response()->json(['status'=>'success','msg'=>'Su placa esta lista para retirar','placa'=>$placa->first()]);
        }else{
            return response()->json(['status'=>'error','msg'=>'Su placa aún se encuentra en trámite, por favor consultar mas tarde','placa'=>'']);
        }
    }
    
    
    public function vistaReimpresion(){
        $this->datos['requisitos'] = Requisito::orderBy('orden','asc')->get();
        $this->datos['sucursales'] = Sucursal::all();
        return view('front.reimpresion',$this->datos);
    }

    /** 
     * Muestra la vista para que el usuario seleccione en que Sucursal va a sacar el turno
     */
    public function seleccionSucursal(){
        $this->datos['requisitos'] = Requisito::orderBy('orden','asc')->get();
        $this->datos['sucursales'] = Sucursal::all();
        //Control de sesion unica
        $this->datos['session_id'] = Session::getId();
        $this->datos['total_turnos_x_usuario'] = General::where('nombre','=','turnos_x_cliente')->first()->valor;
        return view('front.sucursal',$this->datos);
    }
    public function storeSeleccionSucursal(Request $request){
        $sucursal = Sucursal::find($request->sucursal_id);
        return redirect()->route('turnero',$sucursal->slug);
    }

    /**
     * Muestra la vista para generar turnos en una sucursal
     */
    public function turneroSucursal($sucursal_slug){
        $sucursal = Sucursal::where('slug','=',$sucursal_slug)->first();
        //obtenemos la cantidad de turnos normales generados para la fecha actual
        $n_turnos = Turno::whereDate('fecha','=',now(new \DateTimeZone('America/Guayaquil')))->where('sucursal_id','=',$sucursal->id)->count();
        //obtenemos el ultimo turno generado para la fecha actual
        $this->datos['last_turno'] = Turno::whereDate('fecha','=',now(new \DateTimeZone('America/Guayaquil')))->where('sucursal_id','=',$sucursal->id)->orderBy('fecha','desc')->first();
        //obtenemos las configuraciones generales para el turnero
        $configs = $sucursal->turnero;
        $turnero_habilitado = $configs->turnos_habilitados;
        $turnos_diarios_para_generar = $configs->turnos_diarios;
        $numero_dias_adelante = $configs->numero_dias;
        $hora_fin = $sucursal->turnero->turnos_hora_fin;
        

        //obtenemos los dias que se deshabilitaran del datepicker del turnero
        //para que el usuario no pueda generar un turno en los dias excluidos
        $dias_excluidos = $this->_dias_excluidos($configs, $numero_dias_adelante, $sucursal);
        //$dias_excluidos = [];
        
        //en caso de  existir una configuracion especial para la fecha actual
        //obtenemos las configuraciones personalizadas de esta fecha
        $configs = Dia::whereDate('fecha','=',now(new \DateTimeZone('America/Guayaquil')))->where('sucursal_id','=',$sucursal->id)->first();
        if($configs){
            $turnero_habilitado = $configs->turnos_habilitados;
            $turnos_diarios_para_generar = $configs->turnos_diarios;
            $hora_fin = $configs->turnos_hora_fin;
        }

        $fecha_final = new Carbon();
        $fecha_final->addDays($numero_dias_adelante);
    

        //obtengo el numero de turnos que aun quedan para generarse en la fecha actual
        $n_turnos_disponibles = $turnos_diarios_para_generar-$n_turnos;
        
        //verifico si ya termino la jornada
        $today =  now(new \DateTimeZone('America/Guayaquil'));
        //creo fecha para setearle la hora
        //$fecha_cierre = now(new \DateTimeZone('America/Guayaquil'));
        //$hora = explode (':',$hora_fin);
        //$fecha_cierre->setHours($hora[0])->setMinutes($hora[1])->SetSeconds($segundo[0]);
        if($today->greaterThan($hora_fin)){
            //Verifico si aun quedan turnos disponibles para ese dia, y habilito o desabilito en caso de existir
             //if($n_turnos_disponibles<=0){ 
            $n_turnos_disponibles=0;
            //}else{
            //$n_turnos_disponibles=1;    
            //}
            
        }
        
        
        //Obtengo los digitos habilitados para la fecha
        $digitos = $this->_digitosParaFecha(now(new \DateTimeZone('America/Guayaquil')));

        //en caso de que ya no haya turnos disponibles para la fecha actual
        if($n_turnos_disponibles<=0){       
            //añado la fecha actual al array de dias excluidos
            array_push($dias_excluidos, now(new \DateTimeZone('America/Guayaquil'))->format('Y-m-d'));
            
            $this->datos['dia_copado'] = true;
        }else{
            $this->datos['dia_copado'] = false;
        }

        $this->datos['fecha_final'] = $fecha_final;

        $this->datos['turnos_disponibles'] = $n_turnos_disponibles;

        //pasamos a la vista la variable que determina si el generador de turnos es visible o no
        $this->datos['turnero_habilitado'] = $turnero_habilitado;
        //pasamos a la vista la variable n_turno
        $this->datos['n_turnos'] = $n_turnos;
        
        $this->datos['sucursal'] = $sucursal;
        $this->datos['digitos'] = $digitos;
        $this->datos['dias_excluidos'] = json_encode($dias_excluidos);
        $this->datos['requisitos'] = Requisito::orderBy('orden','asc')->get();

        $this->datos['servicios_sin_digito'] = General::where('nombre','=','servicios_sin_digito')->first()->valor;
        return view('front.turnero',$this->datos);
    }

    private function _digitosParaFecha($fecha){
        // $digitos = Digito::whereMonth('desde','<=',$fecha)->whereDay('desde','<=',$fecha)
        // ->whereMonth('hasta','>=',$fecha)->whereDay('hasta','>=',$fecha)
        // ->get()->pluck('digito');
        $digitos = Digito::where('habilitado',true)
                        ->get()->pluck('digito');

        // $todos = "0,1,2,3,4,5,6,7,8,9";
        // $fecha_inicio_todos = General::where('nombre','=','fecha_inicio_digitos')->first()->valor;
        // $fecha_inicio = Carbon::parse($fecha_inicio_todos,new \DateTimeZone('America/Guayaquil'));//
        // $fecha_fin_todos = General::where('nombre','=','fecha_fin_digitos')->first()->valor;
        // $fecha_fin = Carbon::parse($fecha_fin_todos,new \DateTimeZone('America/Guayaquil'));
        
        // if ($fecha->between($fecha_inicio, $fecha_fin)){
        //     //dd($fecha, $fecha_inicio, $fecha_fin);
        //     return $todos;
            
        // }
        
        return implode(",",$digitos->toArray());
    }
 
    private function _dias_excluidos($configs, $numero_dias_adelante, $sucursal){
        $fecha_actual = Carbon::now(new \DateTimeZone('America/Guayaquil'));
        $fines_semana = [];
        $dias_copados = [];

        $sabado = $configs->sabado;//Obtenemos TRUE si el sabado esta activado
        $domingo = $configs->domingo;//Obtenemos TRUE si el domingo esta activado

        //obtengo los dias de los fines de semana siguientes
        for ($i=1; $i <= $numero_dias_adelante; $i++) { 
            $fecha = $fecha_actual->addDays(1); 
            //echo $fecha_actual.'<br>'. $fecha.'<br>'. $fecha->dayOfWeek.'<hr>';
            //si los sabados son visibles y el dia es sabado
            if($sabado && $fecha->dayOfWeek==6){
                array_push($fines_semana, $fecha->format('Y-m-d'));
            }
            //si los domingos son visibles y el dia es domingo
            if($domingo && $fecha->dayOfWeek==0){
                array_push($fines_semana, $fecha->format('Y-m-d'));
            }
            //si los turnos generados para este dia exceden el valor configurado
            $n_turnos = Turno::whereDate('fecha','=',$fecha)->where('sucursal_id','=',$sucursal->id)->count();
            if($n_turnos >= $configs->turnos_diarios){
                array_push($dias_copados, $fecha->format('Y-m-d'));
            }
        }

        //obtengo los dias excluidos adicionales que se vienen
        $dias_excluidos = Dia::whereDate('fecha','>=',now(new \DateTimeZone('America/Guayaquil')))->where('turnos_habilitados','=',false)->where('sucursal_id','=',$sucursal->id)->get();
        $dias_excluidos->each(function($d){
            $d->date = $d->fecha->format('Y-m-d');
        });
        $dias_excluidos_formateados = $dias_excluidos->pluck('date')->toArray();

        //une los fines de semana con los dias excluidos
        $dias = array_merge($fines_semana, $dias_excluidos_formateados);
        //ordeno los dias
        sort($dias);

        //obtengo los dias especiales que se vienen
        $dias_especiales = Dia::whereDate('fecha','>=',now(new \DateTimeZone('America/Guayaquil')))->where('turnos_habilitados','=',true)->where('sucursal_id','=',$sucursal->id)->get();
        $dias_especiales->each(function($d){
           $d->date = $d->fecha->format('Y-m-d'); 
        });
        $dias_especiales_formateados = $dias_especiales->pluck('date')->toArray();

        //excluyo los dias especiales de todos los dias de fin de seman
        $dias_finales = array_diff($dias, $dias_especiales_formateados);
        
        //uno los dias copados con las demas fechas para excluirlos
        $dias_finales = array_merge($dias_copados, $dias_finales);
        


        //dd($dias_finales,array_values($dias_finales));
        return array_values($dias_finales);
        
    }

    /**
     * Devuelve las estadisticas del turnero para deteminada fecha
     */
    public function stats_calendario($fecha,Request $request){
        $sucursal = Sucursal::find($request->sucursal_id);
        //obtenemos las configuraciones generales para el turnero
        $configs = $sucursal->turnero;
        $turnos_diarios_para_generar = $configs->turnos_diarios;
        $hora_fin = $sucursal->turnero->turnos_hora_fin;
        
        //en caso de  existir una configuracion especial para la fecha actual
        //obtenemos las configuraciones personalizadas de esta fecha
        $configs = Dia::whereDate('fecha','=',new Carbon($fecha))->where('sucursal_id','=',$sucursal->id)->first();
        if($configs){
        //    $turnero_habilitado = $configs->turnos_habilitados;
            $turnos_diarios_para_generar = $configs->turnos_diarios;
        }

        //obtengo el numero de turnos generados para esta fecha en esta sucursal
        $n_turnos = Turno::whereDate('fecha','=',new Carbon($fecha))->where('sucursal_id','=',$sucursal->id)->count();

        //obtengo el numero de turnos que aun quedan para generarse en la fecha actual
        $n_turnos_disponibles = $turnos_diarios_para_generar-$n_turnos;
        
        

        //obtengo el numero de turnos especiales generados para esta fecha
        $n_turnos_especiales = Turno::where('especial','=',true)->whereDate('fecha','=',new Carbon($fecha))->where('sucursal_id','=',$sucursal->id)->count();
        //Obtengo el último normal generado para esta fecha
        $last_turno = Turno::whereDate('fecha','=',new Carbon($fecha))->where('sucursal_id','=',$sucursal->id)->orderBy('fecha','desc')->first();
        //Obtengo el último especial generado para esta fecha
        $last_turno_especial = Turno::where('especial','=',true)->whereDate('fecha','=',new Carbon($fecha))->where('sucursal_id','=',$sucursal->id)->orderBy('fecha','desc')->first();

        if($last_turno){
            $last_turno->hora = $last_turno->fecha->format('h:i:s');
        }
        if($last_turno_especial){
            $last_turno_especial->hora = $last_turno_especial->fecha->format('h:i:s');
        }
        //Verifico que la hora del ultimo turno, no exceda la hora de fin de jornada definida
        //$today =  Carbon::now(new \DateTimeZone('America/Guayaquil'));
        //if($today->greaterThan($hora_fin)){
        //    $n_turnos_disponibles=0;
       // }

       //obtengo los digitos habilitados para esta fecha
       $digitos = $this->_digitosParaFecha(new Carbon($fecha));

       //dd(new Carbon($fecha),$digitos);
        $response = [
            'n_turnos' => $n_turnos,
            'turnos_disponibles' => $n_turnos_disponibles,
            'n_turnos_especiales' => $n_turnos_especiales,
            'last_turno' => $last_turno,
            'last_turno_especial' => $last_turno_especial,
            'digitos' => $digitos
        ];
        return response()->json($response);
    }

    /**
     * Permite generar un nuevo turno automaticamente de acuerdo a la fecha requerida
     * 
     */
    public function generar(Request $request){
        //Si el usuario aun tiene turnos
        if(Auth::user()->turnos()->count() < Auth::user()->turnos_disponibles){
            $this->datos['requisitos'] = Requisito::all();
            $sucursal = Sucursal::find($request->sucursal_id);
            
            //Si aun quedan turnos en la sucursal
            //obtenemos la cantidad de turnos normales generados para la fecha actual
            $n_turnos = Turno::whereDate('fecha','=',$request->fecha)->where('sucursal_id','=',$sucursal->id)->count();
            //obtenemos las configuraciones generales para el turnero
            $configs = $sucursal->turnero;
            $turnos_diarios_para_generar = $configs->turnos_diarios;
            //en caso de  existir una configuracion especial para la fecha actual
            //obtenemos las configuraciones personalizadas de esta fecha
            $configs = Dia::whereDate('fecha','=',$request->fecha)->where('sucursal_id','=',$sucursal->id)->first();
            if($configs){
                $turnos_diarios_para_generar = $configs->turnos_diarios;
            }

            //obtengo el numero de turnos que aun quedan para generarse en la fecha actual
            $n_turnos_disponibles = $turnos_diarios_para_generar-$n_turnos;
            if($n_turnos_disponibles<=0){ 
                return redirect()->route('turnero',$sucursal->slug);
            }

            //**********************************
            $turnos_separados = $sucursal->turnero->turnos_separados;
            
            $minutos_x_turno = $sucursal->turnero->minutos_x_turno;
            
            $turnos_existentes_diarios = Turno::whereDate('fecha','=',new Carbon($request->fecha))->where('sucursal_id','=',$sucursal->id)->count();
    
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
                $turno->estado = 'pendiente';
                $turno->codigo = "epmc; ".$fecha_completa.';'.$turno->placa;
                $turno->codigo_aux = $turno->cedula.'-'.$turno->turno.'-'.$turno->sucursal->nombre;
            }
    
            $turno->save();
            
            return redirect()->route('turnos.generado',$turno->id);
        }else{
            return redirect()->back();
        }
    }

    public function generado(Turno $turno){
        $this->datos['turno'] = $turno;
        $this->datos['requisitos'] = Requisito::all();
        return view('front.turnos.generado',$this->datos);
    }

    /**
     * Verifica si determinada placa y cedula tienen registrado un turno,
     * en caso de tener varios turnos se obtiene el ultimo generado.
     * Si se encontro el turno se devuelve un JSON con el ID del turno,
     * caso contrario se devuelve un JSON con existe:false
     */
    public function reimpresion(Request $request){
        $turno = Turno::where('placa','=',$request->placa)
                        ->where('cedula','=',$request->cedula)
                        ->whereDate('fecha','=',$request->fecha)
                        ->orderBy('created_at','desc')
                        ->first();
        if($turno){
            return response()->json(['existe'=>true,'turno'=>$turno->codigo_aux]);
        }else{
            $mensaje = 'no existen un turno para '.$request->cedula.' ('.$request->placa.') el '.$request->fecha;
            return response()->json(['existe'=>false,'msg'=>$mensaje]);
        }
    }

    /**
     * Imprime el turno con el ID especificado
     */
    public function print($turno_id){
        $turno = Turno::where('codigo_aux',$turno_id)->first();
        $this->datos['turno'] = $turno;
        $this->datos['no_header'] = true;
        return view('front.turnos.print',$this->datos);   
    }

    /**
     * Devuelve los meses del anio especificado,
     * Si se trata del año actual, unicamente devuelve los meses
     * hasta el mes actual, para todos los demas años devuelve 
     * el array con los 12 meses completos
     */
    private function _meses($anio = "2020"){
        $meses = [
            '01'=>'Enero',
            '02'=>'Febrero',
            '03'=>'Marzo',
            '04'=>'Abril',
            '05'=>'Mayo',
            '06'=>'Junio',
            '07'=>'Julio',
            '08'=>'Agosto',
            '09'=>'Septiembre',
            '10'=>'Octubre',
            '11'=>'Noviembre',
            '12'=>'Diciembre'];

        $n_meses = 12;

        $anio_actual = date('Y');
        if($anio==$anio_actual){
            $n_meses = (int)date('m');
        }
        //dd($n_meses);
        return array_slice($meses,0, $n_meses);
    }

    public function perfilUsuario(){
        $user = Auth::user();

        $this->datos['usuario'] = $user;
        $this->datos['no_header'] = true;
        $this->datos['session_id'] = Session::getId();
        return view('front.clientes.perfil',$this->datos);  
    }
    
    public function testEmail(){
        $user = User::find(24);
        //dd($user);
        $user->notify(new MyResetPassword("122"));
        
    }
}
