<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration responsável pela criação da tabela 'bands'.
 * Esta tabela armazena as bandas musicais da aplicação.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Método executado ao correr as migrations.
     * Cria a tabela 'bands' na base de dados.
     */
    public function up(): void
    {
        Schema::create('bands', function (Blueprint $table) {

            // Chave primária da tabela
            $table->id();

            // Nome da banda
            $table->string('name');

            // Caminho para a imagem/foto da banda (opcional)
            $table->string('photo')->nullable();

            // Campos created_at e updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * Método executado ao reverter as migrations.
     * Remove a tabela 'bands' da base de dados.
     */
    public function down(): void
    {
        Schema::dropIfExists('bands');
    }
};
