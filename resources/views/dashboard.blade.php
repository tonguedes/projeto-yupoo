<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                <a href="{{ route('produtos.index') }}"
                   class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">

                    <div class="text-5xl mb-3">
                        📦
                    </div>

                    <h3 class="text-xl font-bold">
                        Produtos
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Gerenciar produtos do catálogo.
                    </p>

                </a>

                <a href="{{ route('categorias.index') }}"
                   class="bg-white rounded-xl shadow p-6 hover:shadow-lg transition">

                    <div class="text-5xl mb-3">
                        📂
                    </div>

                    <h3 class="text-xl font-bold">
                        Categorias
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Gerenciar categorias.
                    </p>

                </a>

                <div
                    class="bg-white rounded-xl shadow p-6">

                    <div class="text-5xl mb-3">
                        📈
                    </div>

                    <h3 class="text-xl font-bold">
                        Estatísticas
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Em breve.
                    </p>

                </div>

            </div>


            {{-- Bem-vindo --}}
            <div class="bg-white rounded-xl shadow">

                <div class="p-8">

                    <h3 class="text-2xl font-bold mb-3">

                        Bem-vindo ao Painel Administrativo

                    </h3>

                    <p class="text-gray-600">

                        Utilize os atalhos acima para administrar seu catálogo.

                    </p>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
