<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterContasImoveisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contas_imoveis', function(Blueprint $table){
            $table->integer('tipocodigo');

            $table->foreign('tipocodigo')->references('id')->on('tipocontas');
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
            $table->dropForeign('contas_imoveis_tipocodigo_foreign');

            $table->dropColumn('tipocodigo');
        });
    }
}
