<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContasImoveisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contas_imoveis', function (Blueprint $table) {
            
            $table->id();
            $table->double('valor');
            $table->integer('imovelcodigo');
            $table->integer('ano');
            $table->integer('mes');
            $table->string('dataVencimento', 9);
            $table->string('observacoes', 200)->nullable();
            $table->integer('referenciaConta');
            $table->string('nrDocumento', 25)->nullable();
            $table->integer('salacodigo');
            $table->timestamps();

            $table->foreign('salacodigo')->references('id')->on('salas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('contas_imoveis', function(Blueprint $table){
            
            $table->dropForeign('contas_imoveis_salacodigo_foreign');

        });

        Schema::dropIfExists('contas_imoveis');
    }
}
