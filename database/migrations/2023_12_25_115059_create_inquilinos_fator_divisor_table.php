<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquilinosFatorDivisorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquilinos_fator_divisor', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('inquilino_id')->unique();
            $table->double('fatorDivisor')->default(1.0);

            $table->foreign('inquilino_id')->references('id')->on('inquilinos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inquilinos_fator_divisor', function (Blueprint $table){
            $table->dropForeign('inquilinos_fator_divisor_inquilino_id_foreign');
        });

        Schema::dropIfExists('inquilino_fator_divisor');
    }
}
