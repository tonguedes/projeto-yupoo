<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo administrador | YUPOO</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-800">

    <main class="mx-auto max-w-2xl px-6 py-10">

        <a href="{{ route('superadmin.empresas.index') }}" class="text-sm text-blue-600 hover:underline">
            ← Voltar para empresas
        </a>

        <div class="mt-6 rounded-xl bg-white p-6 shadow-sm">

            <h1 class="text-2xl font-bold">Novo administrador</h1>

            <p class="mt-2 text-sm text-slate-500">
                Empresa: {{ $empresa->nome }}
            </p>

            @if ($errors->any())
                <div class="mt-5 rounded-lg bg-red-50 p-4 text-sm text-red-700">
                    <ul class="list-inside list-disc">
                        @foreach ($errors->all() as $erro)
                            <li>{{ $erro }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('superadmin.empresas.usuarios.store', $empresa) }}" method="POST"
                class="mt-6 space-y-5">
                @csrf

                <div>
                    <label for="name" class="mb-2 block text-sm font-medium">
                        Nome completo
                    </label>

                    <input type="text" id="name" name="name" value="{{ old('name') }}" required maxlength="255"
                        autocomplete="name" class="w-full rounded-lg border border-slate-300 px-4 py-3">
                </div>

                <div>
                    <label for="email" class="mb-2 block text-sm font-medium">
                        E-mail de acesso
                    </label>

                    <input type="email" id="email" name="email" value="{{ old('email') }}" required maxlength="255"
                        autocomplete="email" class="w-full rounded-lg border border-slate-300 px-4 py-3">
                </div>

                <div>
                    <label for="password" class="mb-2 block text-sm font-medium">
                        Senha inicial
                    </label>

                    <input type="password" id="password" name="password" required minlength="8"
                        autocomplete="new-password" class="w-full rounded-lg border border-slate-300 px-4 py-3">

                    <p class="mt-1 text-xs text-slate-500">
                        A senha deve ter pelo menos 8 caracteres.
                    </p>
                </div>

                <div>
                    <label for="password_confirmation" class="mb-2 block text-sm font-medium">
                        Confirmar senha
                    </label>

                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        minlength="8" autocomplete="new-password"
                        class="w-full rounded-lg border border-slate-300 px-4 py-3">
                </div>

                <div class="flex flex-wrap gap-3 pt-2">
                    <button type="submit"
                        class="rounded-lg bg-slate-900 px-5 py-3 font-medium text-white hover:bg-slate-700">
                        Criar administrador
                    </button>

                    <a href="{{ route('superadmin.empresas.index') }}"
                        class="rounded-lg border border-slate-300 px-5 py-3 font-medium hover:bg-slate-50">
                        Cancelar
                    </a>
                </div>

            </form>
        </div>
    </main>

</body>

</html>
