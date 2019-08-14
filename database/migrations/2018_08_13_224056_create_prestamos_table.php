<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('matricula');
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('turno');
            $table->string('grado');
            $table->string('grupo');
            $table->string('id_libro');
            $table->date('fecha_prestamo');
            $table->date('fecha_entrega');
            $table->string('multa')->nullable();
            $table->string('estado')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestamos');
    }
}
