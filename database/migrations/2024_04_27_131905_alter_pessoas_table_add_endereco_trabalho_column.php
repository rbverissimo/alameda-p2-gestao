<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPessoasTableAddEnderecoTrabalhoColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pessoas', function(Blueprint $table){
            $table->unsignedBigInteger('endereco_trabalho')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pessoas', function(Blueprint $table){
            $table->dropColumn('endereco_trabalho');
        });
    }
    
}
