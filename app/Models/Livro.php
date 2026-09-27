<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Livro extends Model
{
    protected $fillable = [
        'titulo',
        'isbn',
        'anopublicacao',
        'descricao',
        'paginas',
        'idautor',
        'idcategoria',
    ];

    public function autor(): BelongsTo
    {
        return $this->belongsTo(Autor::class, 'idautor');
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'idcategoria');
    }
}