<?php

namespace App\Services;

use App\Models\Categoria;
use Illuminate\Support\Str;

class CategoriaService
{
    public function store(array $dados): Categoria
    {
        $dados['slug'] = Str::slug($dados['nome']);

        return Categoria::create($dados);
    }

    public function update(Categoria $categoria, array $dados): Categoria
    {
        $dados['slug'] = Str::slug($dados['nome']);

        $categoria->update($dados);

        return $categoria;
    }

    public function destroy(Categoria $categoria): void
    {
        $categoria->delete();
    }
}

