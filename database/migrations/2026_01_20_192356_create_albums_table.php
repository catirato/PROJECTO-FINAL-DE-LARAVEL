<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration responsável pela criação da tabela 'albums'.
 * Esta tabela armazena os álbuns associados a cada banda.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Método executado ao correr as migrations.
     * Cria a tabela 'albums' na base de dados.
     */
    public function up(): void
    {
        Schema::create('albums', function (Blueprint $table) {

            // Chave primária da tabela
            $table->id();

            // Chave estrangeira que referencia a tabela 'bands'
            // onDelete('cascade') garante que os álbuns são apagados
            // automaticamente quando a banda associada é removida
            $table->foreignId('band_id')
                  ->constrained()
                  ->onDelete('cascade');

            // Título do álbum
            $table->string('title');

            // Caminho para a imagem do álbum (opcional)
            $table->string('image')->nullable();

            // Ano de lançamento do álbum (opcional)
            $table->year('release_year')->nullable();

            // Campos created_at e updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * Método executado ao reverter as migrations.
     * Remove a tabela 'albums' da base de dados.
     */
    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};
