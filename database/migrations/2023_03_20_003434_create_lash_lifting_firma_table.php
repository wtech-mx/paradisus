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
        Schema::create('lash_lifting_firma', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_consentimiento');
            $table->foreign('id_consentimiento')
                ->references('id')->on('lash_lifting')
                ->inDelete('set null');

            $table->string('firma', 900)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lash_lifting_firma');
    }
};
