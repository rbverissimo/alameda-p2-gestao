<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestadoresImobiliariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestadores_imobiliarias', function (Blueprint $table) {
            $table->timestamps();
            $table->unsignedBigInteger('prestador_id');
            $table->unsignedBigInteger('imobiliaria_id');
            $table->primary(['prestador_id', 'imobiliaria_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestadores_imobiliarias');
    }
}
