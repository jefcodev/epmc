<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo');
            $table->string('slug');
            $table->text('contenido')->nullable();
            $table->text('descripcion')->nullable();
            $table->enum('estado',['borrador','publicada'])->default('borrador');
            $table->date('fecha');
            $table->string('tags')->nullable();
            $table->unsignedBigInteger('autor_id');
            $table->foreign('autor_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('noticias');
    }
}
