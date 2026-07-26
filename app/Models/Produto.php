<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Produto extends Model
{
    protected $fillable = [
        'categoria_id',
        'nome',
        'codigo',
        'descricao',
        'capa'
    ];


    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function imagens()
    {
        return $this->hasMany(ProdutoImagem::class);
    }
}
