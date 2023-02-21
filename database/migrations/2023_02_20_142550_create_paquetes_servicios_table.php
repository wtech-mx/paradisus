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
        Schema::create('paquetes_servicios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_client');
            $table->foreign('id_client')
                ->references('id')->on('clients')
                ->inDelete('set null');

            $table->integer('num_paquete')->nullable();
            $table->date('fecha_inicial')->nullable();

            $table->date('fecha1')->nullable();
            $table->string('notas1')->nullable();
            $table->unsignedBigInteger('id_user1');
            $table->foreign('id_user1')
                ->references('id')->on('users')
                ->inDelete('set null');
            $table->string('talla1_a')->nullable();
            $table->string('talla1_d')->nullable();
            $table->string('abdomen1_a')->nullable();
            $table->string('abdomen1_d')->nullable();
            $table->string('cintura1_a')->nullable();
            $table->string('cintura1_d')->nullable();
            $table->string('cadera1_a')->nullable();
            $table->string('cadera1_d')->nullable();
            $table->string('gluteo1_a')->nullable();
            $table->string('gluteo1_d')->nullable();
            $table->string('firma1', 900)->nullable();

            $table->date('fecha2')->nullable();
            $table->string('notas2')->nullable();
            $table->unsignedBigInteger('id_user2');
            $table->foreign('id_user2')
                ->references('id')->on('users')
                ->inDelete('set null');
            $table->string('talla2_a')->nullable();
            $table->string('talla2_d')->nullable();
            $table->string('abdomen2_a')->nullable();
            $table->string('abdomen2_d')->nullable();
            $table->string('cintura2_a')->nullable();
            $table->string('cintura2_d')->nullable();
            $table->string('cadera2_a')->nullable();
            $table->string('cadera2_d')->nullable();
            $table->string('gluteo2_a')->nullable();
            $table->string('gluteo2_d')->nullable();
            $table->string('firma2', 900)->nullable();

            $table->date('fecha3')->nullable();
            $table->string('notas3')->nullable();
            $table->unsignedBigInteger('id_user3');
            $table->foreign('id_user3')
                ->references('id')->on('users')
                ->inDelete('set null');
            $table->string('talla3_a')->nullable();
            $table->string('talla3_d')->nullable();
            $table->string('abdomen3_a')->nullable();
            $table->string('abdomen3_d')->nullable();
            $table->string('cintura3_a')->nullable();
            $table->string('cintura3_d')->nullable();
            $table->string('cadera3_a')->nullable();
            $table->string('cadera3_d')->nullable();
            $table->string('gluteo3_a')->nullable();
            $table->string('gluteo3_d')->nullable();
            $table->string('firma3', 900)->nullable();

            $table->date('fecha4')->nullable();
            $table->string('notas4')->nullable();
            $table->unsignedBigInteger('id_user4');
            $table->foreign('id_user4')
                ->references('id')->on('users')
                ->inDelete('set null');
            $table->string('talla4_a')->nullable();
            $table->string('talla4_d')->nullable();
            $table->string('abdomen4_a')->nullable();
            $table->string('abdomen4_d')->nullable();
            $table->string('cintura4_a')->nullable();
            $table->string('cintura4_d')->nullable();
            $table->string('cadera4_a')->nullable();
            $table->string('cadera4_d')->nullable();
            $table->string('gluteo4_a')->nullable();
            $table->string('gluteo4_d')->nullable();
            $table->string('firma4', 900)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paquetes_servicios');
    }
};
