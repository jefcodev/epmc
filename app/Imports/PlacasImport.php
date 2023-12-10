<?php

namespace App\Imports;

use App\Placa;
use Maatwebsite\Excel\Concerns\ToModel;

use Auth;

class PlacasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Placa([
            'placa' => $row[0],
            //'tipo' => $row[1],
            'entregada' => false,
            'created_by' =>  Auth::user()->id
        ]);
    }
}
