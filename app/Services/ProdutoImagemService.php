<?php

namespace App\Services;

use App\Models\ProdutoImagem;
use Illuminate\Support\Facades\Storage;

class ProdutoImagemService
{
    public function destroy(ProdutoImagem $imagem): void
    {
        if ($imagem->imagem) {
            Storage::disk('public')->delete($imagem->imagem);
        }

        $imagem->delete();
    }
}
