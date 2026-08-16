@extends('layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- CABEÇALHO --}}

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Produtos
            </h1>

            <p class="text-gray-500 mt-1">
                Gerencie todos os produtos do catálogo.
            </p>

        </div>

        <a
            href="{{ route('produtos.create') }}"
            class="inline-flex items-center justify-center gap-2
                   bg-indigo-600 hover:bg-indigo-700
                   text-white px-5 py-3 rounded-xl shadow transition">

            <x-heroicon-o-plus class="w-5 h-5"/>

            Novo Produto

        </a>

    </div>


    {{-- MENSAGEM DE SUCESSO --}}

    @if(session('success'))

        <div
            class="mb-6 rounded-xl bg-green-100 border border-green-300
                   text-green-700 px-4 py-3">

            {{ session('success') }}

        </div>

    @endif


    {{-- ========================================================= --}}
    {{-- BUSCA E FILTROS --}}
    {{-- ========================================================= --}}

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 mb-8">

        <form
            action="{{ route('produtos.index') }}"
            method="GET">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">


                {{-- BUSCA --}}

                <div class="md:col-span-1">

                    <label
                        for="busca"
                        class="block text-sm font-semibold text-gray-700 mb-2">

                        Buscar produto

                    </label>

                    <div class="relative">

                        <div
                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">

                            <x-heroicon-o-magnifying-glass
                                class="w-5 h-5 text-gray-400"/>

                        </div>

                        <input
                            type="text"
                            id="busca"
                            name="busca"
                            value="{{ request('busca') }}"
                            placeholder="Nome ou código..."
                            class="w-full border border-gray-300 rounded-xl
                                   pl-10 pr-4 py-3
                                   focus:ring-2 focus:ring-indigo-500
                                   focus:border-indigo-500">

                    </div>

                </div>


                {{-- CATEGORIA --}}

                <div>

                    <label
                        for="categoria_id"
                        class="block text-sm font-semibold text-gray-700 mb-2">

                        Categoria

                    </label>

                    <select
                        id="categoria_id"
                        name="categoria_id"
                        class="w-full border border-gray-300 rounded-xl
                               px-4 py-3
                               focus:ring-2 focus:ring-indigo-500
                               focus:border-indigo-500">

                        <option value="">
                            Todas as categorias
                        </option>

                        @foreach($categorias as $categoria)

                            <option
                                value="{{ $categoria->id }}"
                                {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>

                                {{ $categoria->nome }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- BOTÕES --}}

                <div class="flex items-end gap-3">

                    <button
                        type="submit"
                        class="flex-1 inline-flex items-center justify-center gap-2
                               bg-indigo-600 hover:bg-indigo-700
                               text-white px-5 py-3 rounded-xl
                               transition">

                        <x-heroicon-o-magnifying-glass class="w-5 h-5"/>

                        Buscar

                    </button>


                    <a
                        href="{{ route('produtos.index') }}"
                        class="inline-flex items-center justify-center
                               bg-gray-100 hover:bg-gray-200
                               text-gray-700 px-5 py-3 rounded-xl
                               transition">

                        Limpar

                    </a>

                </div>

            </div>

        </form>

    </div>


    {{-- ========================================================= --}}
    {{-- RESULTADOS --}}
    {{-- ========================================================= --}}

    @if($produtos->count())

        <div class="flex items-center justify-between mb-4">

            <p class="text-sm text-gray-500">

                {{ $produtos->total() }}

                {{ $produtos->total() == 1 ? 'produto encontrado' : 'produtos encontrados' }}

            </p>

        </div>


        {{-- ===================================================== --}}
        {{-- GRID DE PRODUTOS --}}
        {{-- ===================================================== --}}

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            @foreach($produtos as $produto)

                <div
                    class="bg-white rounded-2xl shadow-sm
                           border border-gray-100
                           overflow-hidden
                           hover:shadow-xl
                           transition duration-300">


                    {{-- IMAGEM --}}

                    <div class="relative">

                        @if($produto->capa)

                            <img
                                src="{{ asset('storage/' . $produto->capa) }}"
                                alt="{{ $produto->nome }}"
                                class="w-full h-64 object-cover">

                        @else

                            <div
                                class="w-full h-64 bg-gray-100
                                       flex items-center justify-center
                                       text-gray-400">

                                <div class="text-center">

                                    <x-heroicon-o-photo
                                        class="w-12 h-12 mx-auto"/>

                                    <p class="text-sm mt-2">
                                        Sem capa
                                    </p>

                                </div>

                            </div>

                        @endif


                        {{-- AÇÕES --}}

                        <div
                            class="absolute top-3 right-3 flex gap-2">


                            {{-- EDITAR --}}

                            <a
                                href="{{ route('produtos.edit', $produto) }}"
                                title="Editar"
                                class="bg-blue-600 hover:bg-blue-700
                                       text-white rounded-full
                                       w-10 h-10
                                       flex items-center justify-center
                                       shadow">

                                <x-heroicon-o-pencil-square
                                    class="w-5 h-5"/>

                            </a>


                            {{-- EXCLUIR --}}

                            <form
                                action="{{ route('produtos.destroy', $produto) }}"
                                method="POST">

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    title="Excluir"
                                    onclick="return confirm('Deseja realmente excluir este produto?')"
                                    class="bg-red-600 hover:bg-red-700
                                           text-white rounded-full
                                           w-10 h-10
                                           flex items-center justify-center
                                           shadow">

                                    <x-heroicon-o-trash
                                        class="w-5 h-5"/>

                                </button>

                            </form>

                        </div>

                    </div>


                    {{-- INFORMAÇÕES --}}

                    <div class="p-5">


                        <h2
                            class="text-lg font-bold text-gray-800 truncate">

                            {{ $produto->nome }}

                        </h2>


                        <p class="text-sm text-gray-500 mt-1">

                            Código:

                            {{ $produto->codigo ?: 'Não informado' }}

                        </p>


                        @if($produto->categoria)

                            <span
                                class="inline-block mt-3
                                       bg-indigo-100 text-indigo-700
                                       text-xs font-semibold
                                       px-3 py-1 rounded-full">

                                {{ $produto->categoria->nome }}

                            </span>

                        @endif


                    </div>

                </div>

            @endforeach

        </div>


        {{-- PAGINAÇÃO --}}

        <div class="mt-8">

            {{ $produtos->links() }}

        </div>


    @else

        {{-- ===================================================== --}}
        {{-- NENHUM RESULTADO --}}
        {{-- ===================================================== --}}

        <div
            class="bg-white rounded-2xl shadow-sm
                   border border-gray-100
                   p-12 text-center">


            <x-heroicon-o-magnifying-glass
                class="w-14 h-14 mx-auto text-gray-300"/>


            <h2 class="text-xl font-bold text-gray-700 mt-4">

                Nenhum produto encontrado

            </h2>


            <p class="text-gray-500 mt-2">

                Tente alterar os filtros ou cadastrar um novo produto.

            </p>


            <div class="flex justify-center gap-3 mt-6">


                <a
                    href="{{ route('produtos.index') }}"
                    class="bg-gray-100 hover:bg-gray-200
                           text-gray-700 px-5 py-3 rounded-xl">

                    Limpar filtros

                </a>


                <a
                    href="{{ route('produtos.create') }}"
                    class="bg-indigo-600 hover:bg-indigo-700
                           text-white px-5 py-3 rounded-xl">

                    Novo Produto

                </a>

            </div>

        </div>

    @endif

</div>

@endsection
