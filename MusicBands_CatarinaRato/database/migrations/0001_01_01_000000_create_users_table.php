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
        // Criação da tabela 'users'
        Schema::create('users', function (Blueprint $table) {

            // Chave primária autoincrementada
            $table->id();

            // Nome do utilizador
            $table->string('name');

            // Email do utilizador (único)
            $table->string('email')->unique();

            // Data e hora da verificação do email (pode ser nula)
            $table->timestamp('email_verified_at')->nullable();

            // Palavra-passe do utilizador (normalmente guardada como hash)
            $table->string('password');

            // Token usado para a funcionalidade "lembrar-me"
            $table->rememberToken();

            // Campos created_at e updated_at
            $table->timestamps();
        });

        // Criação da tabela para recuperação de palavra-passe
        Schema::create('password_reset_tokens', function (Blueprint $table) {

            // Email do utilizador como chave primária
            $table->string('email')->primary();

            // Token de recuperação da palavra-passe
            $table->string('token');

            // Data de criação do token (pode ser nula)
            $table->timestamp('created_at')->nullable();
        });

        // Criação da tabela de sessões
        Schema::create('sessions', function (Blueprint $table) {

            // Identificador da sessão (chave primária)
            $table->string('id')->primary();

            // ID do utilizador associado à sessão (pode ser nulo)
            $table->foreignId('user_id')->nullable()->index();

            // Endereço IP do utilizador (compatível com IPv4 e IPv6)
            $table->string('ip_address', 45)->nullable();

            // Informação sobre o navegador/dispositivo
            $table->text('user_agent')->nullable();

            // Dados serializados da sessão
            $table->longText('payload');

            // Momento da última atividade (indexado para melhor desempenho)
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverte a migração.
     * Elimina as tabelas criadas no método up().
     */
    public function down(): void
    {
        // Remove a tabela 'users' se existir
        Schema::dropIfExists('users');

        // Remove a tabela 'password_reset_tokens' se existir
        Schema::dropIfExists('password_reset_tokens');

        // Remove a tabela 'sessions' se existir
        Schema::dropIfExists('sessions');
    }
};
