<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Catálogo - YUPOO</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="bg-gray-100 text-gray-800">


    {{-- ====================================================== --}}
    {{-- HEADER --}}
    {{-- ====================================================== --}}

    <header class="bg-slate-900 text-white shadow">

        <div class="max-w-7xl mx-auto px-6">

            <div class="h-20 flex items-center justify-between">


                {{-- LOGO --}}

                <a href="{{ route('catalogo.index', ['slug' => $tenant->slug]) }}" class="flex items-center gap-3">

                    <div class="w-10 h-10 bg-indigo-600
                               rounded-xl
                               flex items-center justify-center
                               font-bold text-lg">

                        Y

                    </div>

                    <div>

                        <h1 class="text-xl font-bold">
                            YUPOO
                        </h1>

                        <p class="text-xs text-slate-400">
                            Catálogo de produtos
                        </p>

                    </div>

                </a>


                {{-- MENU --}}

                <nav class="hidden md:flex items-center gap-6">

                    <a href="{{ route('catalogo.index', ['slug' => $tenant->slug]) }}"
                        class="text-white hover:text-indigo-300 transition">

                        Início

                    </a>

                    <a href="#categorias" class="text-slate-300 hover:text-white transition">

                        Categorias

                    </a>

                    <a href="#produtos" class="text-slate-300 hover:text-white transition">

                        Produtos

                    </a>

                </nav>


                {{-- ADMIN --}}

                <a href="{{ route('dashboard') }}" class="hidden sm:inline-flex
                           items-center gap-2
                           bg-white/10
                           hover:bg-white/20
                           px-4 py-2
                           rounded-xl
                           text-sm
                           transition">

                    🔐 Admin

                </a>

            </div>

        </div>

    </header>


    {{-- ====================================================== --}}
    {{-- BANNER --}}
    {{-- ====================================================== --}}

    <section class="bg-slate-800 text-white">

        <div class="max-w-7xl mx-auto px-6 py-16 md:py-20">

            <div class="max-w-3xl">

                <span class="inline-block
                           bg-indigo-600/20
                           border border-indigo-400/30
                           text-indigo-300
                           px-4 py-2
                           rounded-full
                           text-sm
                           font-semibold
                           mb-5">

                    ✨ Nosso catálogo

                </span>


                <h2 class="text-4xl md:text-5xl
                           font-bold
                           leading-tight">

                    Encontre o produto
                    <span class="text-indigo-400">
                        ideal para você
                    </span>

                </h2>


                <p class="text-slate-300
                           text-lg
                           mt-5
                           max-w-2xl">

                    Explore nossa coleção de produtos,
                    encontre o que procura e confira
                    todos os detalhes.

                </p>


                <a href="#produtos" class="inline-flex
                           mt-8
                           bg-indigo-600
                           hover:bg-indigo-700
                           text-white
                           font-semibold
                           px-6 py-3
                           rounded-xl
                           transition">

                    Ver produtos →

                </a>

            </div>

        </div>

    </section>


    {{-- ====================================================== --}}
    {{-- CONTEÚDO --}}
    {{-- ====================================================== --}}

    <main class="max-w-7xl mx-auto px-6 py-10">


        {{-- ====================================================== --}}
        {{-- CATEGORIAS --}}
        {{-- ====================================================== --}}

        <section id="categorias" class="mb-10">


            <div class="flex items-center justify-between mb-5">

                <div>

                    <h2 class="text-2xl font-bold">

                        Categorias

                    </h2>

                    <p class="text-gray-500 text-sm mt-1">

                        Encontre produtos por categoria.

                    </p>

                </div>

            </div>


            @if($categorias->count())

                    <div class="flex flex-wrap gap-3">


                        {{-- TODAS --}}

                        <a href="{{ route('catalogo.index', ['slug' => $tenant->slug]) }}" class="
                                    px-5 py-3
                                    rounded-xl
                                    font-semibold
                                    text-sm
                                    transition

                                    {{ !request('categoria_id')
                ? 'bg-indigo-600 text-white shadow'
                : 'bg-white text-gray-700 border hover:bg-gray-50'
                                    }}
                                ">

                            Todos os produtos

                        </a>


                        {{-- CATEGORIAS --}}

                        @foreach($categorias as $categoria)

                                    <a href="{{ route('catalogo.index', [
                                'slug' => $tenant->slug,
                                'categoria_id' => $categoria->id
                            ]) }}" class="
                                                    px-5 py-3
                                                    rounded-xl
                                                    font-semibold
                                                    text-sm
                                                    transition

                                                    {{ request('categoria_id') == $categoria->id
                                ? 'bg-indigo-600 text-white shadow'
                                : 'bg-white text-gray-700 border hover:bg-gray-50'
                                                    }}
                                                ">

                                        {{ $categoria->nome }}

                                    </a>

                        @endforeach

                    </div>

            @endif

        </section>


        {{-- ====================================================== --}}
        {{-- FILTROS --}}
        {{-- ====================================================== --}}

        <section class="mb-10">

            <div class="bg-white
                       rounded-2xl
                       shadow-sm
                       border
                       p-5">


                <form href="{{ route('catalogo.index', ['slug' => $tenant->slug]) }}" method="GET">


                    <div class="grid grid-cols-1
                               md:grid-cols-3
                               gap-4">


                        {{-- BUSCA --}}

                        <div>

                            <label for="busca" class="block
                                       text-sm
                                       font-semibold
                                       mb-2">

                                Buscar produto

                            </label>

                            <input type="text" id="busca" name="busca" value="{{ request('busca') }}"
                                placeholder="Nome ou código..." class="w-full
                                       border
                                       rounded-xl
                                       px-4 py-3
                                       focus:ring-2
                                       focus:ring-indigo-500
                                       focus:border-indigo-500">

                        </div>


                        {{-- CATEGORIA --}}

                        <div>

                            <label for="categoria_id" class="block
                                       text-sm
                                       font-semibold
                                       mb-2">

                                Categoria

                            </label>

                            <select id="categoria_id" name="categoria_id" class="w-full
                                       border
                                       rounded-xl
                                       px-4 py-3
                                       focus:ring-2
                                       focus:ring-indigo-500
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

                        <div class="flex
                                   items-end
                                   gap-3">

                            <button type="submit" class="flex-1
                                       bg-indigo-600
                                       hover:bg-indigo-700
                                       text-white
                                       font-semibold
                                       px-5 py-3
                                       rounded-xl
                                       transition">

                                🔎 Buscar

                            </button>


                            <a href="{{ route('catalogo.index', ['slug' => $tenant->slug]) }}" class="bg-gray-200
                                       hover:bg-gray-300
                                       text-gray-700
                                       font-semibold
                                       px-5 py-3
                                       rounded-xl
                                       transition">

                                Limpar

                            </a>

                        </div>

                    </div>

                </form>

            </div>

        </section>


        {{-- ====================================================== --}}
        {{-- PRODUTOS --}}
        {{-- ====================================================== --}}

        <section id="produtos">


            <div class="flex
                       items-center
                       justify-between
                       mb-6">


                <div>

                    <h2 class="text-2xl font-bold">

                        Produtos

                    </h2>

                    <p class="text-gray-500 text-sm mt-1">

                        Confira nossos produtos.

                    </p>

                </div>


                @if($produtos->total())

                    <span class="text-sm
                                   text-gray-500">

                        {{ $produtos->total() }}
                        produto(s)

                    </span>

                @endif

            </div>


            @if($produtos->count())


                {{-- GRID --}}

                <div class="grid
                               grid-cols-1
                               sm:grid-cols-2
                               lg:grid-cols-4
                               gap-6">


                    @foreach($produtos as $produto)

                        <a href="{{ route('catalogo.show', ['slug' => $tenant->slug, 'produto' => $produto]) }}" class="group
                                           bg-white
                                           rounded-2xl
                                           shadow-sm
                                           border
                                           overflow-hidden
                                           hover:shadow-xl
                                           hover:-translate-y-1
                                           transition
                                           duration-300">


                            {{-- IMAGEM --}}

                            <div class="relative
                                               overflow-hidden">


                                @if($produto->capa)

                                    <img src="{{ asset('storage/' . $produto->capa) }}" alt="{{ $produto->nome }}" class="w-full
                                                           h-64
                                                           object-cover
                                                           group-hover:scale-105
                                                           transition
                                                           duration-500">

                                @else

                                    <div class="w-full
                                                           h-64
                                                           bg-gray-100
                                                           flex
                                                           items-center
                                                           justify-center">

                                        <span class="text-gray-400">

                                            Sem imagem

                                        </span>

                                    </div>

                                @endif


                                {{-- QUANTIDADE DE IMAGENS --}}

                                @if($produto->imagens->count())

                                    <span class="absolute
                                                           bottom-3
                                                           right-3
                                                           bg-black/60
                                                           text-white
                                                           text-xs
                                                           px-3 py-1
                                                           rounded-full">

                                        📷
                                        {{ $produto->imagens->count() }}

                                    </span>

                                @endif

                            </div>


                            {{-- INFORMAÇÕES --}}

                            <div class="p-5">


                                <h3 class="text-lg
                                                   font-bold
                                                   text-gray-800
                                                   group-hover:text-indigo-600
                                                   transition">

                                    {{ $produto->nome }}

                                </h3>


                                @if($produto->categoria)

                                    <span class="inline-block
                                                           mt-3
                                                           bg-indigo-100
                                                           text-indigo-700
                                                           text-xs
                                                           font-semibold
                                                           px-3 py-1
                                                           rounded-full">

                                        {{ $produto->categoria->nome }}

                                    </span>

                                @endif


                                @if($produto->codigo)

                                    <p class="text-sm
                                                           text-gray-500
                                                           mt-3">

                                        Código:
                                        {{ $produto->codigo }}

                                    </p>

                                @endif


                                <div class="mt-4
                                                   text-indigo-600
                                                   font-semibold
                                                   text-sm">

                                    Ver detalhes →

                                </div>

                            </div>

                        </a>

                    @endforeach

                </div>


                {{-- PAGINAÇÃO --}}

                <div class="mt-10">

                    {{ $produtos->links() }}

                </div>


            @else


                {{-- SEM PRODUTOS --}}

                <div class="bg-white
                               rounded-2xl
                               border
                               shadow-sm
                               p-12
                               text-center">


                    <div class="text-5xl mb-4">

                        📦

                    </div>


                    <h3 class="text-xl
                                   font-bold
                                   text-gray-700">

                        Nenhum produto encontrado

                    </h3>


                    <p class="text-gray-500
                                   mt-2">

                        Tente alterar os filtros
                        da busca.

                    </p>


                    <a href="{{ route('catalogo.index', ['slug' => $tenant->slug]) }}" class="inline-block
                                   mt-5
                                   bg-indigo-600
                                   hover:bg-indigo-700
                                   text-white
                                   px-5 py-3
                                   rounded-xl">

                        Limpar filtros

                    </a>

                </div>

            @endif

        </section>

    </main>


    {{-- ====================================================== --}}
    {{-- FOOTER --}}
    {{-- ====================================================== --}}

    <footer class="bg-slate-900
               text-slate-300
               mt-12">

        <div class="max-w-7xl
                   mx-auto
                   px-6
                   py-8
                   text-center">

            <div class="font-bold
                       text-white
                       text-lg">

                YUPOO

            </div>

            <p class="text-sm mt-2">

                Catálogo de produtos

            </p>

            <p class="text-xs
                       text-slate-500
                       mt-4">

                © {{ date('Y') }} YUPOO.
                Todos os direitos reservados.

            </p>

        </div>

    </footer>


</body>

</html>
