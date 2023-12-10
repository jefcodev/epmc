<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

use App\Categoria;
use App\Turno;
use App\Noticia;

use Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;

class MenuComposer{

	public function compose(View $view)
	{
		$categorias = Categoria::orderBy('orden','ASC')->where('visible','=',true)->get();
		$total_turnos = Turno::whereYear('fecha',date('Y'))->count();
		$hoy_turnos = Turno::whereDate('fecha',date('Y-m-d'))->count();
		//$google_stats = $this->google_stats();
        $noticias_destacadas = Noticia::orderBy('fecha','desc')->where('estado','=','publicada')->where('destacada','=',TRUE)->paginate(2);
        $ultimas_noticias = Noticia::orderBy('fecha','desc')->where('estado','=','publicada')->limit(3)->get();
        $noticias = $noticias_destacadas->merge($ultimas_noticias);

		$view->with('categorias_data',$categorias)
			->with('ultimas_noticias',$noticias)
            ->with('total_turnos',$total_turnos)
			->with('hoy_turnos',$hoy_turnos)
			->with('visitas_total',0)
			->with('visitas_mensuales',0);
	}

	public function google_stats(){
        $stats = [];
        //fetch the most visited pages for today and the past week
        //$dato = Analytics::getActiveUsers();

        //*****************************************
        $inicio_proyecto = Carbon::parse('2018-01-23');
        $inicio_mes = Carbon::now()->startOfMonth();
        $hoy = Carbon::now();
        //*****************************************
        $periodo_proyecto = Period::create($inicio_proyecto, $hoy);
        $periodo_mensual = Period::create($inicio_mes, $hoy);        

        //*****************************************

        $mensual_array = Analytics::performQuery($periodo_mensual,'ga:visitors');
        $total_array = Analytics::performQuery($periodo_proyecto,'ga:visitors');

        $stats['users_month'] = $mensual_array['rows'][0][0];
        $stats['users_total'] = $total_array['rows'][0][0];
        
        return $stats;
    }
}