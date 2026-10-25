<?php

namespace App\Services;

use App\Http\Requests\Produto\StoreProdutoRequest;
use App\Http\Requests\Produto\UpdateProdutoRequest;
use App\Models\Categoria;
use App\Models\Produto;
use App\Models\ProdutoImagem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProdutoService
{
    public function listar(array $filtros = [])
    {
        $query = Produto::with('categoria');

        if (!empty($filtros['busca'])) {
            $busca = $filtros['busca'];

            $query->where(function ($q) use ($busca) {
                $q->where('nome', 'like', "%{$busca}%")
                    ->orWhere('codigo', 'like', "%{$busca}%");
            });
        }

        if (!empty($filtros['categoria_id'])) {
            $query->where('categoria_id', $filtros['categoria_id']);
        }

        return $query->latest()->paginate(12)->withQueryString();
    }

    public function store(
        array $dados,
        StoreProdutoRequest $request
    ): Produto {
        $usuario = $request->user();

        $this->verificarAdministrador(
            $usuario?->tenant_id,
            $usuario?->role
        );

        $this->validarCategoria(
            (int) $dados['categoria_id'],
            (int) $usuario->tenant_id
        );

        $dados['tenant_id'] = $usuario->tenant_id;

        unset($dados['imagens']);

        $arquivos = [];

        try {
            if ($request->hasFile('capa')) {
                $capa = $request->file('capa')->store(
                    'produtos/capa',
                    'public'
                );

                $dados['capa'] = $capa;
                $arquivos[] = $capa;
            }

            return DB::transaction(function () use (
                $dados,
                $request,
                &$arquivos
            ) {
                $produto = Produto::create($dados);

                if ($request->hasFile('imagens')) {
                    foreach ($request->file('imagens') as $imagem) {
                        $caminho = $imagem->store(
                            'produtos/galeria',
                            'public'
                        );

                        $arquivos[] = $caminho;

                        ProdutoImagem::create([
                            'produto_id' => $produto->id,
                            'imagem' => $caminho,
                        ]);
                    }
                }

                return $produto;
            });
        } catch (\Throwable $erro) {
            foreach ($arquivos as $arquivo) {
                Storage::disk('public')->delete($arquivo);
            }

            throw $erro;
        }
    }

    public function update(
        Produto $produto,
        array $dados,
        UpdateProdutoRequest $request
    ): Produto {
        $usuario = $request->user();

        $this->verificarAdministrador(
            $usuario?->tenant_id,
            $usuario?->role
        );

        abort_unless(
            (int) $usuario->tenant_id === (int) $produto->tenant_id,
            403,
            'Você não tem permissão para alterar este produto.'
        );

        $this->validarCategoria(
            (int) $dados['categoria_id'],
            (int) $usuario->tenant_id
        );

        unset($dados['tenant_id'], $dados['imagens']);

        $capaAntiga = $produto->capa;
        $novaCapa = null;
        $novasImagens = [];

        try {
            if ($request->hasFile('capa')) {
                $novaCapa = $request->file('capa')->store(
                    'produtos/capa',
                    'public'
                );

                $dados['capa'] = $novaCapa;
            }

            DB::transaction(function () use (
                $produto,
                $dados,
                $request,
                &$novasImagens
            ) {
                $produto->update($dados);

                if ($request->hasFile('imagens')) {
                    foreach ($request->file('imagens') as $imagem) {
                        $caminho = $imagem->store(
                            'produtos/galeria',
                            'public'
                        );

                        $novasImagens[] = $caminho;

                        ProdutoImagem::create([
                            'produto_id' => $produto->id,
                            'imagem' => $caminho,
                        ]);
                    }
                }
            });
        } catch (\Throwable $erro) {
            if ($novaCapa !== null) {
                Storage::disk('public')->delete($novaCapa);
            }

            foreach ($novasImagens as $arquivo) {
                Storage::disk('public')->delete($arquivo);
            }

            throw $erro;
        }

        if ($novaCapa !== null && $capaAntiga !== null) {
            Storage::disk('public')->delete($capaAntiga);
        }

        return $produto->refresh();
    }

    public function destroy(Produto $produto): void
    {
        $usuario = auth()->user();

        $this->verificarAdministrador(
            $usuario?->tenant_id,
            $usuario?->role
        );

        abort_unless(
            (int) $usuario->tenant_id === (int) $produto->tenant_id,
            403,
            'Você não tem permissão para remover este produto.'
        );

        $arquivos = $produto->imagens
            ->pluck('imagem')
            ->filter()
            ->push($produto->capa)
            ->filter()
            ->unique()
            ->values()
            ->all();

        DB::transaction(function () use ($produto) {
            $produto->imagens()->delete();
            $produto->delete();
        });

        foreach ($arquivos as $arquivo) {
            Storage::disk('public')->delete($arquivo);
        }
    }

    private function verificarAdministrador(
        ?int $tenantId,
        ?string $role
    ): void {
        abort_unless(
            $tenantId !== null
                && in_array(
                    $role,
                    ['tenant_admin', 'super_admin'],
                    true
                ),
            403,
            'Apenas administradores de empresas podem gerenciar produtos.'
        );
    }

    private function validarCategoria(
        int $categoriaId,
        int $tenantId
    ): void {
        $categoriaValida = Categoria::query()
            ->whereKey($categoriaId)
            ->where('tenant_id', $tenantId)
            ->exists();

        if (!$categoriaValida) {
            throw ValidationException::withMessages([
                'categoria_id' => 'Selecione uma categoria da sua empresa.',
            ]);
        }
    }
}

