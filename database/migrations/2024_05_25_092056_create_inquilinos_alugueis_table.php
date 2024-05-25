<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquilinosAlugueisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquilinos_alugueis', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('inquilino');
            $table->unsignedDouble('valorAluguel');
            $table->integer('inicioValidade');
            $table->integer('fimValidade')->nullable();
            $table->float('reajuste_previsto')->default(0.0);

            $table->foreign('inquilino')->references('id')->on('inquilinos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inquilino_alugueis');
    }
}
