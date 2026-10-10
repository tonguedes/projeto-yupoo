<?php

namespace App\Models;

use App\Models\Scopes\TenantScope;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Categoria extends Model
{
    protected $fillable = [
        'nome',
        'slug',
        'tenant_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TenantScope());

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

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
