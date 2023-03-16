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
        Schema::create('concentimiento_firmas_facial', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_consentimiento');
            $table->foreign('id_consentimiento')
                ->references('id')->on('concentimiento_facial')
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
        Schema::dropIfExists('concentimiento_firmas');
    }
};
