<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>YUPOO Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100">

    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        <aside id="sidebar" class="w-64 bg-slate-900 text-white transition-all duration-300 overflow-hidden">

            {{-- LOGO --}}
            <div id="logo" class="p-6 text-2xl font-bold border-b border-slate-700 text-center">

                YUPOO

            </div>

            {{-- MENU --}}
            <nav class="mt-6">

                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-4 px-6 py-3 transition
                {{ request()->routeIs('dashboard') ? 'bg-slate-800 border-l-4 border-indigo-500' : 'hover:bg-slate-800' }}">

                    <x-heroicon-o-home class="menu-icon w-6 h-6" />

                    <span class="menu-text">
                        Dashboard
                    </span>

                </a>

                <a href="{{ route('produtos.index') }}"
                    class="flex items-center gap-4 px-6 py-3 transition
                {{ request()->routeIs('produtos.*') ? 'bg-slate-800 border-l-4 border-indigo-500' : 'hover:bg-slate-800' }}">

                    <x-heroicon-o-cube class="menu-icon w-6 h-6" />

                    <span class="menu-text">
                        Produtos
                    </span>

                </a>

                <a href="{{ route('categorias.index') }}"
                    class="flex items-center gap-4 px-6 py-3 transition
                {{ request()->routeIs('categorias.*') ? 'bg-slate-800 border-l-4 border-indigo-500' : 'hover:bg-slate-800' }}">

                    <x-heroicon-o-folder class="menu-icon w-6 h-6" />

                    <span class="menu-text">
                        Categorias
                    </span>

                </a>

            </nav>

        </aside>


        {{-- CONTEÚDO --}}
        <div class="flex-1 flex flex-col">

            {{-- HEADER --}}
            <header class="bg-white shadow px-8 py-5 flex items-center justify-between">

                <div class="flex items-center gap-4">

                    <button id="toggleSidebar" class="text-2xl hover:text-indigo-600 transition">

                        <x-heroicon-o-bars-3 class="w-8 h-8"/>

                    </button>

                    <h1 class="text-xl font-bold">

                        Painel Administrativo

                    </h1>

                </div>

                <div class="flex items-center gap-6">

                    <span class="font-medium">

                        {{ Auth::user()->name }}

                    </span>

                    <form action="{{ route('logout') }}" method="POST">

                        @csrf

                        <button class="flex items-center gap-2 text-red-600 hover:text-red-800">

                            <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5" />

                            <span class="menu-text">

                                Sair

                            </span>

                        </button>
                    </form>

                </div>

            </header>


            {{-- CONTEÚDO DAS PÁGINAS --}}
            <main class="flex-1 p-8">

                @if(session('success'))

                    <div class="mb-6 bg-green-100 border border-green-300 text-green-700 rounded-lg p-4">

                        {{ session('success') }}

                    </div>

                @endif

                @yield('content')

            </main>

        </div>

    </div>

    <script>

        document.addEventListener('DOMContentLoaded', () => {

            const sidebar = document.getElementById('sidebar');
            const button = document.getElementById('toggleSidebar');
            const logo = document.getElementById('logo');
            const texts = document.querySelectorAll('.menu-text');

            let collapsed = localStorage.getItem('sidebar') === 'true';

            function toggleSidebar(state) {

                if (state) {

                    sidebar.classList.remove('w-64');
                    sidebar.classList.add('w-20');

                    logo.innerHTML = '📦';

                    texts.forEach(text => {
                        text.classList.add('hidden');
                    });

                } else {

                    sidebar.classList.remove('w-20');
                    sidebar.classList.add('w-64');

                    logo.innerHTML = 'YUPOO';

                    texts.forEach(text => {
                        text.classList.remove('hidden');
                    });

                }

            }

            toggleSidebar(collapsed);

            button.addEventListener('click', () => {

                collapsed = !collapsed;

                localStorage.setItem('sidebar', collapsed);

                toggleSidebar(collapsed);

            });

        });

    </script>

</body>

</html>
