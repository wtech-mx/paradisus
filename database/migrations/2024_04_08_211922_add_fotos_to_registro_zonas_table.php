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
        Schema::table('registro_zonas', function (Blueprint $table) {
            $table->text('foto1')->nullable();
            $table->text('foto2')->nullable();
            $table->text('firma')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registro_zonas', function (Blueprint $table) {
            //
        });
    }
};
