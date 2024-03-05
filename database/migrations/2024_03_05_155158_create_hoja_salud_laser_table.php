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
        Schema::create('hoja_salud_laser', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_cliente');
            $table->foreign('id_cliente')
                ->references('id')->on('clients')
                ->inDelete('set null');

                $table->text('p1')->nullable();
                $table->text('p2')->nullable();
                $table->text('p3')->nullable();
                $table->text('p4')->nullable();
                $table->text('p5')->nullable();
                $table->text('p6')->nullable();
                $table->text('p7')->nullable();
                $table->text('p8')->nullable();
                $table->text('p9')->nullable();
                $table->text('p10')->nullable();
                $table->text('p11')->nullable();
                $table->text('p12')->nullable();
                $table->text('p13')->nullable();
                $table->text('p14')->nullable();
                $table->text('p15')->nullable();
                $table->text('p16')->nullable();
                $table->text('p17')->nullable();
                $table->text('p18')->nullable();
                $table->text('p19')->nullable();
                $table->text('p20')->nullable();
                $table->text('p21')->nullable();

                $table->text('firma')->nullable();
                $table->text('cosmetologa')->nullable();
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
        Schema::dropIfExists('hoja_salud_laser');
    }
};
