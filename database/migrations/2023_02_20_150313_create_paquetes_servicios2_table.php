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
        Schema::create('paquetes_servicios2', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_paquete');
            $table->foreign('id_paquete')
                ->references('id')->on('paquetes_servicios')
                ->inDelete('set null');

            $table->date('fecha5')->nullable();
            $table->string('notas5')->nullable();
            $table->unsignedBigInteger('id_user5');
            $table->foreign('id_user5')
                ->references('id')->on('users')
                ->inDelete('set null');
            $table->string('talla5_a')->nullable();
            $table->string('talla5_d')->nullable();
            $table->string('abdomen5_a')->nullable();
            $table->string('abdomen5_d')->nullable();
            $table->string('cintura5_a')->nullable();
            $table->string('cintura5_d')->nullable();
            $table->string('cadera5_a')->nullable();
            $table->string('cadera5_d')->nullable();
            $table->string('gluteo5_a')->nullable();
            $table->string('gluteo5_d')->nullable();
            $table->string('firma5', 900)->nullable();

            $table->date('fecha6')->nullable();
            $table->string('notas6')->nullable();
            $table->unsignedBigInteger('id_user6');
            $table->foreign('id_user6')
                ->references('id')->on('users')
                ->inDelete('set null');
            $table->string('talla6_a')->nullable();
            $table->string('talla6_d')->nullable();
            $table->string('abdomen6_a')->nullable();
            $table->string('abdomen6_d')->nullable();
            $table->string('cintura6_a')->nullable();
            $table->string('cintura6_d')->nullable();
            $table->string('cadera6_a')->nullable();
            $table->string('cadera6_d')->nullable();
            $table->string('gluteo6_a')->nullable();
            $table->string('gluteo6_d')->nullable();
            $table->string('firma6', 900)->nullable();

            $table->date('fecha7')->nullable();
            $table->string('notas7')->nullable();
            $table->unsignedBigInteger('id_user7');
            $table->foreign('id_user7')
                ->references('id')->on('users')
                ->inDelete('set null');
            $table->string('talla7_a')->nullable();
            $table->string('talla7_d')->nullable();
            $table->string('abdomen7_a')->nullable();
            $table->string('abdomen7_d')->nullable();
            $table->string('cintura7_a')->nullable();
            $table->string('cintura7_d')->nullable();
            $table->string('cadera7_a')->nullable();
            $table->string('cadera7_d')->nullable();
            $table->string('gluteo7_a')->nullable();
            $table->string('gluteo7_d')->nullable();
            $table->string('firma7', 900)->nullable();

            $table->date('fecha8')->nullable();
            $table->string('notas8')->nullable();
            $table->unsignedBigInteger('id_user8');
            $table->foreign('id_user8')
                ->references('id')->on('users')
                ->inDelete('set null');
            $table->string('talla8_a')->nullable();
            $table->string('talla8_d')->nullable();
            $table->string('abdomen8_a')->nullable();
            $table->string('abdomen8_d')->nullable();
            $table->string('cintura8_a')->nullable();
            $table->string('cintura8_d')->nullable();
            $table->string('cadera8_a')->nullable();
            $table->string('cadera8_d')->nullable();
            $table->string('gluteo8_a')->nullable();
            $table->string('gluteo8_d')->nullable();
            $table->string('firma8', 900)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paquetes_servicios2');
    }
};
