
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova empresa | YUPOO</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100 text-slate-800">

    <main class="mx-auto max-w-2xl px-6 py-10">
        <a href="{{ route('superadmin.empresas.index') }}"
           class="text-sm text-blue-600 hover:underline">
            ← Voltar para empresas
        </a>

        <div class="mt-6 rounded-xl bg-white p-6 shadow-sm">
            <h1 class="text-2xl font-bold">Cadastrar empresa</h1>
            <p class="mt-2 text-sm text-slate-500">
                Cadastre uma empresa para criar seu catálogo público.
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

            <form action="{{ route('superadmin.empresas.store') }}"
                  method="POST"
                  class="mt-6 space-y-5">
                @csrf

                <div>
                    <label for="nome" class="mb-2 block text-sm font-medium">
                        Nome da empresa
                    </label>
                    <input
                        type="text"
                        name="nome"
                        id="nome"
                        value="{{ old('nome') }}"
                        required
                        maxlength="255"
                        class="w-full rounded-lg border border-slate-300 px-4 py-3"
                        placeholder="Ex.: Minha Empresa"
                    >
                </div>

                <div>
                    <label for="slug" class="mb-2 block text-sm font-medium">
                        Identificador do catálogo (slug)
                    </label>
                    <input
                        type="text"
                        name="slug"
                        id="slug"
                        value="{{ old('slug') }}"
                        required
                        maxlength="255"
                        pattern="[A-Za-z0-9_-]+"
                        class="w-full rounded-lg border border-slate-300 px-4 py-3"
                        placeholder="Ex.: minha-empresa"
                    >
                    <p class="mt-2 text-xs text-slate-500">
                        O catálogo ficará disponível em /catalogo/identificador.
                    </p>
                </div>

                <button
                    type="submit"
                    class="rounded-lg bg-slate-900 px-5 py-3 font-medium text-white hover:bg-slate-700"
                >
                    Cadastrar empresa
                </button>
            </form>
        </div>
    </main>

</body>
</html>
