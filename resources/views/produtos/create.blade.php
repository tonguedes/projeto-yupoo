<x-app-layout>

<div class="max-w-4xl mx-auto py-6">

    <h1 class="text-2xl font-bold mb-4">Novo Produto</h1>

    <form action="{{ route('produtos.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <select name="categoria_id" class="w-full border p-2 mb-2">
            @foreach($categorias as $cat)
                <option value="{{ $cat->id }}">
                    {{ $cat->nome }}
                </option>
            @endforeach
        </select>

        <input type="text" name="nome"
               placeholder="Nome"
               class="w-full border p-2 mb-2">

        <input type="text" name="codigo"
               placeholder="Código"
               class="w-full border p-2 mb-2">

        <textarea name="descricao"
                  class="w-full border p-2 mb-2"
                  placeholder="Descrição"></textarea>

        <label>Capa</label>
        <input type="file" name="capa" class="mb-2">

        <label>Galeria (múltiplas imagens)</label>
        <input type="file" name="imagens[]" multiple class="mb-4">

        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Salvar
        </button>

    </form>

</div>

</x-app-layout>
