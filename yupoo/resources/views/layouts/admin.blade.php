<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>YUPOO Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <style>

        /*
        |--------------------------------------------------------------------------
        | MENU
        |--------------------------------------------------------------------------
        */

        .menu-item {

            display: flex;

            align-items: center;

            gap: 16px;

            padding: 14px 24px;

            transition: all 0.2s ease;

            position: relative;

        }


        .menu-item:hover {

            background: #1e293b;

        }


        .menu-item svg {

            width: 24px;

            height: 24px;

            flex-shrink: 0;

        }


        /*
        |--------------------------------------------------------------------------
        | SIDEBAR FECHADA
        |--------------------------------------------------------------------------
        */

        .sidebar-mini .menu-item {

            justify-content: center;

            padding-left: 0;

            padding-right: 0;

        }


        .sidebar-mini .menu-text {

            display: none;

        }


        .sidebar-mini #logo {

            padding-left: 0;

            padding-right: 0;

        }


        .sidebar-mini #logo-title {

            font-size: 28px;

        }


        .sidebar-mini #logo-subtitle {

            display: none;

        }


        /*
        |--------------------------------------------------------------------------
        | TOOLTIP
        |--------------------------------------------------------------------------
        */

        .sidebar-tooltip {

            display: none;

            position: absolute;

            left: 72px;

            top: 50%;

            transform: translateY(-50%);

            background: #0f172a;

            color: white;

            padding: 8px 12px;

            border-radius: 6px;

            font-size: 14px;

            white-space: nowrap;

            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);

            z-index: 50;

        }


        .sidebar-mini .menu-item:hover .sidebar-tooltip {

            display: block;

        }


        /*
        |--------------------------------------------------------------------------
        | SIDEBAR SCROLL
        |--------------------------------------------------------------------------
        */

        #sidebar {

            min-height: 100vh;

        }


        /*
        |--------------------------------------------------------------------------
        | TRANSIÇÕES
        |--------------------------------------------------------------------------
        */

        #sidebar {

            transition:

                width 0.3s ease,

                min-width 0.3s ease;

        }


        /*
        |--------------------------------------------------------------------------
        | MOBILE
        |--------------------------------------------------------------------------
        */

        @media (max-width: 768px) {

            #sidebar {

                position: fixed;

                z-index: 40;

                left: 0;

                top: 0;

                bottom: 0;

            }

        }

    </style>

</head>


<body class="bg-gray-100">


