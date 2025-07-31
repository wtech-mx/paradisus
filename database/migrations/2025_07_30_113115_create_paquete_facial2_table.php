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
        Schema::create('paquete_facial_registro', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nota');
            $table->string('sesiones_restantes')->nullable();
            $table->string('num_sesion')->nullable();
            $table->date('fecha')->nullable();
            $table->string('id_cosme')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('productos_usados')->nullable();

            $table->string('masaje')->nullable();
            $table->string('facial')->nullable();

            $table->string('talla_antes')->nullable();
            $table->string('talla_despues')->nullable();
            $table->string('abdomen_antes')->nullable();
            $table->string('abdomen_despues')->nullable();
            $table->string('cintura_antes')->nullable();
            $table->string('cintura_despues')->nullable();
            $table->string('cadera_antes')->nullable();
            $table->string('cadera_despues')->nullable();
            $table->string('gluteos_antes')->nullable();
            $table->string('gluteos_despues')->nullable();

            $table->string('celulitis_antes')->nullable();
            $table->string('celulitis_despues')->nullable();
            $table->string('textura_antes')->nullable();
            $table->string('textura_despues')->nullable();

            $table->text('firma')->nullable();
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
        Schema::dropIfExists('paquete_facial2');
    }
};
