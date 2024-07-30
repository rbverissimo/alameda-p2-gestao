<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquilinosTelefonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquilinos_telefones', function (Blueprint $table) {
            $table->unsignedBigInteger('inquilino_id');
            $table->unsignedBigInteger('telefone_id')->unique();
            $table->primary(['inquilino_id', 'telefone_id']);
            $table->timestamps();

            $table->foreign('inquilino_id')
                ->references('id')
                ->on('inquilinos')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            
            $table->foreign('telefone_id')
                ->references('id')
                ->on('telefones')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inquilinos_telefones');
    }
}
