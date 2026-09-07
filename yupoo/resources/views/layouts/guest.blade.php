<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'YUPOO') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased">
        <div class="min-h-screen bg-slate-50 lg:grid lg:grid-cols-[1.05fr_1fr]">

            {{-- Painel de marca (desktop) --}}
            <div class="relative hidden flex-col justify-between overflow-hidden bg-slate-900 p-12 text-white lg:flex">
                <div aria-hidden="true" class="pointer-events-none absolute inset-0">
                    <div class="absolute -left-24 -top-24 h-96 w-96 rounded-full bg-indigo-500/25 blur-3xl"></div>
                    <div class="absolute -bottom-32 right-0 h-96 w-96 rounded-full bg-sky-400/10 blur-3xl"></div>
                    <div class="absolute inset-0 opacity-[0.05]"
                         style="background-image:radial-gradient(#ffffff 1px,transparent 1px);background-size:24px 24px;"></div>
                </div>

                <div class="relative flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 ring-1 ring-white/15 backdrop-blur">
                        <x-application-logo class="h-6 w-6 fill-current text-white" />
                    </span>
                    <span class="text-lg font-semibold tracking-tight">YUPOO <span class="font-normal text-white/50">Admin</span></span>
                </div>

                <div class="relative">
                    <h1 class="max-w-sm text-3xl font-semibold leading-tight tracking-tight">
                        Gerencie seu catálogo com clareza.
                    </h1>
                    <p class="mt-4 max-w-sm text-sm leading-relaxed text-white/60">
                        Produtos, categorias e estatísticas reunidos em um só painel.
                        Entre para continuar de onde parou.
                    </p>

                    <ul class="mt-8 space-y-3 text-sm text-white/70">
                        <li class="flex items-center gap-3">
                            <svg class="h-5 w-5 flex-shrink-0 text-indigo-300" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.146Z" clip-rule="evenodd" />
                            </svg>
                            Cadastro rápido de produtos e categorias
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="h-5 w-5 flex-shrink-0 text-indigo-300" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.146Z" clip-rule="evenodd" />
                            </svg>
                            Catálogo público sempre atualizado
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="h-5 w-5 flex-shrink-0 text-indigo-300" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.146Z" clip-rule="evenodd" />
                            </svg>
                            Visão geral com estatísticas em tempo real
                        </li>
                    </ul>
                </div>

                <p class="relative text-xs text-white/40">© {{ date('Y') }} YUPOO. Todos os direitos reservados.</p>
            </div>

            {{-- Painel do formulário --}}
            <div class="flex min-h-screen items-center justify-center px-6 py-12 lg:min-h-0">
                <div class="w-full max-w-md">

                    {{-- Logo (mobile) --}}
                    <div class="mb-8 flex items-center gap-3 lg:hidden">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-900">
                            <x-application-logo class="h-6 w-6 fill-current text-white" />
                        </span>
                        <span class="text-lg font-semibold tracking-tight text-slate-900">YUPOO <span class="font-normal text-slate-400">Admin</span></span>
                    </div>

                    <div class="rounded-2xl border border-slate-200/80 bg-white p-8 shadow-sm sm:p-10">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
