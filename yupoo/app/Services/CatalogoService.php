<?php

namespace App\Services;

use App\Models\Categoria;
use App\Models\Produto;

class CatalogoService
{
    public function listar(array $filtros = [])
    {
        $query = Produto::with([
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

    public function categorias()
    {
        return Categoria::orderBy('nome')->get();
    }

    public function encontrarProduto(Produto $produto): Produto
    {
        return $produto->load([
            'categoria',
            'imagens',
        ]);
    }
}
