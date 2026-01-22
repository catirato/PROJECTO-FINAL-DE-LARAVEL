<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model responsável por representar a entidade Banda.
 * Cada banda pode ter vários álbuns associados.
 */
class Band extends Model
{
    /**
     * Atributos que podem ser preenchidos em massa (mass assignment).
     * Define os campos permitidos para criação e atualização de bandas.
     */
    protected $fillable = [
        'name',
        'photo'
    ];

    /**
     * Relação: uma banda pode ter vários álbuns.
     *
     * Define a relação entre a banda e os seus álbuns,
     * permitindo aceder a todos os álbuns associados.
     */
    public function albums()
    {
        return $this->hasMany(Album::class);
    }
}
