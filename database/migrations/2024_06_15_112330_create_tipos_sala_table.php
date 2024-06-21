<?php

use App\Models\TipoSala;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposSalaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_sala', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->timestamps();
            $table->string('descricao');
        });

        TipoSala::create([
            'id' => '1',
            'descricao' => 'Residencial'
        ]);

        TipoSala::create([
            'id' => '2',
            'descricao' => 'Comercial'
        ]);

        TipoSala::create([
            'id' => '3',
            'descricao' => 'Uso misto'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_sala');
    }
}
