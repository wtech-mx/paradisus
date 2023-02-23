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
        Schema::create('reporte', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->string('tipo')->nullable();

            $table->unsignedBigInteger('id_nota');
            $table->foreign('id_nota')
                ->references('id')->on('notas')
                ->nullable();

            $table->unsignedBigInteger('id_producto');
            $table->foreign('id_producto')
                ->references('id')->on('notas_pedidos')
                ->nullable();

            $table->unsignedBigInteger('id_paquete');
            $table->foreign('id_paquete')
                ->references('id')->on('paquetes_servicios')
                ->nullable();

            $table->unsignedBigInteger('id_client');
            $table->foreign('id_client')
                ->references('id')->on('clients')
                ->inDelete('set null');

            $table->integer('monto')->nullable();
            $table->integer('restante')->nullable();
            $table->string('metodo_pago')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reporte');
    }
};
