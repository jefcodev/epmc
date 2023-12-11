<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurTurnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tur_turnos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_turno'); // Clave foránea de la tabla turnos
            $table->foreign('id_turno')->references('id')->on('turnos'); // Definición de la clave foránea
            $table->string('turno');
            $table->string('tipo');
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tur_turnos');
    }
}
