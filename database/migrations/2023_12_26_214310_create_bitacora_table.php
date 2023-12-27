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
        Schema::create('bitacora', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nota');
            $table->foreign('id_nota')
                ->references('id')->on('notas')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_pago');
            $table->foreign('id_pago')
                ->references('id')->on('pagos')
                ->inDelete('set null');

            $table->string('usuario')->nullable();
            $table->string('tipo')->nullable();
            $table->date('fecha')->nullable();

            // Columnas para valores antes y después de la actualización
            $table->json('antes')->nullable();
            $table->json('despues')->nullable();

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
        Schema::dropIfExists('bitacora');
    }
};
