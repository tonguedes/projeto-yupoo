@extends('layouts.admin')

@section('content')

    <div class="max-w-7xl mx-auto">

        {{-- Cabeçalho --}}

        <div class="mb-8">

            <h1 class="text-3xl font-bold text-gray-800">
                Dashboard
            </h1>

            <p class="text-gray-500 mt-1">
                Visão geral do catálogo.
            </p>

        </div>


        {{-- Cards --}}

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">


            {{-- Produtos --}}

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm font-medium text-gray-500">
                            Produtos
                        </p>

                        <p class="text-3xl font-bold text-gray-800 mt-2">
                            {{ $totalProdutos }}
                        </p>

                    </div>

                    <div class="bg-indigo-100 text-indigo-600 rounded-xl p-3">

                        <x-heroicon-o-cube class="w-7 h-7"/>

                    </div>

                </div>

                <a
                    href="{{ route('produtos.index') }}"
                    class="inline-flex items-center gap-1 text-sm text-indigo-600 hover:text-indigo-800 mt-5">

                    Ver produtos

                    <x-heroicon-o-arrow-right class="w-4 h-4"/>

                </a>

            </div>


            {{-- Categorias --}}

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm font-medium text-gray-500">
                            Categorias
                        </p>

                        <p class="text-3xl font-bold text-gray-800 mt-2">
                            {{ $totalCategorias }}
                        </p>

                    </div>

                    <div class="bg-green-100 text-green-600 rounded-xl p-3">

                        <x-heroicon-o-folder class="w-7 h-7"/>

                    </div>

                </div>

                <a
                    href="{{ route('categorias.index') }}"
                    class="inline-flex items-center gap-1 text-sm text-green-600 hover:text-green-800 mt-5">

                    Ver categorias

                    <x-heroicon-o-arrow-right class="w-4 h-4"/>

                </a>

            </div>


            {{-- Imagens --}}

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-sm font-medium text-gray-500">
                            Imagens
                        </p>

                        <p class="text-3xl font-bold text-gray-800 mt-2">
                            {{ $totalImagens }}
                        </p>

                    </div>

                    <div class="bg-purple-100 text-purple-600 rounded-xl p-3">

                        <x-heroicon-o-photo class="w-7 h-7"/>

                    </div>

                </div>

                <a
                    href="{{ route('produtos.index') }}"
                    class="inline-flex items-center gap-1 text-sm text-purple-600 hover:text-purple-800 mt-5">

                    Ver catálogo

                    <x-heroicon-o-arrow-right class="w-4 h-4"/>

                </a>

            </div>

        </div>


        {{-- Área inferior --}}

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


            {{-- Produtos recentes --}}

            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100">

                <div class="flex items-center justify-between p-6 border-b">

                    <div>

                        <h2 class="text-lg font-bold text-gray-800">
                            Produtos recentes
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Últimos produtos cadastrados.
                        </p>

                    </div>

                    <a
                        href="{{ route('produtos.index') }}"
                        class="text-sm text-indigo-600 hover:text-indigo-800">

                        Ver todos

                    </a>

                </div>


                <div class="divide-y">

                    @forelse($produtosMaisRecentes as $produto)

                        <div class="p-5 flex items-center gap-4">


                            {{-- Imagem --}}

                            @if($produto->capa)

                                <img
                                    src="{{ asset('storage/' . $produto->capa) }}"
                                    class="w-16 h-16 rounded-xl object-cover border">

                            @else

                                <div
                                    class="w-16 h-16 rounded-xl bg-gray-100 flex items-center justify-center text-gray-400">

                                    <x-heroicon-o-photo class="w-7 h-7"/>

                                </div>

                            @endif


                            {{-- Informações --}}

                            <div class="flex-1 min-w-0">

                                <h3 class="font-semibold text-gray-800 truncate">

                                    {{ $produto->nome }}

                                </h3>

                                <p class="text-sm text-gray-500 mt-1">

                                    Código:
                                    {{ $produto->codigo ?: 'Não informado' }}

                                </p>

                            </div>


                            {{-- Categoria --}}

                            <div>

                                <span
                                    class="inline-flex items-center bg-indigo-100 text-indigo-700 text-xs font-semibold px-3 py-1 rounded-full">

                                    {{ $produto->categoria->nome }}

                                </span>

                            </div>


                            {{-- Editar --}}

                            <a
                                href="{{ route('produtos.edit', $produto) }}"
                                class="text-gray-400 hover:text-indigo-600 transition">

                                <x-heroicon-o-pencil-square class="w-5 h-5"/>

                            </a>

                        </div>

                    @empty

                        <div class="p-10 text-center">

                            <x-heroicon-o-cube
                                class="w-12 h-12 mx-auto text-gray-300"/>

                            <p class="text-gray-500 mt-3">
                                Nenhum produto cadastrado.
                            </p>

                            <a
                                href="{{ route('produtos.create') }}"
                                class="inline-block mt-4 text-indigo-600 hover:text-indigo-800">

                                Cadastrar primeiro produto

                            </a>

                        </div>

                    @endforelse

                </div>

            </div>


            {{-- Ações rápidas --}}

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">

                <h2 class="text-lg font-bold text-gray-800">
                    Ações rápidas
                </h2>

                <p class="text-sm text-gray-500 mt-1 mb-6">
                    Acesse rapidamente as principais funções.
                </p>


                <div class="space-y-3">


                    <a
                        href="{{ route('produtos.create') }}"
                        class="flex items-center gap-4 p-4 rounded-xl bg-indigo-50 hover:bg-indigo-100 transition">

                        <div class="bg-indigo-600 text-white rounded-lg p-2">

                            <x-heroicon-o-plus class="w-5 h-5"/>

                        </div>

                        <div>

                            <p class="font-semibold text-gray-800">
                                Novo produto
                            </p>

                            <p class="text-xs text-gray-500">
                                Adicionar ao catálogo
                            </p>

                        </div>

                    </a>


                    <a
                        href="{{ route('categorias.create') }}"
                        class="flex items-center gap-4 p-4 rounded-xl bg-green-50 hover:bg-green-100 transition">

                        <div class="bg-green-600 text-white rounded-lg p-2">

                            <x-heroicon-o-folder-plus class="w-5 h-5"/>

                        </div>

                        <div>

                            <p class="font-semibold text-gray-800">
                                Nova categoria
                            </p>

                            <p class="text-xs text-gray-500">
                                Organizar catálogo
                            </p>

                        </div>

                    </a>


                    <a
                        href="{{ route('profile.edit') }}"
                        class="flex items-center gap-4 p-4 rounded-xl bg-gray-50 hover:bg-gray-100 transition">

                        <div class="bg-gray-600 text-white rounded-lg p-2">

                            <x-heroicon-o-user class="w-5 h-5"/>

                        </div>

                        <div>

                            <p class="font-semibold text-gray-800">
                                Meu perfil
                            </p>

                            <p class="text-xs text-gray-500">
                                Gerenciar conta
                            </p>

                        </div>

                    </a>

                </div>

            </div>

        </div>

    </div>

@endsection
