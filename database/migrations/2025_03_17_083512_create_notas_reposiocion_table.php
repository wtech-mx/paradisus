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
        Schema::create('notas_reposiocion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->date('fecha')->nullable();
            $table->text('estatus_reposicion')->nullable();
            $table->text('firma_reposicion')->nullable();
            $table->text('nota_reposicion')->nullable();

            $table->date('fecha_aprobado')->nullable();
            $table->date('preparado_hora_y_guia')->nullable();
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
        Schema::dropIfExists('notas_reposiocion');
    }
};
