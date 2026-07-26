<div class="min-h-screen bg-gray-100">

    <div class="flex">

        {{-- Sidebar --}}
        <aside class="w-64 bg-slate-900 text-white min-h-screen">

            <div class="p-6 text-2xl font-bold border-b border-slate-700">
                YUPOO
            </div>

            <nav class="mt-6">

                <a href="{{ route('dashboard') }}"
                    class="block px-6 py-3 hover:bg-slate-800 transition">

                    🏠 Dashboard

                </a>

                <a href="{{ route('produtos.index') }}"
                    class="block px-6 py-3 hover:bg-slate-800 transition">

                    📦 Produtos

                </a>

                <a href="{{ route('categorias.index') }}"
                    class="block px-6 py-3 hover:bg-slate-800 transition">

                    📂 Categorias

                </a>

            </nav>

        </aside>


        {{-- Conteúdo --}}
        <main class="flex-1">

            {{-- Topbar --}}
            <header class="bg-white shadow px-8 py-5 flex justify-between">

                <h1 class="text-xl font-bold">

                    Painel Administrativo

                </h1>

                <div>

                    {{ Auth::user()->name }}

                </div>

            </header>


            <section class="p-8">

                {{ $slot }}

            </section>

        </main>

    </div>

</div>
