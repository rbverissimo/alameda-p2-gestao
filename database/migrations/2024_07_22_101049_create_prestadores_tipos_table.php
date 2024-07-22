<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestadoresTiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestadores_tipos', function (Blueprint $table) {
            $table->timestamps();
            $table->unsignedBigInteger('prestador_id');
            $table->unsignedBigInteger('tipo_id');
            $table->primary(['prestador_id', 'tipo_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestadores_tipos');
    }
}
