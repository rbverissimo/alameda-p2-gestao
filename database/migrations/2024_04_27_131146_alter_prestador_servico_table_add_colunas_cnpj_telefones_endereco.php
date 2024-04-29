<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPrestadorServicoTableAddColunasCnpjTelefonesEndereco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prestadores_servicos', function(Blueprint $table){
            $table->string('cnpj', 18)->nullable();
            $table->string('telefone_empresa', 15)->nullable();
            $table->unsignedBigInteger('endereco_codigo')->nullable();
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
            $table->dropColumn('cnpj');
            $table->dropColumn('telefone_empresa');
            $table->dropColumn('endereco_codigo');
        });
    }
}
