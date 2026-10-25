<?php

namespace App\Http\Controllers\SuperAdmin;


use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
class EmpresaController extends Controller
{
    public function index()
    {
        $empresas = Tenant::withCount('users')
            ->orderBy('nome')
            ->paginate(10);

        return view('superadmin.empresas.index', compact('empresas'));
    }


public function create()
{
    return view('superadmin.empresas.create');
}

public function store(Request $request)
{
    $dados = $request->validate([
        'nome' => ['required', 'string', 'max:255'],
        'slug' => [
            'required',
            'string',
            'max:255',
            'alpha_dash',
            Rule::unique('tenants', 'slug'),
        ],
    ]);

    $dados['slug'] = Str::slug($dados['slug']);

    Tenant::create($dados);

    return redirect()
        ->route('superadmin.empresas.index')
        ->with('success', 'Empresa cadastrada com sucesso!');
}

}
