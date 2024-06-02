<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('imovel');
            $table->unsignedBigInteger('tipoCompra')->nullable();
            $table->unsignedBigInteger('inquilino')->nullable();
            $table->string('dataCompra', 10);
            $table->double('valor');
            $table->string('descricao', 200)->nullable();

            $table->foreign('imovel')->references('id')->on('imoveis');
            $table->foreign('inquilino')->references('id')->on('inquilinos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compras');
    }
}
