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
        Schema::create('status', function (Blueprint $table) {
            $table->increments('id_status');
            $table->string('status',45);
            $table->timestamps();
            $table->softDeletes();
        });

        \App\Models\Status::create([
            'id_status' => 1,
            'status' => 'Processo iniciado'
        ]);

        \App\Models\Status::create([
            'id_status' => 2,
            'status' => 'Aprovada'
        ]);

        \App\Models\Status::create([
            'id_status' => 3,
            'status' => 'Finalizada'
        ]);

        \App\Models\Status::create([
            'id_status' => 4,
            'status' => 'Cancelado'
        ]);

        \App\Models\Status::create([
            'id_status' => 5,
            'status' => 'Devolvido'
        ]);


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status');
    }
};
