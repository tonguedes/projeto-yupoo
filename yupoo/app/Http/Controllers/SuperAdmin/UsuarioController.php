<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tenant;
use App\Models\User;

use Illuminate\Validation\Rule;
class UsuarioController extends Controller
{

    public function create(Tenant $empresa)
    {
        return view('superadmin.usuarios.create', compact('empresa'));
    }

    public function store(Request $request, Tenant $empresa)
    {
        $dados = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'tenant_id' => $empresa->id,
            'role' => 'tenant_admin',
            'name' => $dados['name'],
            'email' => $dados['email'],
            'password' => $dados['password'],
        ]);

        return redirect()
            ->route('superadmin.empresas.index')
            ->with('success', 'Administrador criado com sucesso!');
    }
}


