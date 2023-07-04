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
        Schema::create('productos_inventario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cabina_inv');
            $table->foreign('id_cabina_inv')
                ->references('id')->on('cabina_inventario')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_producto');
            $table->foreign('id_producto')
                ->references('id')->on('productos')
                ->inDelete('set null');

            $table->string('num_semana');

            $table->string('estatus');
            $table->string('extra');
            $table->string('cantidad')->nullable();
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
        Schema::dropIfExists('productos_inventario');
    }
};
