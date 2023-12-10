<?php

use Illuminate\Database\Seeder;

use App\Consulta;

class ConsultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $consulta = new Consulta();
        $consulta->nombre = "VALORES A CANCELAR SRI";
        $consulta->url = "https://srienlinea.sri.gob.ec/sri-en-linea/inicio/NAT";
        $consulta->orden = 1;
        $consulta->save();

        $consulta = new Consulta();
        $consulta->nombre = "MULTAS Y CITACIONES";
        $consulta->url = "https://sistemaunico.ant.gob.ec:5038/PortalWEB/paginas/clientes/clp_criterio_consulta.jsp";
        $consulta->orden = 2;
        $consulta->save();

        $consulta = new Consulta();
        $consulta->nombre = "DISPONIBILIDAD DE LA PLACA";
        $consulta->url = "#";
        $consulta->orden = 3;
        $consulta->save();


    }
}
