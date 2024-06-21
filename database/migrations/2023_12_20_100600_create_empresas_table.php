<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nomeFantasia', 150);
            $table->string('cnpj', 18);
            $table->string('telefone', 14)->nullable();
            $table->unsignedBigInteger('endereco');

            $table->foreign('endereco')->references('id')->on('enderecos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresas', function(Blueprint $table){
            $table->dropForeign('empresas_endereco_foreign');
        });
        
        Schema::dropIfExists('empresas');
    }
}
