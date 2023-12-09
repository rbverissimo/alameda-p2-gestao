<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterImoveisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('imoveis', function(Blueprint $table){
            $table->integer('endereco');

            $table->foreign('endereco')->references('id')->on('enderecos');
            $table->unique('endereco');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imoveis', function(Blueprint $table){
            $table->dropForeign('imoveis_endereco_foreign');

            $table->dropColumn('endereco');
        });
    }
}
