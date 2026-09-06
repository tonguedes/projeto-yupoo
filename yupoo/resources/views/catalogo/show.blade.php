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


    {{-- ====================================================== --}}
    {{-- HEADER --}}
    {{-- ====================================================== --}}

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
                    class="text-sm text-slate-300 hover:text-white transition">

                    ← Voltar ao catálogo

                </a>

            </div>

        </div>

    </header>


    {{-- ====================================================== --}}
    {{-- CONTEÚDO --}}
    {{-- ====================================================== --}}

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


        {{-- ====================================================== --}}
        {{-- PRODUTO --}}
        {{-- ====================================================== --}}

        <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">

            <div class="grid grid-cols-1 lg:grid-cols-2">


                {{-- ================================================== --}}
                {{-- GALERIA --}}
                {{-- ================================================== --}}

                <div class="p-6">


                    {{-- IMAGEM PRINCIPAL --}}

                    <div
                        class="relative bg-gray-100 rounded-2xl overflow-hidden cursor-zoom-in"
                        onclick="abrirLightbox()">


                        @if($produto->capa)

                            <img
                                id="imagemPrincipal"
                                src="{{ asset('storage/' . $produto->capa) }}"
                                alt="{{ $produto->nome }}"
                                class="w-full h-[500px] object-contain">

                        @else

                            <div
                                id="imagemPrincipal"
                                class="w-full h-[500px]
                                       flex items-center justify-center
                                       text-gray-400">

                                Sem imagem

                            </div>

                        @endif


                        {{-- ÍCONE DE ZOOM --}}

                        @if($produto->capa)

                            <div
                                class="absolute bottom-4 right-4
                                       bg-black/60 text-white
                                       rounded-full w-11 h-11
                                       flex items-center justify-center">

                                🔍

                            </div>

                        @endif

                    </div>


                    {{-- ================================================== --}}
                    {{-- MINIATURAS --}}
                    {{-- ================================================== --}}

                    @if($produto->capa || $produto->imagens->count())

                        <div class="mt-5">

                            <h2 class="font-semibold mb-3">
                                Imagens
                            </h2>


                            <div
                                class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 gap-3">


                                {{-- CAPA --}}

                                @if($produto->capa)

                                    <button
                                        type="button"
                                        onclick="selecionarImagem(
                                            '{{ asset('storage/' . $produto->capa) }}',
                                            0
                                        )"
                                        class="miniatura border-2 border-indigo-600
                                               rounded-xl overflow-hidden">

                                        <img
                                            src="{{ asset('storage/' . $produto->capa) }}"
                                            class="w-full h-20 object-cover">

                                    </button>

                                @endif


                                {{-- GALERIA --}}

                                @foreach($produto->imagens as $index => $imagem)

                                    <button
                                        type="button"
                                        onclick="selecionarImagem(
                                            '{{ asset('storage/' . $imagem->imagem) }}',
                                            {{ $index + 1 }}
                                        )"
                                        class="miniatura border rounded-xl
                                               overflow-hidden
                                               hover:border-indigo-500
                                               transition">

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


                {{-- ================================================== --}}
                {{-- INFORMAÇÕES --}}
                {{-- ================================================== --}}

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

                    <div
                        class="mt-8 p-4 bg-gray-50 rounded-xl">

                        <p class="text-sm text-gray-500">

                            Imagens disponíveis

                        </p>

                        <p class="text-2xl font-bold text-gray-800">

                            {{ $produto->imagens->count() + ($produto->capa ? 1 : 0) }}

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


    {{-- ====================================================== --}}
    {{-- LIGHTBOX --}}
    {{-- ====================================================== --}}

    <div
        id="lightbox"
        class="hidden fixed inset-0 z-50
               bg-black/90
               items-center justify-center
               p-4">


        {{-- FECHAR --}}

        <button
            type="button"
            onclick="fecharLightbox()"
            class="absolute top-5 right-5
                   text-white text-3xl
                   bg-black/50
                   rounded-full
                   w-12 h-12
                   flex items-center justify-center
                   hover:bg-black/80">

            ×

        </button>


        {{-- ANTERIOR --}}

        <button
            type="button"
            onclick="imagemAnterior()"
            class="absolute left-4 md:left-8
                   text-white text-4xl
                   bg-black/50
                   rounded-full
                   w-12 h-12
                   flex items-center justify-center
                   hover:bg-black/80">

            ‹

        </button>


        {{-- IMAGEM --}}

        <img
            id="lightboxImagem"
            src=""
            alt="{{ $produto->nome }}"
            class="max-w-full max-h-[90vh]
                   object-contain
                   rounded-lg">


        {{-- PRÓXIMA --}}

        <button
            type="button"
            onclick="proximaImagem()"
            class="absolute right-4 md:right-8
                   text-white text-4xl
                   bg-black/50
                   rounded-full
                   w-12 h-12
                   flex items-center justify-center
                   hover:bg-black/80">

            ›

        </button>

    </div>


    {{-- ====================================================== --}}
    {{-- JAVASCRIPT --}}
    {{-- ====================================================== --}}

    <script>

        const imagens = [

            @if($produto->capa)

                "{{ asset('storage/' . $produto->capa) }}",

            @endif

            @foreach($produto->imagens as $imagem)

                "{{ asset('storage/' . $imagem->imagem) }}",

            @endforeach

        ];


        let imagemAtual = 0;


        function selecionarImagem(url, index)
        {
            const imagem = document.getElementById(
                'imagemPrincipal'
            );

            if (imagem) {

                imagem.src = url;

            }

            imagemAtual = index;

            atualizarMiniaturas();
        }


        function abrirLightbox()
        {
            if (imagens.length === 0) {
                return;
            }

            const lightbox =
                document.getElementById('lightbox');

            const lightboxImagem =
                document.getElementById('lightboxImagem');

            lightboxImagem.src =
                imagens[imagemAtual];

            lightbox.classList.remove('hidden');

            lightbox.classList.add('flex');

            document.body.classList.add('overflow-hidden');
        }


        function fecharLightbox()
        {
            const lightbox =
                document.getElementById('lightbox');

            lightbox.classList.add('hidden');

            lightbox.classList.remove('flex');

            document.body.classList.remove('overflow-hidden');
        }


        function proximaImagem()
        {
            if (imagens.length === 0) {
                return;
            }

            imagemAtual++;

            if (imagemAtual >= imagens.length) {

                imagemAtual = 0;

            }

            atualizarImagemLightbox();

            atualizarImagemPrincipal();

            atualizarMiniaturas();
        }


        function imagemAnterior()
        {
            if (imagens.length === 0) {
                return;
            }

            imagemAtual--;

            if (imagemAtual < 0) {

                imagemAtual = imagens.length - 1;

            }

            atualizarImagemLightbox();

            atualizarImagemPrincipal();

            atualizarMiniaturas();
        }


        function atualizarImagemLightbox()
        {
            document.getElementById(
                'lightboxImagem'
            ).src = imagens[imagemAtual];
        }


        function atualizarImagemPrincipal()
        {
            const imagem =
                document.getElementById('imagemPrincipal');

            if (imagem) {

                imagem.src = imagens[imagemAtual];

            }
        }


        function atualizarMiniaturas()
        {
            const miniaturas =
                document.querySelectorAll('.miniatura');

            miniaturas.forEach(
                (miniatura, index) => {

                    if (index === imagemAtual) {

                        miniatura.classList.remove(
                            'border-gray-300'
                        );

                        miniatura.classList.add(
                            'border-2',
                            'border-indigo-600'
                        );

                    } else {

                        miniatura.classList.remove(
                            'border-2',
                            'border-indigo-600'
                        );

                        miniatura.classList.add(
                            'border'
                        );

                    }

                }
            );
        }


        // Teclas do teclado

        document.addEventListener(
            'keydown',
            function(event) {

                const lightbox =
                    document.getElementById('lightbox');

                if (lightbox.classList.contains('hidden')) {
                    return;
                }

                if (event.key === 'Escape') {

                    fecharLightbox();

                }

                if (event.key === 'ArrowRight') {

                    proximaImagem();

                }

                if (event.key === 'ArrowLeft') {

                    imagemAnterior();

                }

            }
        );


        // Clicar no fundo para fechar

        document.getElementById('lightbox')
            .addEventListener(
                'click',
                function(event) {

                    if (event.target === this) {

                        fecharLightbox();

                    }

                }
            );

    </script>


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
