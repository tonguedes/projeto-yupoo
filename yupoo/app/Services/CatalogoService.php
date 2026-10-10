<?php

namespace App\Services;

use App\Models\Categoria;
use App\Models\Produto;
use App\Models\Tenant;

class CatalogoService
{
    public function listar(Tenant $tenant, array $filtros = [])
    {
        $query = Produto::withoutGlobalScope(\App\Models\Scopes\TenantScope::class)
            ->where('tenant_id', $tenant->id)
            ->with([
                'categoria',
                'imagens',
            ]);

        // Busca por nome ou código
        if (!empty($filtros['busca'])) {

            $busca = $filtros['busca'];

            $query->where(function ($q) use ($busca) {

                $q->where('nome', 'like', "%{$busca}%")
                    ->orWhere('codigo', 'like', "%{$busca}%");

            });
        }

        // Filtro por categoria
        if (!empty($filtros['categoria_id'])) {

            $query->where(
                'categoria_id',
                $filtros['categoria_id']
            );
        }

        return $query
            ->latest()
            ->paginate(12)
            ->withQueryString();
    }

    public function categorias(Tenant $tenant)
    {
        return Categoria::withoutGlobalScope(\App\Models\Scopes\TenantScope::class)
            ->where('tenant_id', $tenant->id)
            ->orderBy('nome')
            ->get();
    }

    public function encontrarProduto(
        Tenant $tenant,
        Produto $produto
    ): Produto {
        return Produto::withoutGlobalScope(\App\Models\Scopes\TenantScope::class)
            ->where('tenant_id', $tenant->id)
            ->where('id', $produto->id)
            ->with([
                'categoria',
                'imagens',
            ])
            ->firstOrFail();
    }
}
