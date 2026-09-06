<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        Catálogo - YUPOO
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body class="bg-gray-100 text-gray-800">

    {{-- HEADER --}}

    <header class="bg-slate-900 text-white shadow">

        <div class="max-w-7xl mx-auto px-6 py-5">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>

                    <h1 class="text-2xl font-bold">
                        YUPOO
                    </h1>

                    <p class="text-sm text-slate-300">
                        Catálogo de produtos
                    </p>

                </div>

            </div>

        </div>

    </header>


    {{-- CONTEÚDO --}}

    <main class="max-w-7xl mx-auto px-6 py-8">


        {{-- TÍTULO --}}

        <div class="mb-8">

            <h2 class="text-3xl font-bold">
                Produtos
            </h2>

            <p class="text-gray-500 mt-1">
                Explore nosso catálogo.
            </p>

        </div>


        {{-- FILTROS --}}

        <div class="bg-white rounded-2xl shadow-sm border p-5 mb-8">

            <form action="{{ route('catalogo.index') }}" method="GET">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">


                    {{-- BUSCA --}}

                    <div>

                        <label for="busca" class="block text-sm font-semibold mb-2">

                            Buscar produto

                        </label>

                        <input type="text" id="busca" name="busca" value="{{ request('busca') }}"
                            placeholder="Nome ou código..." class="w-full border rounded-xl px-4 py-3
                           focus:ring-2 focus:ring-indigo-500
                           focus:border-indigo-500">

                    </div>


                    {{-- CATEGORIA --}}

                    <div>

                        <label for="categoria_id" class="block text-sm font-semibold mb-2">

                            Categoria

                        </label>

                        <select id="categoria_id" name="categoria_id" class="w-full border rounded-xl px-4 py-3
                           focus:ring-2 focus:ring-indigo-500
                           focus:border-indigo-500">

                            <option value="">
                                Todas as categorias
                            </option>

                            @foreach($categorias as $categoria)

                                <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>

                                    {{ $categoria->nome }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- BOTÕES --}}

                    <div class="flex items-end gap-3">

                        <button type="submit" class="flex-1 bg-indigo-600
                           hover:bg-indigo-700
                           text-white font-semibold
                           px-5 py-3 rounded-xl
                           transition">

                            Buscar

                        </button>

                        <a href="{{ route('catalogo.index') }}" class="bg-gray-200
                           hover:bg-gray-300
                           text-gray-700
                           font-semibold
                           px-5 py-3 rounded-xl
                           transition">

                            Limpar

                        </a>

                    </div>

                </div>

            </form>


            {{-- CATEGORIAS RÁPIDAS --}}

            @if($categorias->count())

                    <div class="border-t mt-5 pt-5">

                        <p class="text-sm font-semibold text-gray-600 mb-3">

                            Categorias

                        </p>

                        <div class="flex flex-wrap gap-2">


                            {{-- TODAS --}}

                            <a href="{{ route('catalogo.index') }}" class="
                                px-4 py-2
                                rounded-full
                                text-sm font-semibold
                                transition

                                {{ !request('categoria_id')
                ? 'bg-indigo-600 text-white'
                : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                                }}
                            ">

                                Todas

                            </a>


                            {{-- CATEGORIAS --}}

                            @foreach($categorias as $categoria)

                                            <a href="{{ route('catalogo.index', [
                                    'categoria_id' => $categoria->id
                                ]) }}" class="
                                                    px-4 py-2
                                                    rounded-full
                                                    text-sm font-semibold
                                                    transition

                                                    {{ request('categoria_id') == $categoria->id
                                    ? 'bg-indigo-600 text-white'
                                    : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                                                    }}
                                                ">

                                                {{ $categoria->nome }}

                                            </a>

                            @endforeach

                        </div>

                    </div>

            @endif

        </div>


        {{-- PRODUTOS --}}

        @if($produtos->count())

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                @foreach($produtos as $produto)

                    <a href="{{ route('catalogo.show', $produto) }}" class="group bg-white rounded-2xl
                                       shadow-sm border overflow-hidden
                                       hover:shadow-xl transition">


                        {{-- IMAGEM --}}

                        <div class="relative">

                            @if($produto->capa)

                                <img src="{{ asset('storage/' . $produto->capa) }}" alt="{{ $produto->nome }}" class="w-full h-64 object-cover
                                                       group-hover:scale-105
                                                       transition duration-300">

                            @else

                                <div class="w-full h-64 bg-gray-100
                                                       flex items-center justify-center">

                                    <span class="text-gray-400">
                                        Sem imagem
                                    </span>

                                </div>

                            @endif

                        </div>


                        {{-- INFORMAÇÕES --}}

                        <div class="p-5">

                            <h3 class="text-lg font-bold
                                               text-gray-800
                                               group-hover:text-indigo-600
                                               transition">

                                {{ $produto->nome }}

                            </h3>


                            @if($produto->categoria)

                                <span class="inline-block mt-3
                                                       bg-indigo-100
                                                       text-indigo-700
                                                       text-xs font-semibold
                                                       px-3 py-1
                                                       rounded-full">

                                    {{ $produto->categoria->nome }}

                                </span>

                            @endif


                            @if($produto->codigo)

                                <p class="text-sm text-gray-500 mt-3">

                                    Código:
                                    {{ $produto->codigo }}

                                </p>

                            @endif

                        </div>

                    </a>

                @endforeach

            </div>


            {{-- PAGINAÇÃO --}}

            <div class="mt-8">

                {{ $produtos->links() }}

            </div>

        @else

            {{-- SEM PRODUTOS --}}

            <div class="bg-white rounded-2xl
                           border shadow-sm
                           p-12 text-center">

                <h3 class="text-xl font-bold text-gray-700">

                    Nenhum produto encontrado

                </h3>

                <p class="text-gray-500 mt-2">

                    Tente alterar os filtros da busca.

                </p>

                <a href="{{ route('catalogo.index') }}" class="inline-block mt-5
                               bg-indigo-600 hover:bg-indigo-700
                               text-white px-5 py-3
                               rounded-xl">

                    Limpar filtros

                </a>

            </div>

        @endif

    </main>


    {{-- FOOTER --}}

    <footer class="bg-slate-900 text-slate-300 mt-12">

        <div class="max-w-7xl mx-auto px-6 py-6 text-center">

            <p class="text-sm">
                © {{ date('Y') }} YUPOO
            </p>

        </div>

    </footer>

</body>

</html>
