<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableInquilinosSaldo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_inquilinos_saldo', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('inquilinocodigo');
            $table->double('saldo_atual');
            $table->double('saldo_anterior')->nullable();
            $table->string('observacoes', 400)->nullable();

            $table->foreign('inquilinocodigo')->references('id')->on('inquilinos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inquilinos_saldo', function(Blueprint $table){
            $table->dropForeign('inquilinos_saldo_inquilinocodigo_foreign');
        });

        Schema::dropIfExists('table_inquilinos_saldo');
    }
}
