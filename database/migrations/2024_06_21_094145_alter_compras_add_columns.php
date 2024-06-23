<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterComprasAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('compras', function(Blueprint $table){
            $table->string('nota')->nullable();
            $table->string('nrDocumento')->nullable();
            $table->char('garantia', 1)->default('S');
            $table->integer('qtdeDiasGarantia', false, true)->default(30);
            $table->string('nome_vendedor', 40)->nullable();
            $table->unsignedBigInteger('forma_pagamento')->nullable();
            $table->integer('qtdeParcelas', false, true)->nullable();
            $table->unsignedBigInteger('fornecedor')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('compras', function(Blueprint $table){
            $table->dropColumn('garantia');
        });

        Schema::table('compras', function(Blueprint $table){
            $table->dropColumn('qtdeDiasGarantia');
        });

        Schema::table('compras', function(Blueprint $table){
            $table->dropColumn('nome_vendedor');
        });

        Schema::table('compras', function(Blueprint $table){
            $table->dropColumn('nota');
        });

        Schema::table('compras', function(Blueprint $table){
            $table->dropColumn('nrDocumento');
        });

        Schema::table('compras', function(Blueprint $table){
            $table->dropColumn('forma_pagamento');

        });

        Schema::table('compras', function(Blueprint $table){
            $table->dropColumn('qtdeParcelas');

        });

        Schema::table('compras', function(Blueprint $table){
            $table->dropColumn('fornecedor');
        });


    }
}
