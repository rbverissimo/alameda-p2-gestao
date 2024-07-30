<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterInquilinosTableAddColumnsPessoa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inquilinos', function(Blueprint $table){
            $table->string('nome', 60)->nullable();
            $table->string('cpf', 11)->nullable();
            $table->string('profissao', 60)->nullable();
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
        DB::statement('PRAGMA foreign_keys = OFF;');
        Schema::table('inquilinos', function(Blueprint $table){
            $table->dropColumn('nome');
        });

        Schema::table('inquilinos', function(Blueprint $table){
            $table->dropColumn('profissao');
        });

        Schema::table('inquilinos', function(Blueprint $table){
            $table->dropColumn('cpf');
        });

        Schema::table('inquilinos', function(Blueprint $table){
            $table->dropColumn('endereco_trabalho');
        });
    }
}
