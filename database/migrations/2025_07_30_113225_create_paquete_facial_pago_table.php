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
        Schema::create('paquete_facial_pago', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nota');
            $table->unsignedBigInteger('id_user');
            $table->date('fecha')->nullable();
            $table->text('pago')->nullable();
            $table->text('cambio')->nullable();
            $table->text('forma_pago')->nullable();
            $table->text('nota')->nullable();
            $table->text('foto')->nullable();
            $table->text('dinero_recibido')->nullable();
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
        Schema::dropIfExists('paquete_facial_pago');
    }
};
