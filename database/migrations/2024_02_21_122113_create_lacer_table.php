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
        Schema::create('laser', function (Blueprint $table) {
            $table->id();
            $table->string('zona');
            $table->string('tipo_zona');
            $table->string('precio_sesion');
            $table->string('precio_paquete');
            $table->string('costo_paquete');
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
        Schema::dropIfExists('laser');
    }
};
