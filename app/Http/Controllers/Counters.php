<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;

class Counters extends Controller
{
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
        
        return response()->json($stats);
    }
}
