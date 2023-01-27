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
        Schema::table('notas_paquetes', function (Blueprint $table) {
            $table->unsignedBigInteger('id_servicio2');
            $table->foreign('id_servicio2')
                ->references('id')->on('servicios')
                ->inDelete('set null');

            $table->string('num2')->nullable();

            $table->unsignedBigInteger('id_servicio3');
            $table->foreign('id_servicio3')
                ->references('id')->on('servicios')
                ->inDelete('set null');

            $table->string('num3')->nullable();

            $table->unsignedBigInteger('id_servicio4');
            $table->foreign('id_servicio4')
                ->references('id')->on('servicios')
                ->inDelete('set null');

            $table->string('num4')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notas_paquetes', function (Blueprint $table) {
            //
        });
    }
};
