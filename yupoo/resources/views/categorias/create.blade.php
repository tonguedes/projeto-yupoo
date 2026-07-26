<x-app-layout>

<div class="max-w-4xl mx-auto py-6">

    <h1 class="text-2xl font-bold mb-4">
        Nova Categoria
    </h1>

    <form action="{{ route('categorias.store') }}"
          method="POST">

        @csrf

        <input
            type="text"
            name="nome"
            placeholder="Nome da categoria"
            class="w-full border p-2 rounded">

        <button
            class="bg-green-600 text-white px-4 py-2 rounded mt-4">
            Salvar
        </button>

    </form>

</div>

</x-app-layout>
