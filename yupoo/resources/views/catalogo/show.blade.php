<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        {{ $produto->nome }} - YUPOO
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

            <div class="flex items-center justify-between">

                <a
                    href="{{ route('catalogo.index') }}"
                    class="text-2xl font-bold">

                    YUPOO

                </a>

                <a
                    href="{{ route('catalogo.index') }}"
                    class="text-sm text-slate-300 hover:text-white">

                    ← Voltar ao catálogo

                </a>

            </div>

        </div>

    </header>


    {{-- CONTEÚDO --}}

    <main class="max-w-7xl mx-auto px-6 py-8">


        {{-- BREADCRUMB --}}

        <div class="mb-6">

            <a
                href="{{ route('catalogo.index') }}"
                class="text-indigo-600 hover:text-indigo-800 text-sm">

                Catálogo

            </a>

            <span class="text-gray-400 mx-2">
                /
            </span>

            <span class="text-gray-500 text-sm">

                {{ $produto->nome }}

            </span>

        </div>


        {{-- PRODUTO --}}

        <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">


            <div class="grid grid-cols-1 lg:grid-cols-2">


                {{-- ================================================= --}}
                {{-- IMAGENS --}}
                {{-- ================================================= --}}

                <div class="p-6">


                    {{-- CAPA PRINCIPAL --}}

                    <div
                        class="bg-gray-100 rounded-2xl overflow-hidden">

                        @if($produto->capa)

                            <img
                                id="imagemPrincipal"
                                src="{{ asset('storage/' . $produto->capa) }}"
                                alt="{{ $produto->nome }}"
                                class="w-full h-[500px] object-contain">

                        @else

                            <div
                                class="w-full h-[500px]
                                       flex items-center justify-center
                                       text-gray-400">

                                Sem imagem

                            </div>

                        @endif

                    </div>


                    {{-- GALERIA --}}

                    @if($produto->imagens->count())

                        <div class="mt-5">

                            <h2 class="font-semibold mb-3">
                                Galeria
                            </h2>


                            <div
                                class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 gap-3">


                                {{-- MINIATURA DA CAPA --}}

                                @if($produto->capa)

                                    <button
                                        type="button"
                                        onclick="trocarImagem('{{ asset('storage/' . $produto->capa) }}')"
                                        class="border-2 border-indigo-600
                                               rounded-xl overflow-hidden
                                               hover:opacity-80">

                                        <img
                                            src="{{ asset('storage/' . $produto->capa) }}"
                                            class="w-full h-20 object-cover">

                                    </button>

                                @endif


                                {{-- IMAGENS DA GALERIA --}}

                                @foreach($produto->imagens as $imagem)

                                    <button
                                        type="button"
                                        onclick="trocarImagem('{{ asset('storage/' . $imagem->imagem) }}')"
                                        class="border rounded-xl overflow-hidden
                                               hover:border-indigo-500
                                               hover:opacity-80">

                                        <img
                                            src="{{ asset('storage/' . $imagem->imagem) }}"
                                            alt="{{ $produto->nome }}"
                                            class="w-full h-20 object-cover">

                                    </button>

                                @endforeach

                            </div>

                        </div>

                    @endif

                </div>


                {{-- ================================================= --}}
                {{-- INFORMAÇÕES --}}
                {{-- ================================================= --}}

                <div class="p-8 lg:p-10">


                    {{-- CATEGORIA --}}

                    @if($produto->categoria)

                        <span
                            class="inline-block
                                   bg-indigo-100
                                   text-indigo-700
                                   text-sm font-semibold
                                   px-4 py-2
                                   rounded-full">

                            {{ $produto->categoria->nome }}

                        </span>

                    @endif


                    {{-- NOME --}}

                    <h1
                        class="text-4xl font-bold text-gray-900 mt-5">

                        {{ $produto->nome }}

                    </h1>


                    {{-- CÓDIGO --}}

                    @if($produto->codigo)

                        <p class="text-gray-500 mt-3">

                            Código:

                            <span class="font-semibold text-gray-700">

                                {{ $produto->codigo }}

                            </span>

                        </p>

                    @endif


                    {{-- DIVISOR --}}

                    <div class="border-t my-6"></div>


                    {{-- DESCRIÇÃO --}}

                    <div>

                        <h2 class="text-xl font-bold mb-3">

                            Descrição

                        </h2>

                        @if($produto->descricao)

                            <div
                                class="text-gray-600 leading-relaxed whitespace-pre-line">

                                {{ $produto->descricao }}

                            </div>

                        @else

                            <p class="text-gray-400">

                                Nenhuma descrição cadastrada.

                            </p>

                        @endif

                    </div>


                    {{-- QUANTIDADE DE IMAGENS --}}

                    <div class="mt-8 p-4 bg-gray-50 rounded-xl">

                        <p class="text-sm text-gray-500">

                            Imagens na galeria

                        </p>

                        <p class="text-2xl font-bold text-gray-800">

                            {{ $produto->imagens->count() }}

                        </p>

                    </div>


                    {{-- VOLTAR --}}

                    <a
                        href="{{ route('catalogo.index') }}"
                        class="inline-flex items-center
                               mt-8
                               bg-indigo-600
                               hover:bg-indigo-700
                               text-white
                               px-6 py-3
                               rounded-xl
                               font-semibold
                               transition">

                        ← Voltar ao catálogo

                    </a>

                </div>

            </div>

        </div>

    </main>


    {{-- FOOTER --}}

    <footer class="bg-slate-900 text-slate-300 mt-12">

        <div class="max-w-7xl mx-auto px-6 py-6 text-center">

            <p class="text-sm">

                © {{ date('Y') }} YUPOO

            </p>

        </div>

    </footer>


    {{-- JAVASCRIPT DA GALERIA --}}

    <script>

        function trocarImagem(url) {

            document.getElementById('imagemPrincipal').src = url;

        }

    </script>


</body>

</html>
