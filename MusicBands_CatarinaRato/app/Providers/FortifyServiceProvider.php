<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

/**
 * Service Provider responsável pela configuração
 * das views utilizadas pelo Laravel Fortify.
 */
class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Define a view utilizada no processo de login.
     */
    public function boot(): void
    {
        Fortify::loginView(fn () => view('auth.login'));
    }
}
