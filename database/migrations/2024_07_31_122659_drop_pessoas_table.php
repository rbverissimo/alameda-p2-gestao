<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pessoas');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('pessoas', function(Blueprint $table){
            $table->id();
            $table->timestamps();
            $table->string('nome', 60);
            $table->string('cpf', 11);
            $table->string('profissao', 60)->nullable();
            $table->unsignedBigInteger('endereco_trabalho')->nullable();
        });
    }
}