<div class="flex min-h-screen">


    {{-- ========================================================= --}}
    {{-- SIDEBAR --}}
    {{-- ========================================================= --}}

    <aside
        id="sidebar"
        class="w-64 bg-slate-900 text-white overflow-hidden">


        {{-- LOGO --}}

        <div
            id="logo"
            class="border-b border-slate-700 p-6">


            <div class="text-center">


                <h1
                    id="logo-title"
                    class="text-2xl font-bold tracking-wider">

                    YUPOO

                </h1>


                <p
                    id="logo-subtitle"
                    class="text-xs text-slate-400 mt-1 menu-text">

                    Painel Administrativo

                </p>


            </div>


        </div>



        {{-- ===================================================== --}}
        {{-- MENU --}}
        {{-- ===================================================== --}}

        <nav class="mt-6">


            {{-- GERAL --}}

            <div class="px-6 mb-3 menu-text">

                <span
                    class="text-xs uppercase text-slate-500 font-bold">

                    Geral

                </span>

            </div>


            {{-- DASHBOARD --}}

            <a
                href="{{ route('dashboard') }}"
                class="menu-item
                {{ request()->routeIs('dashboard')
                    ? 'bg-slate-800 border-l-4 border-indigo-500'
                    : '' }}">


                <x-heroicon-o-home class="w-6 h-6"/>


                <span class="menu-text">

                    Dashboard

                </span>


                <span class="sidebar-tooltip">

                    Dashboard

                </span>


            </a>



            {{-- CATÁLOGO --}}

            <div class="px-6 mt-8 mb-3 menu-text">

                <span
                    class="text-xs uppercase text-slate-500 font-bold">

                    Catálogo

                </span>

            </div>



            {{-- PRODUTOS --}}

            <a
                href="{{ route('produtos.index') }}"
                class="menu-item
                {{ request()->routeIs('produtos.*')
                    ? 'bg-slate-800 border-l-4 border-indigo-500'
                    : '' }}">


                <x-heroicon-o-cube class="w-6 h-6"/>


                <span class="menu-text">

                    Produtos

                </span>


                <span class="sidebar-tooltip">

                    Produtos

                </span>


            </a>



            {{-- CATEGORIAS --}}

            <a
                href="{{ route('categorias.index') }}"
                class="menu-item
                {{ request()->routeIs('categorias.*')
                    ? 'bg-slate-800 border-l-4 border-indigo-500'
                    : '' }}">


                <x-heroicon-o-folder class="w-6 h-6"/>


                <span class="menu-text">

                    Categorias

                </span>


                <span class="sidebar-tooltip">

                    Categorias

                </span>


            </a>



            {{-- USUÁRIO --}}

            <div class="px-6 mt-8 mb-3 menu-text">

                <span
                    class="text-xs uppercase text-slate-500 font-bold">

                    Usuário

                </span>

            </div>



            {{-- PERFIL --}}

            <a
                href="{{ route('profile.edit') }}"
                class="menu-item">


                <x-heroicon-o-user class="w-6 h-6"/>


                <span class="menu-text">

                    Meu Perfil

                </span>


                <span class="sidebar-tooltip">

                    Meu Perfil

                </span>


            </a>


        </nav>


    </aside>



    {{-- ========================================================= --}}
    {{-- ÁREA PRINCIPAL --}}
    {{-- ========================================================= --}}

    <div class="flex-1 flex flex-col">


        {{-- ===================================================== --}}
        {{-- HEADER --}}
        {{-- ===================================================== --}}

        <header
            class="bg-white shadow px-8 py-5 flex items-center justify-between">


            {{-- ESQUERDA --}}

            <div class="flex items-center gap-4">


                {{-- BOTÃO SIDEBAR --}}

                <button
                    id="toggleSidebar"
                    type="button"
                    class="text-gray-600 hover:text-indigo-600 transition">


                    <x-heroicon-o-bars-3 class="w-8 h-8"/>


                </button>



                <h1
                    class="text-xl font-bold text-gray-800">

                    Painel Administrativo

                </h1>


            </div>



            {{-- DIREITA --}}

            <div class="flex items-center gap-5">


                <div class="text-right">


                    <p class="font-semibold text-gray-800">

                        {{ Auth::user()->name }}

                    </p>


                    <p class="text-xs text-gray-500">

                        Administrador

                    </p>


                </div>



                {{-- LOGOUT --}}

                <form
                    action="{{ route('logout') }}"
                    method="POST">


                    @csrf


                    <button
                        type="submit"
                        class="text-red-600 hover:text-red-800 transition"
                        title="Sair">


                        <x-heroicon-o-arrow-right-on-rectangle
                            class="w-6 h-6"/>


                    </button>


                </form>


            </div>


        </header>



        {{-- ===================================================== --}}
        {{-- CONTEÚDO --}}
        {{-- ===================================================== --}}

        <main class="flex-1 p-8">


            {{-- MENSAGEM DE SUCESSO --}}

            @if(session('success'))

                <div
                    class="mb-6 bg-green-100 border border-green-300 text-green-700 rounded-lg p-4">


                    {{ session('success') }}


                </div>

            @endif



            {{-- ERROS DE VALIDAÇÃO --}}

            @if($errors->any())

                <div
                    class="mb-6 bg-red-100 border border-red-300 text-red-700 rounded-lg p-4">


                    <ul class="list-disc pl-5">


                        @foreach($errors->all() as $erro)

                            <li>

                                {{ $erro }}

                            </li>

                        @endforeach


                    </ul>


                </div>

            @endif



            {{-- VIEW DA PÁGINA --}}

            @yield('content')


        </main>


    </div>


</div>



{{-- ============================================================= --}}
{{-- JAVASCRIPT --}}
{{-- ============================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {


    const sidebar = document.getElementById('sidebar');

    const button = document.getElementById('toggleSidebar');


    if (!sidebar || !button) {

        return;

    }


    /*
    |--------------------------------------------------------------------------
    | Estado salvo
    |--------------------------------------------------------------------------
    */

    let collapsed = localStorage.getItem('sidebar') === 'true';



    /*
    |--------------------------------------------------------------------------
    | Aplicar estado
    |--------------------------------------------------------------------------
    */

    function applySidebarState() {


        if (collapsed) {


            sidebar.classList.remove('w-64');

            sidebar.classList.add('w-20');


            document.body.classList.add('sidebar-mini');


        } else {


            sidebar.classList.remove('w-20');

            sidebar.classList.add('w-64');


            document.body.classList.remove('sidebar-mini');


        }

    }



    /*
    |--------------------------------------------------------------------------
    | Estado inicial
    |--------------------------------------------------------------------------
    */

    applySidebarState();



    /*
    |--------------------------------------------------------------------------
    | Botão abrir / fechar
    |--------------------------------------------------------------------------
    */

    button.addEventListener('click', function () {


        collapsed = !collapsed;


        localStorage.setItem(
            'sidebar',
            collapsed
        );


        applySidebarState();


    });


});

</script>


</body>

</html>
