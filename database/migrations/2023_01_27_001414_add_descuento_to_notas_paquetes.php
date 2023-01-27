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
            $table->integer('descuento')->nullable()->after('num');
            $table->integer('descuento2')->nullable()->after('num2');
            $table->integer('descuento3')->nullable()->after('num3');
            $table->integer('descuento4')->nullable()->after('num4');
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
