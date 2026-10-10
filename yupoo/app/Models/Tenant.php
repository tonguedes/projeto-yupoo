<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'slug',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function categorias()
    {
        return $this->hasMany(Categoria::class);
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    public function scopePorSlug($query, string $slug)
    {
        return $query->where('slug', $slug);
    }
}
