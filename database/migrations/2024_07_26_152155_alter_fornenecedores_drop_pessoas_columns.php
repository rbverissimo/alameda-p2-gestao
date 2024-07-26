<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFornenecedoresDropPessoasColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fornecedores', function(Blueprint $table){
            $table->dropColumn('nome_fornecedor');
            $table->dropColumn('cnpj');
            $table->dropColumn('telefone');
            $table->dropColumn('endereco');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fornecedores', function(Blueprint $table){
            $table->string('nome_fornecedor');
            $table->string('cnpj', 18);
            $table->string('telefone');
            $table->unsignedBigInteger('endereco');
        });

    }
}
