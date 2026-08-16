<?php

namespace App\Http\Controllers;

use App\Http\Requests\Produto\StoreProdutoRequest;
use App\Http\Requests\Produto\UpdateProdutoRequest;
use App\Models\Categoria;
use App\Models\Produto;
use App\Services\ProdutoService;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function __construct(
        private ProdutoService $produtoService
    ) {}

    /**
     * Lista os produtos.
     */
    public function index(Request $request)
    {
        $produtos = $this->produtoService->listar([
            'busca' => $request->busca,
            'categoria_id' => $request->categoria_id,
        ]);

        $categorias = Categoria::orderBy('nome')->get();

        return view('produtos.index', compact(
            'produtos',
            'categorias'
        ));
    }

    /**
     * Exibe o formulário de criação.
     */
    public function create()
    {
        $categorias = Categoria::orderBy('nome')->get();

        return view('produtos.create', compact('categorias'));
    }

    /**
     * Salva um novo produto.
     */
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

    /**
     * Exibe o formulário de edição.
     */
    public function edit(Produto $produto)
    {
        $categorias = Categoria::orderBy('nome')->get();

        return view('produtos.edit', compact(
            'produto',
            'categorias'
        ));
    }

    /**
     * Atualiza um produto.
     */
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

    /**
     * Remove um produto.
     */
    public function destroy(Produto $produto)
    {
        $this->produtoService->destroy($produto);

        return redirect()
            ->route('produtos.index')
            ->with('success', 'Produto removido com sucesso!');
    }
}
