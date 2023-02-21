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
        Schema::create('paquetes_servicios3', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_paquete');
            $table->foreign('id_paquete')
                ->references('id')->on('paquetes_servicios')
                ->inDelete('set null');
                
            $table->date('fecha9')->nullable();
            $table->string('notas9')->nullable();
            $table->unsignedBigInteger('id_user9');
            $table->foreign('id_user9')
                ->references('id')->on('users')
                ->inDelete('set null');
            $table->string('talla9_a')->nullable();
            $table->string('talla9_d')->nullable();
            $table->string('abdomen9_a')->nullable();
            $table->string('abdomen9_d')->nullable();
            $table->string('cintura9_a')->nullable();
            $table->string('cintura9_d')->nullable();
            $table->string('cadera9_a')->nullable();
            $table->string('cadera9_d')->nullable();
            $table->string('gluteo9_a')->nullable();
            $table->string('gluteo9_d')->nullable();
            $table->string('firma9', 900)->nullable();

            $table->date('fecha10')->nullable();
            $table->string('notas10')->nullable();
            $table->unsignedBigInteger('id_user10');
            $table->foreign('id_user10')
                ->references('id')->on('users')
                ->inDelete('set null');
            $table->string('talla10_a')->nullable();
            $table->string('talla10_d')->nullable();
            $table->string('abdomen10_a')->nullable();
            $table->string('abdomen10_d')->nullable();
            $table->string('cintura10_a')->nullable();
            $table->string('cintura10_d')->nullable();
            $table->string('cadera10_a')->nullable();
            $table->string('cadera10_d')->nullable();
            $table->string('gluteo10_a')->nullable();
            $table->string('gluteo10_d')->nullable();
            $table->string('firma10', 900)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paquetes_servicios3');
    }
};
