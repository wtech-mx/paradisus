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
        Schema::create('laser_kit_zonas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_laser_kit');
            $table->foreign('id_laser_kit')
                ->references('id')->on('laser_kit')
                ->inDelete('set null');

            $table->unsignedBigInteger('id_laser_zona');
            $table->foreign('id_laser_zona')
                ->references('id')->on('laser')
                ->inDelete('set null');

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
        Schema::dropIfExists('laser_kit_zonas');
    }
};
