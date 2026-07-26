<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Categoria extends Model
{
    protected $fillable = [
        'nome',
        'slug'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($categoria) {
            $categoria->slug = Str::slug($categoria->nome);
        });

        static::updating(function ($categoria) {
            $categoria->slug = Str::slug($categoria->nome);
        });
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
