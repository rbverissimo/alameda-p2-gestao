<?php

use App\Models\FormaPagamento;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormasPagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formas_pagamentos', function (Blueprint $table) {
            $table->timestamps();
            $table->unsignedBigInteger('codigo');
            $table->string('descricao');
        });

        FormaPagamento::create([
            'codigo' => 10001,
            'descricao' => 'Crédito'
        ]);
        
        FormaPagamento::create([
            'codigo' => 10002,
            'descricao' => 'Débito'
        ]);

        FormaPagamento::create([
            'codigo' => 10003,
            'descricao' => 'PIX'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formas_pagamentos');
    }
}
