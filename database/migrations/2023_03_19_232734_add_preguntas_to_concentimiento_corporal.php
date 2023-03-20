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
        Schema::table('concentimiento_corporal', function (Blueprint $table) {
            $table->text('pregunta10')->nullable();
            $table->text('pregunta11')->nullable();
            $table->text('pregunta12')->nullable();
            $table->text('pregunta13')->nullable();
            $table->text('pregunta14')->nullable();
            $table->text('pregunta15')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('concentimiento_corporal', function (Blueprint $table) {
            //
        });
    }
};
