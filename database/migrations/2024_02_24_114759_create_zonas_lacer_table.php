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
        Schema::create('zonas_laser', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nota');
            $table->foreign('id_nota')
                ->references('id')->on('nota_laser')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_zona');
            $table->foreign('id_zona')
                ->references('id')->on('laser')
                ->inDelete('set null');

            $table->unsignedBigInteger('zona_sesiones_1');
            $table->foreign('zona_sesiones_1')
                ->references('id')->on('laser')
                ->inDelete('set null');

            $table->unsignedBigInteger('zona_sesiones_2');
            $table->foreign('zona_sesiones_2')
                ->references('id')->on('laser')
                ->inDelete('set null');

            $table->unsignedBigInteger('zona_sesiones_3');
            $table->foreign('zona_sesiones_3')
                ->references('id')->on('laser')
                ->inDelete('set null');

            $table->unsignedBigInteger('zona_sesiones_4');
            $table->foreign('zona_sesiones_4')
                ->references('id')->on('laser')
                ->inDelete('set null');

            $table->integer('cantidad_1')->nullable();
            $table->integer('cantidad_2')->nullable();
            $table->integer('cantidad_3')->nullable();
            $table->integer('cantidad_4')->nullable();


            $table->integer('sesiones_compradas')->nullable();
            $table->integer('sesiones_restantes')->nullable();
            $table->integer('subtotal')->nullable();
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
        Schema::dropIfExists('zonas_laser');
    }
};
