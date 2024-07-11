<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterInquilinoSaldoAddCreditosDebitosColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inquilinos_saldo', function(Blueprint $table){
            $table->longText('debitos_json')->nullable();
            $table->longText('creditos_json')->nullable();
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
            $table->dropColumn('debitos_json');
            $table->dropColumn('creditos_json');
        });
    }
}
