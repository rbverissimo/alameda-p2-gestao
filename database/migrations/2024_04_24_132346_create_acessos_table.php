<?php

use App\Models\Acesso;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAcessosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acessos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 50);
            $table->timestamps();
        });

        Acesso::create(['titulo' => 'admin']);
        Acesso::create(['titulo' => 'tester']);
        Acesso::create(['titulo' => 'inquilino']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acessos');
    }
}
