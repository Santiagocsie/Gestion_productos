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
        Schema::create('Producto', function (Blueprint $table) {
            $table->id('Producto_id');
            $table->string('Codigo_prod')->unique();
            $table->string('Nombre');
            $table->string('Estado');
            $table->decimal('Precio', 10, 2);
            $table->integer('stock');
            $table->text('Descripcion');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Producto');
    }
};
