<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('especies', function (Blueprint $table) {
            $table->increments('id_especie');
            $table->string('especie', 100);
            $table->timestamps();
            $table->softDeletes();
        });

        \App\Models\Especie::create([
            'id_especie' => 1,
            'especie' => 'Não informada'
        ]);

        \App\Models\Especie::create([
            'id_especie' => 2,
            'especie' => 'Cachorro'
        ]);

        \App\Models\Especie::create([
            'id_especie' => 3,
            'especie' => 'Gato'
        ]);
        \App\Models\Especie::create([
            'id_especie' => 4,
            'especie' => 'Ave'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('especies');
    }
};
