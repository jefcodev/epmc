<?php

use Illuminate\Database\Seeder;

use App\General;


class GeneralesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $general = new General();
        $general->nombre = "mision";
        $general->valor = "Planificar, regular y controlar la gestión del transporte terrestre, tránsito y seguridad vial en los cantones de: Pujilí, Sigchos, Saquisilí, La Maná, Pangua y Salcedo, pertenecientes a la provincia de Cotopaxi, brindando un servicio seguro, confiable y de calidad, satisfaciendo la demanda ciudadana en el ámbito de su competencia.";
        $general->save();      

        $general = new General();
        $general->nombre = "vision";
        $general->valor = "Ser una empresa de movilidad líder en el país, dentro de las competencias de transporte terrestre, tránsito y seguridad vial, basados en la transparencia y calidad del servicio, con políticas de ejecución que garanticen la regulación y control eficaz.";
        $general->save();

        $general = new General();
        $general->nombre = "quienes_somos";
        $general->valor = "Los Artículos 285 y 286 del Código Orgánico de Organización Territorial Autónomo y Descentralizado facultan a los Gobiernos Autónomos Descentralizados Municipales a formar Mancomunidades, como entidades de derecho público con personalidad jurídica. <br>Mediante Resolución de fecha 8 de abril del 2015 crean a la Empresa Pública de Movilidad de La Mancomunidad de Cotopaxi-EPMC para la gestión descentralizada de las competencias de: Tránsito, Transporte Terrestre y Seguridad Vial de los Gobiernos Autónomos Descentralizados de: Pujilí, Sigchos, Saquisilí, La Maná, Pangua y Salcedo, pertenecientes a la provincia de Cotopaxi. <br> La EPMC, es una institución comprometida con la ejecución de estrategias de seguridad vial, que permitan desarrollar una gestión de movilidad segura y confiable, a través del control del transporte mediante programas y proyectos que garanticen la satisfacción de los usuarios en los seis cantones de la provincia.";
        $general->save();

        $general = new General();
        $general->nombre = "email";
        $general->valor = "info@epmc.gob.ec";
        $general->save();

        $general = new General();
        $general->nombre = "telefono";
        $general->valor = "(03)-3-700-490 Ext:211";
        $general->save();
        
        $general = new General();
        $general->nombre = "direccion";
        $general->valor = "Campo Alegre-Mulliquindil-Santa Ana";
        $general->save();

        $general = new General();
        $general->nombre = "horario";
        $general->valor = "Lunes a Viernes: 08:00 a 17:00";
        $general->save();

        $general = new General();
        $general->nombre = "facebook";
        $general->valor = "https://www.facebook.com/Movilidad-Cotopaxi-Epmc-109619743719632";
        $general->save();
        
        $general = new General();
        $general->nombre = "twitter";
        $general->valor = "https://twitter.com/epmc2017";
        $general->save();
        
    }
}
