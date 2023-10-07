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
        Schema::create('encuestas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')
                ->references('id')->on('users')
                ->inDelete('set null');

            $table->date('fecha');
            $table->text('tipo');

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

            $table->text('comentario')->nullable();

            $table->text('nombre')->nullable();
            $table->text('telefono')->nullable();
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
        Schema::dropIfExists('encuestas');
    }
};
