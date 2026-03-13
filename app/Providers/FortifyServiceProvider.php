<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Actions\Fortify\CreateNewUser;

/**
 * Service Provider responsável pela configuração
 * do sistema de autenticação Laravel Fortify.
 *
 * Define as views utilizadas no login e registo
 * e a lógica de criação de novos utilizadores.
 */
class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Método executado durante o arranque da aplicação.
     * Aqui são configuradas as funcionalidades do Fortify.
     */
    public function boot(): void
    {
        /**
         * Define a view utilizada no processo de login.
         */
        Fortify::loginView(fn () => view('auth.login'));

        /**
         * Define a view utilizada no processo de registo.
         */
        Fortify::registerView(fn () => view('auth.register'));

        /**
         * Define a lógica de criação de novos utilizadores
         * durante o processo de registo.
         */
        Fortify::createUsersUsing(CreateNewUser::class);
    }
}
