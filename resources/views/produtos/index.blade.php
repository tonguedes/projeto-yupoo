<x-app-layout>

<div class="max-w-7xl mx-auto py-6">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Produtos
            </h1>
            <p class="text-gray-500">
                Gerencie todos os produtos do catálogo.
            </p>
        </div>

        <a href="{{ route('produtos.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-xl shadow transition">
            + Novo Produto
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-xl bg-green-100 border border-green-300 text-green-700 px-4 py-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        @foreach($produtos as $produto)

            <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">

                <div class="relative">

                    <img
                        src="{{ asset('storage/'.$produto->capa) }}"
                        class="w-full h-64 object-cover">

                    <div class="absolute top-3 right-3 flex gap-2">

                        <a href="{{ route('produtos.edit',$produto) }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white rounded-full w-10 h-10 flex items-center justify-center shadow">
                            ✏️
                        </a>

                        <form action="{{ route('produtos.destroy',$produto) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Excluir produto?')"
                                class="bg-red-600 hover:bg-red-700 text-white rounded-full w-10 h-10 flex items-center justify-center shadow">
                                🗑️
                            </button>

                        </form>

                    </div>

                </div>

                <div class="p-5">

                    <h2 class="text-lg font-bold text-gray-800">
                        {{ $produto->nome }}
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Código: {{ $produto->codigo }}
                    </p>

                    <span class="inline-block mt-3 bg-indigo-100 text-indigo-700 text-xs font-semibold px-3 py-1 rounded-full">
                        {{ $produto->categoria->nome }}
                    </span>

                </div>

            </div>

        @endforeach

    </div>

    <div class="mt-8">
        {{ $produtos->links() }}
    </div>

</div>

</x-app-layout>
