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
        Schema::create('registro_zonas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_nota');
            $table->foreign('id_nota')
                ->references('id')->on('nota_laser')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_zona');
            $table->foreign('id_zona')
                ->references('id')->on('laser')
                ->inDelete('set null');

            $table->integer('sesion');
            $table->text('parametros')->nullable();
            $table->text('nota')->nullable();
            $table->date('fecha');

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
        Schema::dropIfExists('registro_zonas');
    }
};