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
        Schema::create('paquete_facial_nota', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_client');
            $table->unsignedBigInteger('id_cosme_comision')->nullable();
            $table->unsignedBigInteger('id_servicio');
            $table->string('monto')->nullable();
            $table->string('restante')->nullable();
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
        Schema::dropIfExists('paquete_facial');
    }
};
