<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFornecedoresImobiliariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedores_imobiliarias', function (Blueprint $table) {
            $table->timestamps();
            $table->unsignedBigInteger('fornecedor_id');
            $table->unsignedBigInteger('imobiliaria_id');
            $table->primary(['fornecedor_id', 'imobiliaria_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fornecedores_imobiliarias');
    }
}
