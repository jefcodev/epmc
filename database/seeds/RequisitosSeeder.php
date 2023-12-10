<?php

use Illuminate\Database\Seeder;

use App\Requisito;


class RequisitosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $requisito = new Requisito();
        $requisito->nombre = "TRASPASOS DE VEHÍCULOS PARTICULARES";
        $requisito->ruta = "REQUISITO_1.jpg";
        $requisito->save();

        $requisito = new Requisito();
        $requisito->nombre = "RENOVACIÓN  ANUAL  DE MATRICULACIÓN  CAMBIO DE  STICKER O ESPECIE PARTICULAR";
        $requisito->ruta = "REQUISITO_2.jpg";
        $requisito->save();

        $requisito = new Requisito();
        $requisito->nombre = "DUPLICADO DE ESPECIE DE MATRICULA  POR PÉRDIDA";
        $requisito->ruta = "REQUISITO_3.jpg";
        $requisito->save();

        $requisito = new Requisito();
        $requisito->nombre = "CAMBIO DE TIPO O COLOR DEL VEHICULO";
        $requisito->ruta = "REQUISITO_4.jpg";
        $requisito->save();

        $requisito = new Requisito();
        $requisito->nombre = "CAMBIO  DE SERVICIO DE PÚBLICO O PARTICULAR, COMERCIAL Y POR CUENTA PROPIA  A PARTICULAR";
        $requisito->ruta = "REQUISITO_5.jpg";
        $requisito->save();

        $requisito = new Requisito();
        $requisito->nombre = "CAMBIO DE SOCIO O UNIDAD";
        $requisito->ruta = "REQUISITO_6.jpg";
        $requisito->save();

        $requisito = new Requisito();
        $requisito->nombre = "CAMBIO DE ESPECIE DE VEHÍCULOS DE SERVICIO PÚBLICO";
        $requisito->ruta = "REQUISITO_7.jpg";
        $requisito->save();

        $requisito = new Requisito();
        $requisito->nombre = "CAMBIO  DE  SERVICIO DE PARTICULAR  A PÚBLICO, COMERCIAL Y POR CUENTA PROPIA";
        $requisito->ruta = "REQUISITO_8.jpg";
        $requisito->save();
        
        $requisito = new Requisito();
        $requisito->nombre = "MATRICULACIÓN DE  VEHÍCULOS NUEVOS DE SERVICIO PÚBLICO";
        $requisito->ruta = "REQUISITO_9.jpg";
        $requisito->save();
        
        $requisito = new Requisito();
        $requisito->nombre = "REVISIÓN  VEHÍCULOS PÚBLICOS DEL AÑO";
        $requisito->ruta = "REQUISITO_10.jpg";
        $requisito->save();

    }
}
