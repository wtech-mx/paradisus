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
        Schema::create('concentimiento_corporal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_client');
            $table->foreign('id_client')
                ->references('id')->on('clients')
                ->inDelete('set null');

            $table->text('pregunta1')->nullable();
            $table->text('pregunta2')->nullable();
            $table->text('pregunta3')->nullable();
            $table->text('pregunta4')->nullable();
            $table->text('pregunta5')->nullable();
            $table->text('pregunta6')->nullable();
            $table->text('pregunta7')->nullable();
            $table->text('pregunta8')->nullable();
            $table->text('pregunta9')->nullable();
            $table->date('fecha')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('concentimiento_corporal');
    }
};
