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
        Schema::table('notas_sesion', function (Blueprint $table) {
            $table->string('start')->nullable();
            $table->string('end')->nullable();
            $table->string('resourceId')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notas_sesion', function (Blueprint $table) {
            //
        });
    }
};
