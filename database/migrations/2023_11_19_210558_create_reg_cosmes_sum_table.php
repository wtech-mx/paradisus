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
        Schema::create('reg_cosmes_sum', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cosme');
            $table->text('concepto')->nullable();
            $table->text('comprobante')->nullable();
            $table->text('tipo')->nullable();
            $table->date('fecha');
            $table->text('monto')->nullable();
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
        Schema::dropIfExists('reg_cosmes_sum');
    }
};
