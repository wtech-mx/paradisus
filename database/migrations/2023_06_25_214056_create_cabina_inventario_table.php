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
        Schema::create('cabina_inventario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_productos');
            $table->foreign('id_productos')
                ->references('id')->on('productos')
                ->inDelete('set null');
            $table->string('num_semana');
            $table->string('fecha');
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
        Schema::dropIfExists('cabina_inventario');
    }
};
