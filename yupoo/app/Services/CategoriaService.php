<?php

namespace App\Services;

use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class CategoriaService
{
    public function store(array $dados): Categoria
    {
        $usuario = Auth::user();

        abort_unless(
            $usuario && $usuario->tenant_id !== null,
            403,
            'Usuário sem empresa vinculada.'
        );

        $dados['tenant_id'] = $usuario->tenant_id;
        $dados['slug'] = Str::slug($dados['nome']);

        return Categoria::create($dados);
    }

    public function update(Categoria $categoria, array $dados): Categoria
    {
        $this->verificarPropriedade($categoria);

        // Não permite alterar a empresa à qual a categoria pertence.
        unset($dados['tenant_id']);

        $dados['slug'] = Str::slug($dados['nome']);

        $categoria->update($dados);

        return $categoria->refresh();
    }

    public function destroy(Categoria $categoria): void
    {
        $this->verificarPropriedade($categoria);

        if ($categoria->produtos()->exists()) {
            throw ValidationException::withMessages([
                'categoria' => 'Não é possível excluir esta categoria porque existem produtos vinculados a ela.',
            ]);
        }

        $categoria->delete();
    }

    private function verificarPropriedade(Categoria $categoria): void
    {
        $usuario = Auth::user();

        abort_unless(
            $usuario
                && $usuario->tenant_id !== null
                && (int) $usuario->tenant_id === (int) $categoria->tenant_id,
            403,
            'Você não tem permissão para acessar esta categoria.'
        );
    }
}
