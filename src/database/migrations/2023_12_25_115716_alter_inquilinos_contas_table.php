<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterInquilinosContasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inquilinos_contas', function(Blueprint $table){
            $table->dropColumn('fatorDivisor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inquilinos_contas', function(Blueprint $table){
            
            $table->double('fatorDivisor')->nullable();
        });
    }
}
