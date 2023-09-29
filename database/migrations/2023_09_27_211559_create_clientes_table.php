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
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id_cliente');
            $table->string('nome',100);
            $table->string('cpf',20)->nullable();
            $table->integer('id_sexo')->default(1);
            $table->date('nascimento')->nullable();
            $table->char('ddd',3)->nullable();
            $table->string('celular',15)->nullable();
            $table->string('email',100)->nullable();
            $table->string('cep',15)->nullable();
            $table->string('endereco',100)->nullable();
            $table->string('numero',45)->nullable();
            $table->string('complemento',45)->nullable();
            $table->string('bairro',100)->nullable();
            $table->string('cidade',100)->nullable();
            $table->string('uf',100)->nullable();
            $table->text('observacao')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
