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
            $table->dropColumn('idServico');
        });

        Schema::table('notas_fiscais',function(Blueprint $table){
            $table->dropColumn('valorTotalProdutos');
        });

        Schema::table('notas_fiscais',function(Blueprint $table){
            $table->dropColumn('valorISS');
        });

        Schema::table('notas_fiscais',function(Blueprint $table){
            $table->dropColumn('aliquota');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notas_fiscais',function(Blueprint $table){
            $table->unsignedBigInteger('idServico');
            $table->double('valorTotalProdutos')->nullable();
            $table->double('valorISS')->nullable();
            $table->double('aliquota')->nullable();
        });
    }
}
