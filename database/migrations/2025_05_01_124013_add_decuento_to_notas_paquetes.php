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
        Schema::table('notas_paquetes', function (Blueprint $table) {
            $table->text('decuento_fijo1')->nullable();
            $table->text('decuento_fijo2')->nullable();
            $table->text('decuento_fijo3')->nullable();
            $table->text('decuento_fijo4')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notas_paquetes', function (Blueprint $table) {
            //
        });
    }
};
