<?php

namespace App\Services;

use App\Models\ProdutoImagem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdutoImagemService
{
    public function destroy(ProdutoImagem $imagem): void
    {
        $usuario = Auth::user();
        $produto = $imagem->produto;

        // Verifica se o usuário pertence à empresa do produto.
        abort_unless(
            $usuario
                && $usuario->tenant_id !== null
                && $produto !== null
                && (int) $usuario->tenant_id === (int) $produto->tenant_id
                && $usuario->role === 'tenant_admin',
            403,
            'Você não tem permissão para remover esta imagem.'
        );

        // Remove o arquivo do armazenamento público.
        if ($imagem->imagem) {
            Storage::disk('public')->delete($imagem->imagem);
        }

        // Remove o registro da imagem.
        $imagem->delete();
    }
}
