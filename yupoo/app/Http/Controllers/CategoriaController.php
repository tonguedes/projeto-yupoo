<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categoria\StoreCategoriaRequest;
use App\Http\Requests\Categoria\UpdateCategoriaRequest;
use App\Models\Categoria;
use App\Services\CategoriaService;

class CategoriaController extends Controller
{
    public function __construct(
        private CategoriaService $categoriaService
    ) {}

    public function index()
    {
        $categorias = Categoria::latest()->paginate(10);

        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(StoreCategoriaRequest $request)
    {
        $this->categoriaService->store(
            $request->validated()
        );

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria criada com sucesso!');
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(
        UpdateCategoriaRequest $request,
        Categoria $categoria
    ) {
        $this->categoriaService->update(
            $categoria,
            $request->validated()
        );

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria atualizada com sucesso!');
    }

    public function destroy(Categoria $categoria)
    {
        $this->categoriaService->destroy($categoria);

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria removida com sucesso!');
    }
}
