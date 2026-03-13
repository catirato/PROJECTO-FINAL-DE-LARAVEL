<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Model responsável por representar os utilizadores da aplicação.
 * É utilizado pelo sistema de autenticação do Laravel.
 */
class User extends Authenticatable
{
    /**
     * Traits utilizados pelo model:
     * - HasFactory: permite a criação de factories para testes
     * - Notifiable: permite o envio de notificações ao utilizador
     */
    use HasFactory, Notifiable;

    /**
     * Atributos que podem ser preenchidos em massa (mass assignment).
     * Inclui o campo 'role', utilizado para distinguir perfis de utilizador.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Atributos que devem ficar ocultos quando o model
     * é convertido para array ou JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Verifica se o utilizador tem perfil de administrador.
     *
     * Este método é utilizado no middleware e nas views
     * para controlar permissões de acesso.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Define os casts automáticos de atributos.
     *
     * - email_verified_at é tratado como objeto DateTime
     * - password é automaticamente encriptada com bcrypt
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
