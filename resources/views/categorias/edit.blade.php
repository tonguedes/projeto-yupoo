<x-app-layout>

<div class="max-w-4xl mx-auto py-6">

    <h1 class="text-2xl font-bold mb-4">
        Editar Categoria
    </h1>

    <form action="{{ route('categorias.update',$categoria) }}"
          method="POST">

        @csrf
        @method('PUT')

        <input
            type="text"
            name="nome"
            value="{{ $categoria->nome }}"
            class="w-full border p-2 rounded">

        <button
            class="bg-blue-600 text-white px-4 py-2 rounded mt-4">
            Atualizar
        </button>

    </form>

</div>

</x-app-layout>
