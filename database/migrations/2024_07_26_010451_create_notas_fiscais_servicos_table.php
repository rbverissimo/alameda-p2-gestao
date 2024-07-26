<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotasFiscaisServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas_fiscais_servicos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('servico_id');
            $table->double('valorBruto', 8, 2);
            $table->longText('arquivo_nota_servico');
            $table->string('dataEmissao', 10);
            $table->string('serie',5)->nullable();
            $table->string('numeroDocumento',255);
            $table->double('valorISS', 8, 2)->nullable();
            $table->double('baseINSS', 8, 2)->nullable();
            $table->double('valorRetido', 8, 2)->nullable();
            $table->double('aliquota', 8, 2)->nullable();
            $table->unsignedInteger('tipo_servico')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notas_fiscais_servicos');
    }
}
