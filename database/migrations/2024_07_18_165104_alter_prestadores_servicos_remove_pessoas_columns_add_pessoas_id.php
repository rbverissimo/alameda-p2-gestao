<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPrestadoresServicosRemovePessoasColumnsAddPessoasId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prestadores_servicos', function(Blueprint $table){
            $table->dropColumn('nome');
            $table->dropColumn('telefone');
            $table->dropColumn('cpf');
            $table->dropColumn('cnpj');
            $table->dropColumn('telefone_empresa');
            $table->dropColumn('endereco_codigo');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prestadores_servicos', function(Blueprint $table){
            $table->string('nome', 100)->nullable();
            $table->string('telefone', 11)->nullable();
            $table->string('cpf', 14)->nullable();
            $table->string('cnpj', 18)->nullable();
            $table->string('telefone_empresa', 15)->nullable();
            $table->unsignedBigInteger('endereco_codigo')->nullable();
        });

        
    }
}
