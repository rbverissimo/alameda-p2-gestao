<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPrestadoresServicoRemovePessoasIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prestadores_servicos', function(Blueprint $table){
            $table->string('nome', 60)->nullable();
            $table->string('cpf', 11)->nullable();
            $table->string('cnpj', 14)->nullable();
            $table->unsignedBigInteger('endereco')->nullable();
            $table->string('telefone', 11)->nullable();
        });

        Schema::table('prestadores_servicos', function(Blueprint $table){
            $table->dropColumn('pessoa_id');
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
            $table->dropColumn('nome');
        });

        Schema::table('prestadores_servicos', function(Blueprint $table){
            $table->dropColumn('cpf');
        });

        Schema::table('prestadores_servicos', function(Blueprint $table){
            $table->dropColumn('cnpj');
        });

        Schema::table('prestadores_servicos', function(Blueprint $table){
            $table->dropColumn('endereco');
        });

        Schema::table('prestadores_servicos', function(Blueprint $table){
            $table->dropColumn('telefone');
        });

        Schema::table('prestadores_servicos', function(Blueprint $table){
            $table->unsignedBigInteger('pessoa_id')->nullable();
        });
    }
}
