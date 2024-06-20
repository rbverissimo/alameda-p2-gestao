<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterContasImoveisDropImovelCodigoColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contas_imoveis', function(Blueprint $table){
            $table->dropColumn('imovelcodigo');
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
            $table->unsignedBigInteger('imovelcodigo')->nullable();
        });
    }
}
