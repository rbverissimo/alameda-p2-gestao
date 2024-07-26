<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterNotasFiscaisDropIdServicoColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notas_fiscais', function(Blueprint $table){
            $table->dropIfExists('notas_fiscais');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('notas_fiscais',function(Blueprint $table){
            $table->timestamps();
            $table->id();
            $table->double('valorBruto', 8, 2)->nullable();
            $table->double('baseCalculo', 8, 2)->nullable();
            $table->longText('itens')->nullable();
            $table->string('dataEmissao',10)->nullable();
            $table->string('serie')->nullable();
            $table->string('numeroDocumento')->nullable();
            $table->longText('arquivo_nota')->nullable();
            $table->unsignedBigInteger('idServico')->nullable();
            $table->double('valorTotalProdutos', 8, 2)->nullable();
            $table->double('valorISS', 8, 2)->nullable();
            $table->double('aliquota', 8, 2)->nullable();
        });
    }
}
