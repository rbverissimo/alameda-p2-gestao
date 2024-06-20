<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersImoveisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_imoveis', function (Blueprint $table) {
            $table->unsignedBigInteger('idUsuario');
            $table->unsignedBigInteger('idImovel');
            $table->timestamps();

            $table->foreign('idUsuario')->references('id')->on('users');
            $table->foreign('idImovel')->references('id')->on('imoveis');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_imoveis');
    }
}
