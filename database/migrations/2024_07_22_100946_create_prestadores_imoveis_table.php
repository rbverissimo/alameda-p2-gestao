<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestadoresImoveisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestadores_imoveis', function (Blueprint $table) {
            $table->timestamps();
            $table->unsignedBigInteger('prestador_id');
            $table->unsignedBigInteger('imovel_id');
            $table->primary(['prestador_id', 'imovel_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestadores_imoveis');
    }
}
