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
        Schema::create('Detalle_Producto', function (Blueprint $table) {
            $table->id('Detalle_id');
            $table->foreignId('Empleado_id')->references('Empleado_id')->on('Empleado')->onDelete('cascade');
            $table->foreignId('Producto_id')->references('Producto_id')->on('Producto')->onDelete('cascade');
            $table->foreignId('Categoria_id')->references('Categoria_id')->on('Categoria')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Detalle_Producto');
    }
};
