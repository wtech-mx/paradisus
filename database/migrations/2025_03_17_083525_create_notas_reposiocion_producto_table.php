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
        Schema::create('notas_reposiocion_producto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nota');
            $table->foreign('id_nota')
                ->references('id')->on('notas_pedidos')
                ->inDelete('set null');

            $table->integer('cantidad')->nullable();
            $table->string('concepto')->nullable();
            $table->float('importe')->nullable();
            $table->string('estatus')->nullable();
            $table->string('escaneados')->nullable();
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
        Schema::dropIfExists('notas_reposiocion_producto');
    }
};
