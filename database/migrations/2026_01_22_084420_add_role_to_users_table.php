<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration responsável por adicionar o campo 'role'
 * à tabela 'users'.
 *
 * Este campo permite distinguir diferentes perfis
 * de utilizador, como 'admin' e 'user'.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Método executado ao correr as migrations.
     * Adiciona a coluna 'role' à tabela 'users',
     * com valor por defeito 'user'.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Campo que define o perfil do utilizador
            // Por defeito, todos os utilizadores são 'user'
            $table->string('role')->default('user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * Método executado ao reverter as migrations.
     * Remove a coluna 'role' da tabela 'users'.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Remove o campo 'role' da tabela
            $table->dropColumn('role');
        });
    }
};
