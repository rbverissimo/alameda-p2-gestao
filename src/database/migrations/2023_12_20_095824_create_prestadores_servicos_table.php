<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestadoresServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestadores_servicos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('tipo');
            $table->string('nome', 100);
            $table->string('telefone', 14);
            $table->string('cpf', 14)->nullable();

            $table->foreign('tipo')->references('id')->on('tipos_prestadores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prestadores_servicos', function(Blueprint $table){
            $table->dropForeign('prestadores_servicos_tipo_foreign');
        });
        
        Schema::dropIfExists('prestadores_servicos');
    }
}
