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
        Schema::create('Contrato', function (Blueprint $table) {
            $table->id('Contrato_id');
            $table->foreignId('Empleado_id')->references('Empleado_id')->on('Empleado')->onDelete('cascade');
            $table->foreignId('Cargo_id')->references('Cargo_id')->on('Cargo')->onDelete('cascade');
            $table->string('Tipo_contrato');
            $table->date('Fecha_inicio');
            $table->date('Fecha_fin')->nullable();
            $table->decimal('Salario', 10, 2);
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Contrato');
    }
};
