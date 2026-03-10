<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

/**
 * Service Provider principal da aplicação.
 * Utilizado para configurar serviços globais.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Registo de serviços da aplicação.
     *
     * Método utilizado para registar bindings no container
     * de serviços. Neste projeto não foi necessário
     * adicionar serviços personalizados.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap dos serviços da aplicação.
     *
     * Este método é executado quando a aplicação arranca.
     * Aqui é configurado o rate limiter utilizado pelo
     * sistema de autenticação (Fortify).
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        /**
         * Definição do rate limiter 'login'.
         *
         * Limita o número de tentativas de login a 5 por minuto,
         * combinando o email e o endereço IP do utilizador.
         * Esta abordagem ajuda a prevenir ataques de força bruta.
         */
        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by(
                $request->input('email') . '|' . $request->ip()
            );
        });
    }
}
