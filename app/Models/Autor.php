<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Autor extends Model
{
    protected $fillable = [
        'nome',
        'nacionalidade',
        'nascimento',
        'biografia',
    ];

    public function livros(): HasMany
    {
        return $this->hasMany(Livro::class, 'idautor');
    }
}