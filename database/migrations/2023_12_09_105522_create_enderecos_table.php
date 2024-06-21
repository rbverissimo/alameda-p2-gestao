<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->string('cidade', 20);
            $table->string('logradouro', 40);
            $table->string('bairro', 30);
            $table->integer('numero');
            $table->string('cep', 9);
            $table->string('pontodereferencia', 100)->nullable();
            $table->string('complemento', 100)->nullable();
            $table->integer('quadra')->nullable();
            $table->integer('lote')->nullable();
            $table->string('uf', 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enderecos');
    }
}
