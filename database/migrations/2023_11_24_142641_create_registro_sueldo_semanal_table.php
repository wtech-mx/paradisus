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
        Schema::create('registro_sueldo_semanal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cosme');
            $table->integer('monto')->nullable();
            $table->date('fecha');
            $table->integer('puntualidad')->nullable();
            $table->integer('paquetes')->nullable();
            $table->integer('despedida')->nullable();
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
        Schema::dropIfExists('registro_sueldo_semanal');
    }
};
