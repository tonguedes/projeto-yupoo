<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Tenant;
use App\Services\CatalogoService;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public function __construct(
        private CatalogoService $catalogoService
    ) {}

    public function index(Request $request, string $slug)
    {
        $tenant = Tenant::porSlug($slug)->firstOrFail();

        $produtos = $this->catalogoService->listar(
            $tenant,
            [
                'busca' => $request->busca,
                'categoria_id' => $request->categoria_id,
            ]
        );

        $categorias = $this->catalogoService->categorias($tenant);

        return view('catalogo.index', compact(
            'produtos',
            'categorias',
            'tenant'
        ));
    }

    public function show(string $slug, Produto $produto)
    {
        $tenant = Tenant::porSlug($slug)->firstOrFail();

        $produto = $this->catalogoService->encontrarProduto(
            $tenant,
            $produto
        );

        return view('catalogo.show', compact(
            'produto',
            'tenant'
        ));
    }
}
