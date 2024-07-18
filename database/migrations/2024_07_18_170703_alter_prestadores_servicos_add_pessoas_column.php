<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPrestadoresServicosAddPessoasColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prestadores_servicos', function(Blueprint $table){
            $table->unsignedBigInteger('pessoa_id')->nullable();
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
            $table->dropColumn('pessoa_id');

        });
    }
}
