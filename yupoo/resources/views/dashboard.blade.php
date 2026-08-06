@extends('layouts.admin')

@section('content')

<h2 class="font-semibold text-2xl text-gray-800">
    Dashboard
</h2>

<div class="py-8">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


        {{-- CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">


            <a href="{{ route('produtos.index') }}" class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">

                <div class="text-4xl">
                    📦
                </div>

                <h3 class="text-xl font-bold mt-4">
                    Produtos
                </h3>

                <p class="text-3xl font-bold text-indigo-600 mt-2">
                    {{ $totalProdutos }}
                </p>

            </a>






            <a href="{{ route('categorias.index') }}" class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">

                <div class="text-4xl">
                    📂
                </div>

                <h3 class="text-xl font-bold mt-4">
                    Categorias
                </h3>

                <p class="text-3xl font-bold text-indigo-600 mt-2">
                    {{ $totalCategorias }}
                </p>

            </a>



            <div class="bg-white rounded-xl shadow p-6">

                <div class="text-4xl">
                    🖼️
                </div>

                <h3 class="text-xl font-bold mt-4">
                    Imagens
                </h3>

                <p class="text-3xl font-bold text-indigo-600 mt-2">
                    {{ $totalImagens }}
                </p>



            </div>
            <div class="bg-white rounded-xl shadow p-6">

                <div class="text-4xl">
                    ⚠️
                </div>

                <h3 class="text-xl font-bold mt-4">
                    Sem capa
                </h3>

                <p class="text-3xl font-bold text-red-600 mt-2">
                    {{ $produtosSemCapa }}
                </p>




            </div>



        </div>


        <div class="bg-white rounded-xl shadow p-6 mb-8">

            <h3 class="text-xl font-bold mb-3">
                Categoria destaque
            </h3>


            @if($categoriaMaisProdutos)

                <p class="text-gray-700">

                    {{ $categoriaMaisProdutos->nome }}

                    -

                    {{ $categoriaMaisProdutos->produtos_count }}
                    produtos

                </p>

            @else

                <p class="text-gray-500">
                    Nenhuma categoria cadastrada.
                </p>

            @endif

        </div>


        {{-- ÚLTIMOS PRODUTOS --}}
        <div class="bg-white rounded-xl shadow">


            <div class="p-6 border-b">

                <h3 class="text-xl font-bold">
                    Últimos produtos cadastrados
                </h3>

            </div>



            <div class="divide-y">


                @forelse($ultimosProdutos as $produto)


                    <div class="p-5 flex items-center justify-between">


                        <div class="flex items-center gap-4">


                            @if($produto->capa)

                                <img src="{{ asset('storage/' . $produto->capa) }}" class="w-16 h-16 rounded-lg object-cover">

                            @else

                                <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center">

                                    📷

                                </div>

                            @endif



                            <div>

                                <h4 class="font-bold">

                                    {{ $produto->nome }}

                                </h4>


                                <p class="text-sm text-gray-500">

                                    {{ $produto->categoria->nome }}

                                </p>

                            </div>


                        </div>


                        <a href="{{ route('produtos.edit', $produto) }}" class="text-indigo-600 hover:underline">

                            Editar

                        </a>


                    </div>


                @empty

                    <div class="p-6 text-center text-gray-500">

                        Nenhum produto cadastrado.

                    </div>

                @endforelse


            </div>


        </div>




    </div>




</div>

@endsection
