
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas | YUPOO</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-100 text-slate-800">

    <header class="bg-slate-900 text-white shadow">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5">
            <div>
                <h1 class="text-xl font-bold">YUPOO</h1>
                <p class="text-sm text-slate-300">
                    Painel do Superadministrador
                </p>
            </div>

            <a href="{{ route('dashboard') }}"
               class="rounded-lg bg-slate-700 px-4 py-2 text-sm hover:bg-slate-600">
                Voltar ao dashboard
            </a>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-6 py-8">

        {{-- Cabeçalho da página --}}
        <div class="mb-6 flex flex-wrap items-center justify-between gap-4">

            <div>
                <h2 class="text-2xl font-bold">
                    Empresas cadastradas
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Consulte as empresas, seus catálogos e usuários.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">

                <div class="rounded-xl bg-white px-5 py-3 shadow-sm">
                    <span class="text-sm text-slate-500">
                        Total de empresas
                    </span>

                    <p class="text-2xl font-bold">
                        {{ $empresas->total() }}
                    </p>
                </div>

                <a href="{{ route('superadmin.empresas.create') }}"
                   class="rounded-lg bg-slate-900 px-4 py-3 text-sm font-medium text-white hover:bg-slate-700">
                    + Nova empresa
                </a>

            </div>
        </div>

        {{-- Mensagem de sucesso --}}
        @if (session('success'))
            <div class="mb-5 rounded-lg bg-green-50 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Mensagem de erro --}}
        @if (session('error'))
            <div class="mb-5 rounded-lg bg-red-50 p-4 text-red-700">
                {{ session('error') }}
            </div>
        @endif

        {{-- Tabela de empresas --}}
        <div class="overflow-hidden rounded-xl bg-white shadow-sm">

            <div class="overflow-x-auto">

                <table class="w-full text-left text-sm">

                    <thead class="bg-slate-200 text-slate-600">
                        <tr>
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Empresa</th>
                            <th class="px-6 py-4">Catálogo público</th>
                            <th class="px-6 py-4">Usuários</th>
                            <th class="px-6 py-4">Ações</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse ($empresas as $empresa)

                            <tr class="hover:bg-slate-50">

                                {{-- ID --}}
                                <td class="px-6 py-4">
                                    {{ $empresa->id }}
                                </td>

                                {{-- Nome da empresa --}}
                                <td class="px-6 py-4 font-medium">
                                    {{ $empresa->nome }}

                                    <p class="mt-1 text-xs font-normal text-slate-500">
                                        {{ $empresa->slug }}
                                    </p>
                                </td>

                                {{-- Catálogo público --}}
                                <td class="px-6 py-4">
                                    <a
                                        href="{{ route('catalogo.index', ['slug' => $empresa->slug]) }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="text-blue-600 hover:underline"
                                    >
                                        Ver catálogo
                                    </a>
                                </td>

                                {{-- Quantidade de usuários --}}
                                <td class="px-6 py-4">
                                    <span class="rounded-full bg-slate-100 px-3 py-1 text-sm font-medium">
                                        {{ $empresa->users_count }}
                                    </span>
                                </td>

                                {{-- Ações --}}
                                <td class="px-6 py-4">
                                    <a
                                        href="{{ route('superadmin.empresas.usuarios.create', $empresa) }}"
                                        class="inline-block whitespace-nowrap rounded-lg bg-blue-50 px-3 py-2 font-medium text-blue-700 hover:bg-blue-100"
                                    >
                                        + Administrador
                                    </a>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5"
                                    class="px-6 py-10 text-center text-slate-500">
                                    Nenhuma empresa cadastrada.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            {{-- Paginação --}}
            <div class="border-t border-slate-100 px-6 py-4">
                {{ $empresas->links() }}
            </div>

        </div>

    </main>

</body>

</html>
