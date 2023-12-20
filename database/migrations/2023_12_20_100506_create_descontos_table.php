<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescontosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descontos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('idInquilino');
            $table->string('descricao', 300)->nullable();
            $table->double('valor');
            $table->integer('referencia');
            $table->string('motivo', 100);

            $table->foreign('idInquilino')->references('id')->on('inquilinos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('descontos', function(Blueprint $table){
            $table->dropForeign('descontos_idInquilino_foreign');
        });

        Schema::dropIfExists('descontos');
    }
}
