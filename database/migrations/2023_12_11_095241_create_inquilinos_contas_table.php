<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquilinosContasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquilinos_contas', function (Blueprint $table) {
            
            $table->id();
            $table->integer('inquilinocodigo');
            $table->integer('contacodigo');
            $table->double('valorinquilino');
            $table->double('fatorDivisor');
            $table->string('dataVencimento')->nullable();
            $table->string('dataPagamento');
            $table->string('quitada', 1)->default('N');
            $table->timestamps();

            $table->foreign('inquilinocodigo')->references('id')->on('inquilinos');
            $table->foreign('contacodigo')->references('id')->on('contas_imoveis');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inquilinos_contas', function(Blueprint $table){

            $table->dropForeign('inquilinos_contas_inquilinocodigo_foreign');
            $table->dropForeign('inquilinos_contas_contacodigo_foreign');
            
        });
        Schema::dropIfExists('inquilinos_contas');
    }
}
