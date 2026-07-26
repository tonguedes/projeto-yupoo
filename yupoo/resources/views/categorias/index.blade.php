<x-app-layout>

<div class="max-w-7xl mx-auto py-6">

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">
            Categorias
        </h1>

        <a href="{{ route('categorias.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            Nova Categoria
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Slug</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->nome }}</td>
                    <td>{{ $categoria->slug }}</td>

                    <td class="space-x-2">
                        <a href="{{ route('categorias.edit',$categoria) }}"
                           class="bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                            Editar
                        </a>

                        <form
                            action="{{ route('categorias.destroy',$categoria) }}"
                            method="POST"
                            class="inline">

                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Excluir?')"
                                    class="bg-red-600 text-white px-3 py-1 rounded text-sm">
                                Excluir
                            </button>

                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $categorias->links() }}
    </div>

</div>

</x-app-layout>
