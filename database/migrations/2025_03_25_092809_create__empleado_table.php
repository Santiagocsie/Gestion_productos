<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Empleado', function (Blueprint $table) {
            $table->id('Empleado_id');
            $table->string('Nombre');
            $table->string('Email')->unique();
            $table->string('Contrasena');
            $table->string('Telefono');
            $table->string('Direccion');
            $table->date('Fecha_nacimiento');
            $table->string('Genero');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Empleado');
    }
};
