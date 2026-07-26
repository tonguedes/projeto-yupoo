<?php

namespace App\Http\Controllers;

use App\Http\Requests\Produto\StoreProdutoRequest;
use App\Http\Requests\Produto\UpdateProdutoRequest;
use App\Models\Categoria;
use App\Models\Produto;
use App\Services\ProdutoService;

class ProdutoController extends Controller
{
    public function __construct(
        private ProdutoService $produtoService
    ) {}

   public function index()
{
    $produtos = Produto::with([
        'categoria',
        'imagens'
    ])
    ->latest()
    ->paginate(12);

    return view('produtos.index', compact('produtos'));
}
    public function create()
    {
        $categorias = Categoria::orderBy('nome')->get();

        return view('produtos.create', compact('categorias'));
    }

    public function store(StoreProdutoRequest $request)
    {
        $this->produtoService->store(
            $request->validated(),
            $request
        );

        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto criado com sucesso!');
    }

    public function edit(Produto $produto)
    {
        $categorias = Categoria::orderBy('nome')->get();

        return view('produtos.edit', compact('produto', 'categorias'));
    }

    public function update(
        UpdateProdutoRequest $request,
        Produto $produto


    ) {
        $this->produtoService->update(
            $produto,
            $request->validated(),
            $request
        );

        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Produto $produto)
    {
        $this->produtoService->destroy($produto);

        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto removido com sucesso!');
    }
}
