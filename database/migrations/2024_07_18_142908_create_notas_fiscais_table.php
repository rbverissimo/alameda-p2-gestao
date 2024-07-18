<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotasFiscaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas_fiscais', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('idServico');
            $table->unsignedDouble('valorBruto', 8, 2);
            $table->unsignedDouble('baseCalculo', 8,2)->nullable();
            $table->unsignedDouble('valorTotalProdutos', 8,2)->nullable();
            $table->longText('itens')->nullable();
            $table->string('dataEmissao', 10);
            $table->string('serie', 10)->nullable();
            $table->string('numeroDocumento', 30);
            $table->unsignedDouble('aliquota', 2,1)->nullable();
            $table->unsignedDouble('valorISS', 8, 2)->nullable();
            $table->string('arquivo_nota', 800)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notas_fiscas');
    }
}
