<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model responsável por representar a entidade Álbum.
 * Cada álbum pertence a uma banda e pode conter
 * informação como título, imagem e ano de lançamento.
 */
class Album extends Model
{
    /**
     * Atributos que podem ser preenchidos em massa (mass assignment).
     * Estes campos podem ser atribuídos diretamente através de arrays
     * ao criar ou atualizar um álbum.
     */
    protected $fillable = [
        'band_id',
        'title',
        'image',
        'release_year'
    ];

    /**
     * Relação: um álbum pertence a uma banda.
     *
     * Define a relação inversa entre álbum e banda,
     * permitindo aceder à banda associada ao álbum.
     */
    public function band()
    {
        return $this->belongsTo(Band::class);
    }
}
