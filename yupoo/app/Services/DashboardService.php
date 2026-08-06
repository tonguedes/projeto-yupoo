<?php

namespace App\Services;

use App\Models\Categoria;
use App\Models\Produto;
use App\Models\ProdutoImagem;

class DashboardService
{
    public function getData(): array
    {
        return [

            'totalProdutos' => Produto::count(),

            'totalCategorias' => Categoria::count(),

            'totalImagens' => ProdutoImagem::count(),


            'produtosSemCapa' => Produto::whereNull('capa')
                ->count(),


            'categoriaMaisProdutos' => Categoria::withCount('produtos')
                ->orderByDesc('produtos_count')
                ->first(),


            'produtoMaisRecente' => Produto::with('categoria')
                ->latest()
                ->first(),


            'ultimosProdutos' => Produto::with([
                    'categoria',
                    'imagens'
                ])
                ->latest()
                ->take(5)
                ->get(),

        ];
    }
}
