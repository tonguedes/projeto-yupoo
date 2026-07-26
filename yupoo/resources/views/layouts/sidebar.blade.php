<aside class="w-64 bg-gray-900 text-white min-h-screen">

    <div class="p-6 text-2xl font-bold border-b border-gray-700">
        Yupoo Admin
    </div>

    <nav class="mt-6">

        <a href="{{ route('dashboard') }}"
           class="block px-6 py-3 hover:bg-gray-800">
            🏠 Dashboard
        </a>

        <a href="{{ route('produtos.index') }}"
           class="block px-6 py-3 hover:bg-gray-800">
            📦 Produtos
        </a>

        <a href="{{ route('categorias.index') }}"
           class="block px-6 py-3 hover:bg-gray-800">
            📁 Categorias
        </a>

    </nav>

</aside>
