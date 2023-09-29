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
        Schema::create('sexos', function (Blueprint $table) {
            $table->increments('id_sexo');
            $table->string('sexo',45);
            $table->timestamps();
            $table->softDeletes();
        });

        \App\Models\Sexo::create([
            'id_sexo' => 1,
            'sexo' => 'Não informado'
        ]);

        \App\Models\Sexo::create([
            'id_sexo' => 2,
            'sexo' => 'Feminino'
        ]);

        \App\Models\Sexo::create([
            'id_sexo' => 3,
            'sexo' => 'Masculino'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sexos');
    }
};
