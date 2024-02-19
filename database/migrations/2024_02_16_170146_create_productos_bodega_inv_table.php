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
        Schema::create('productos_bodega_inv', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_productos_bodega');
            $table->foreign('id_productos_bodega')
                ->references('id')->on('productos_bodega')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_producto');
            $table->foreign('id_producto')
                ->references('id')->on('productos')
                ->inDelete('set null');

            $table->string('diferencia');
            $table->string('comentario')->nullable();
            $table->string('cantidad');
            $table->date('fecha');
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
        Schema::dropIfExists('productos_bodega_inv');
    }
};
