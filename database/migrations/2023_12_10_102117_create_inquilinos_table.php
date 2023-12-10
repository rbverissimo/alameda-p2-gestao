<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquilinosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquilinos', function (Blueprint $table) {
            $table->id();
            $table->decimal('valorAluguel', 8,2);
            $table->integer('pessoacodigo');
            $table->string('situacao')->default('A');
            $table->integer('salacodigo');
            $table->integer('qtdePessoasFamilia')->nullable();
            $table->timestamps();

            $table->foreign('pessoacodigo')->references('id')->on('pessoas');
            $table->foreign('salacodigo')->references('id')->on('salas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inquilinos', function(Blueprint $table){
            $table->dropForeign('inquilinos_pessoacodigo_foreign');
            $table->dropForeign('inquilinos_salacodigo_foreign');
        });
        
        Schema::dropIfExists('inquilinos');
    }
}
