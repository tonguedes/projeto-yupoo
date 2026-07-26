<x-app-layout>

<div class="max-w-5xl mx-auto py-6">

    <h1 class="text-3xl font-bold mb-6">
        Editar Produto
    </h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-lg mb-6">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- FORMULÁRIO DE EDIÇÃO --}}
    <form
        action="{{ route('produtos.update', $produto) }}"
        method="POST"
        enctype="multipart/form-data">

        @csrf
        @method('PUT')


        {{-- Categoria --}}
        <div class="mb-5">

            <label class="block mb-2 font-semibold">
                Categoria
            </label>

            <select
                name="categoria_id"
                class="w-full border rounded-lg p-3">

                @foreach($categorias as $cat)

                    <option
                        value="{{ $cat->id }}"
                        {{ old('categoria_id', $produto->categoria_id) == $cat->id ? 'selected' : '' }}>

                        {{ $cat->nome }}

                    </option>

                @endforeach

            </select>

        </div>


        {{-- Nome --}}
        <div class="mb-5">

            <label class="block mb-2 font-semibold">
                Nome
            </label>

            <input
                type="text"
                name="nome"
                value="{{ old('nome', $produto->nome) }}"
                class="w-full border rounded-lg p-3">

        </div>


        {{-- Código --}}
        <div class="mb-5">

            <label class="block mb-2 font-semibold">
                Código
            </label>

            <input
                type="text"
                name="codigo"
                value="{{ old('codigo', $produto->codigo) }}"
                class="w-full border rounded-lg p-3">

        </div>


        {{-- Descrição --}}
        <div class="mb-5">

            <label class="block mb-2 font-semibold">
                Descrição
            </label>

            <textarea
                name="descricao"
                rows="5"
                class="w-full border rounded-lg p-3">{{ old('descricao', $produto->descricao) }}</textarea>

        </div>


        {{-- CAPA ATUAL --}}
        <div class="mb-8">

            <h2 class="text-xl font-bold mb-4">
                Capa
            </h2>


            @if($produto->capa)

                <img
                    src="{{ asset('storage/'.$produto->capa) }}"
                    class="w-48 h-48 object-cover rounded-xl border shadow mb-4">

            @else

                <p class="text-gray-500">
                    Sem capa cadastrada
                </p>

            @endif


            <label class="block mb-2 font-semibold">
                Alterar capa
            </label>

            <input
                type="file"
                name="capa"
                class="border rounded-lg p-3 w-full">

        </div>


        {{-- NOVAS IMAGENS --}}
        <div class="mb-8">

            <label class="block mb-2 font-semibold">
                Adicionar novas imagens
            </label>


            <input
                type="file"
                name="imagens[]"
                multiple
                class="border rounded-lg p-3 w-full">


        </div>


        <button
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl">

            Atualizar Produto

        </button>


    </form>


    {{-- GALERIA SEPARADA --}}
    <div class="mt-10">


        <h2 class="text-xl font-bold mb-4">
            Galeria de imagens
        </h2>


        @if($produto->imagens->count())


            <div class="grid grid-cols-2 md:grid-cols-4 gap-5">


                @foreach($produto->imagens as $imagem)


                    <div class="bg-white border rounded-xl shadow overflow-hidden">


                        <img
                            src="{{ asset('storage/'.$imagem->imagem) }}"
                            class="w-full h-40 object-cover">


                        <div class="p-3">


                            <form
                                action="{{ route('produto-imagens.destroy', $imagem) }}"
                                method="POST">


                                @csrf
                                @method('DELETE')


                                <button
                                    type="submit"
                                    onclick="return confirm('Deseja excluir esta imagem?')"
                                    class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg">


                                    Excluir


                                </button>


                            </form>


                        </div>


                    </div>


                @endforeach


            </div>


        @else

            <div class="bg-gray-100 p-5 rounded-lg text-center">

                Nenhuma imagem cadastrada.

            </div>

        @endif


    </div>


</div>

</x-app-layout>
