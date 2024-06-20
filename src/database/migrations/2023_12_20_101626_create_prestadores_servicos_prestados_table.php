<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestadoresServicosPrestadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestadores_servicos_prestados', function (Blueprint $table) {
            $table->unsignedBigInteger('idPrestador');
            $table->unsignedBigInteger('idServico');
            $table->timestamps();

            $table->foreign('idPrestador')->references('id')->on('prestadores_servicos');
            $table->foreign('idServico')->references('id')->on('servicos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prestadores_servicos_prestados', function (Blueprint $table){

            $table->dropForeign('prestadores_servicos_prestados_idPrestador_foreign');
            $table->dropForeign('prestadores_servicos_prestados_idServico_foreign');
            
        });
        Schema::dropIfExists('prestadores_servicos_prestados');
    }
}
