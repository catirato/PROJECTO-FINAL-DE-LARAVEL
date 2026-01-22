<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

/**
 * Middleware responsável por restringir o acesso
 * apenas a utilizadores com perfil de administrador.
 */
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Este método é executado antes da rota/controller.
     * Verifica se o utilizador está autenticado e se possui
     * o perfil de administrador.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next)
    {
        /**
         * Obtém o utilizador autenticado.
         * O comentário @var ajuda o IDE a reconhecer o tipo User.
         *
         * @var User|null $user
         */
        $user = Auth::user();

        // Se não existir utilizador autenticado ou se não for administrador
        if (!$user || !$user->isAdmin()) {
            // Bloqueia o acesso e devolve erro 403 (Forbidden)
            abort(403);
        }

        // Caso o utilizador seja administrador, permite continuar
        return $next($request);
    }
}
