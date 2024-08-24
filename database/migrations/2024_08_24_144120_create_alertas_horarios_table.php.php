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
        Schema::create('bitacora_horarios_alertas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_horario');
            $table->foreign('id_horario')
                ->references('id')->on('horario')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_cosmetologa_faltante');
            $table->foreign('id_cosmetologa_faltante')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_cosmetologa_sustituye');
            $table->foreign('id_cosmetologa_sustituye')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->text('comentario')->nullable();
            $table->text('estatus')->nullable();
            $table->text('fecha_inicio')->nullable();
            $table->text('fecha_fin')->nullable();

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
        //
    }
};
