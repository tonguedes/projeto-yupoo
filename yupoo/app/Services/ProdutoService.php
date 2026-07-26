<?php

namespace App\Services;

use App\Http\Requests\Produto\StoreProdutoRequest;
use App\Http\Requests\Produto\UpdateProdutoRequest;
use App\Models\Produto;
use App\Models\ProdutoImagem;
use Illuminate\Support\Facades\Storage;

class ProdutoService
{
    public function store(
        array $dados,
        StoreProdutoRequest $request
    ): Produto
    {
        // Upload da capa
        if ($request->hasFile('capa')) {
            $dados['capa'] = $request->file('capa')
                ->store('produtos/capa', 'public');
        }

        // Cria o produto
        $produto = Produto::create($dados);

        // Salva as imagens da galeria
        if ($request->hasFile('imagens')) {

            foreach ($request->file('imagens') as $imagem) {

                ProdutoImagem::create([
                    'produto_id' => $produto->id,
                    'imagem' => $imagem->store('produtos/galeria', 'public'),
                ]);

            }

        }

        return $produto;
    }

    public function update(
        Produto $produto,
        array $dados,
        UpdateProdutoRequest $request
    ): Produto
    {
        // Atualiza a capa
        if ($request->hasFile('capa')) {

            if ($produto->capa) {
                Storage::disk('public')->delete($produto->capa);
            }

            $dados['capa'] = $request->file('capa')
                ->store('produtos/capa', 'public');
        }

        // Atualiza os dados do produto
        $produto->update($dados);

        // Adiciona novas imagens à galeria
        if ($request->hasFile('imagens')) {

            foreach ($request->file('imagens') as $imagem) {

                ProdutoImagem::create([
                    'produto_id' => $produto->id,
                    'imagem' => $imagem->store('produtos/galeria', 'public'),
                ]);

            }

        }

        return $produto;
    }

    public function destroy(Produto $produto): void
    {
        // Remove as imagens da galeria
        foreach ($produto->imagens as $imagem) {

            Storage::disk('public')->delete($imagem->imagem);

            $imagem->delete();
        }

        // Remove a capa
        if ($produto->capa) {
            Storage::disk('public')->delete($produto->capa);
        }

        // Remove o produto
        $produto->delete();
    }
}
