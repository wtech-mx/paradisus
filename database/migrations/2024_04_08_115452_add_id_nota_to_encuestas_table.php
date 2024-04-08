<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdNotaToEncuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Agregar la columna con un valor predeterminado
        Schema::table('encuestas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_nota')->nullable()->default(5); // Asigna un valor predeterminado válido
        });

        // 2. Actualizar los registros existentes con un valor válido
        // Aquí debes ejecutar una consulta SQL para actualizar los registros existentes en la tabla encuestas
        // Por ejemplo:
        // DB::table('encuestas')->update(['id_nota' => 1]); // Asigna el valor predeterminado a todos los registros

        // 3. Agregar la restricción de clave foránea
        Schema::table('encuestas', function (Blueprint $table) {
            $table->foreign('id_nota')
                ->references('id')->on('notas')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Si decides revertir esta migración, simplemente elimina la columna y la restricción
        Schema::table('encuestas', function (Blueprint $table) {
            $table->dropForeign(['id_nota']);
            $table->dropColumn('id_nota');
        });
    }
}


