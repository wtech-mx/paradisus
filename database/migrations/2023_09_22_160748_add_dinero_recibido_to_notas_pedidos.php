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
        Schema::table('notas_pedidos', function (Blueprint $table) {
            $table->text('dinero_recibido')->nullable();
            $table->text('dinero_recibido2')->nullable();
            $table->text('metodo_pago2')->nullable();
            $table->text('foto2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notas_pedidos', function (Blueprint $table) {
            //
        });
    }
};
