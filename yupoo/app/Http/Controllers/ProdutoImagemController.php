<?php

namespace App\Http\Controllers;

use App\Models\ProdutoImagem;
use App\Services\ProdutoImagemService;

class ProdutoImagemController extends Controller
{
    public function __construct(
        private ProdutoImagemService $produtoImagemService
    ) {}

    public function destroy(ProdutoImagem $imagem)
    {
        $produto = $imagem->produto;

        $this->produtoImagemService->destroy($imagem);

        return redirect()
            ->route('produtos.edit', $produto)
            ->with('success', 'Imagem removida com sucesso!');
    }
}
