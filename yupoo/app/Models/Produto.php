<?php

namespace App\Models;

use App\Models\Scopes\TenantScope;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'categoria_id',
        'nome',
        'codigo',
        'descricao',
        'capa',
        'tenant_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TenantScope());
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function imagens()
    {
        return $this->hasMany(ProdutoImagem::class);
    }
}
