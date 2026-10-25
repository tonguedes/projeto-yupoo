<?php

namespace App\Services;

use App\Models\Categoria;
use App\Models\Produto;
use App\Models\Tenant;
use App\Models\Scopes\TenantScope;

class CatalogoService
{
    public function listar(Tenant $tenant, array $filtros = [])
    {
        $query = Produto::withoutGlobalScope(TenantScope::class)
            ->where('tenant_id', $tenant->id)
            ->with([
                'categoria',
                'imagens',
            ]);

        // Busca por nome ou código.
        if (!empty($filtros['busca'])) {
            $busca = $filtros['busca'];

            $query->where(function ($q) use ($busca) {
                $q->where('nome', 'like', "%{$busca}%")
                    ->orWhere('codigo', 'like', "%{$busca}%");
            });
        }

        // Filtra por categoria, validando a empresa.
        if (!empty($filtros['categoria_id'])) {
            $categoriaId = (int) $filtros['categoria_id'];

            $categoriaPertenceAoTenant = Categoria::withoutGlobalScope(
                TenantScope::class
            )
                ->where('tenant_id', $tenant->id)
                ->whereKey($categoriaId)
                ->exists();

            if ($categoriaPertenceAoTenant) {
                $query->where('categoria_id', $categoriaId);
            } else {
                // Impede resultados quando a categoria não pertence à empresa.
                $query->whereRaw('1 = 0');
            }
        }

        return $query
            ->latest()
            ->paginate(12)
            ->withQueryString();
    }

    public function categorias(Tenant $tenant)
    {
        return Categoria::withoutGlobalScope(TenantScope::class)
            ->where('tenant_id', $tenant->id)
            ->orderBy('nome')
            ->get();
    }

    public function encontrarProduto(
        Tenant $tenant,
        Produto $produto
    ): Produto {
        return Produto::withoutGlobalScope(TenantScope::class)
            ->where('tenant_id', $tenant->id)
            ->where('id', $produto->id)
            ->with([
                'categoria',
                'imagens',
            ])
            ->firstOrFail();
    }
}
