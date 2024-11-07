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
        Schema::create('laser_kit', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->date('fecha_caducidad')->nullable();
            $table->integer('precio')->nullable();
            $table->integer('num_sesiones')->nullable();
            $table->text('vencido')->nullable();
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
        Schema::dropIfExists('laser_kit');
    }
};
