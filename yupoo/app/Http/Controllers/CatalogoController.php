<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Services\CatalogoService;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public function __construct(
        private CatalogoService $catalogoService
    ) {}

    /**
     * Exibe o catálogo público.
     */
    public function index(Request $request)
    {
        $produtos = $this->catalogoService->listar([
            'busca' => $request->busca,
            'categoria_id' => $request->categoria_id,
        ]);

        $categorias = $this->catalogoService->categorias();

        return view('catalogo.index', compact(
            'produtos',
            'categorias'
        ));
    }

    /**
     * Exibe os detalhes de um produto.
     */
    public function show(Produto $produto)
    {
        $produto = $this->catalogoService
            ->encontrarProduto($produto);

        return view('catalogo.show', compact('produto'));
    }
}

