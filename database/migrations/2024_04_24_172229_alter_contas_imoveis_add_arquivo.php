<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterContasImoveisAddArquivo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contas_imoveis', function(Blueprint $table){
            $table->string('arquivo_conta', 800)->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contas_imoveis', function(Blueprint $table){
            $table->dropColumn('arquivo_conta');
        });
    }
}
