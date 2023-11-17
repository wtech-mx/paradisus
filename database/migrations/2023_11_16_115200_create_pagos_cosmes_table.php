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
        Schema::create('registros_semanales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cosmetologo_id');
            $table->boolean('puntualidad');
            $table->integer('monto_pago')->nullable();
            $table->unsignedBigInteger('cosmetologo_cubriendo')->nullable();
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
        Schema::dropIfExists('pagos_cosmes');
    }
};
