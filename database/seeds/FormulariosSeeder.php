<?php

use Illuminate\Database\Seeder;

use App\Formulario;


class FormulariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        $formulario = new Formulario();
        $formulario->ruta = "F-001 Formulario de Informe Previo de Constitución Jurídica.xls.pdf";
        $formulario->nombre = "Informe Previo de Constitución Jurídica";
        $formulario->save();

		

		$formulario = new Formulario();
		$formulario->ruta = "F-002 Formulario de Concesión de Permiso de Operación.pdf";
		$formulario->nombre = "Concesión de Permiso de Operación";
		$formulario->save();

		

		$formulario = new Formulario();
		$formulario->ruta = "F-003 Formulario de Renovación Permiso de Operación.pdf";
		$formulario->nombre = "Renovación Permiso de Operación";
		$formulario->save();

		

		$formulario = new Formulario();
		$formulario->ruta = "F-004 Formulario de Concesion de Contrato de Operación.pdf";
		$formulario->nombre = "Concesion de Contrato de Operación";
		$formulario->save();

		

		$formulario = new Formulario();
		$formulario->ruta = "F-005 Formulario de Renovación de Contrato de Operación.pdf";
		$formulario->nombre = "Renovación de Contrato de Operación";
		$formulario->save();

		

		$formulario = new Formulario();
		$formulario->ruta = "F-006 Formulario de Incremento de Cupo.pdf";
		$formulario->nombre = "Incremento de Cupo";
		$formulario->save();

		

		$formulario = new Formulario();
		$formulario->ruta = "F-007 Formulario para Habilitación de Vehículo.pdf";
		$formulario->nombre = "Habilitación de Vehículo";
		$formulario->save();

		

		$formulario = new Formulario();
		$formulario->ruta = "F-008 Formulario para Deshabilitacion de Vehículo.pdf";
		$formulario->nombre = "Deshabilitacion de Vehículo";
		$formulario->save();

		

		$formulario = new Formulario();
		$formulario->ruta = "F-009 Formulario de Cambio de Socio  con Habilitacion Vehículo.pdf";
		$formulario->nombre = "Cambio de Socio con Habilitacion Vehículo";
		$formulario->save();

		

		$formulario = new Formulario();
		$formulario->ruta = "F-010 Formulario de Cambio de Socio y Vehículo.pdf";
		$formulario->nombre = "Cambio de Socio y Vehículo";
		$formulario->save();

		

		$formulario = new Formulario();
		$formulario->ruta = "F-011 Formulario de Cambio de Vehículo.pdf";
		$formulario->nombre = "Cambio de Vehículo";
		$formulario->save();

		$formulario = new Formulario();
		$formulario->ruta = "F-012 Formulario Cambio de Socio.pdf";
		$formulario->nombre = "Cambio de Socio";
		$formulario->save();

    }
}
