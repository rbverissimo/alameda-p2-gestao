<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('aluguel');
            $table->string('dataAssinatura', 10);
            $table->string('dataExpiracao', 10)->nullable();
            $table->string('renovacaoAutomatica', 1)->default('N');
            $table->string('contrato', 800)->nullable();

            $table->foreign('aluguel')->references('id')->on('inquilinos_alugueis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contratos');
    }
}
