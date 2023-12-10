<?php

namespace App\Exports;

use App\Turno;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TurnosExport implements FromCollection, WithHeadings, WithMapping {
    
    private $min_date;
    private $max_date;
    private $sucursal_id;

    public function __construct($min_date, $max_date, $sucursal_id) 
    {
        $this->min_date = $min_date;
        $this->max_date = $max_date;
        $this->sucursal_id = $sucursal_id;
    }
      
    public function headings(): array
    {
        return [
            'ID',
            'Fecha',
            'Hora',
            'Cédula',
            'Placa',
            'Código',
            'Turno',
            'Especial',
            'Trámite',
            'Creado',
            'Actualizado',
            'Sucursal'
        ];
    }

     /**
    * @var Turno $turno
    */
    public function map($turno): array
    {
        // This example will return 3 rows.
        // First row will have 2 column, the next 2 will have 1 column
        return [
            $turno->id,
            $turno->fecha->format('Y-m-d'),
            $turno->fecha->format('H:i:s'),
            $turno->cedula,
            $turno->placa,
            $turno->codigo,
            $turno->turno,
            $turno->especial,
            $turno->requisito->nombre,
            $turno->created_at,
            $turno->updated_at,
            $turno->sucursal->nombre
        ];
    }
    public function collection()
    {
        if($this->sucursal_id==0){
            return Turno::whereDate('fecha', '>=',$this->min_date)->whereDate('fecha','<=', $this->max_date)->get();
        }else{
            return Turno::where('sucursal_id','=',$this->sucursal_id)->whereDate('fecha', '>=',$this->min_date)->whereDate('fecha','<=', $this->max_date)->get();
        }
    }
}
