<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="UTF-8">

    <title>Yupoo Admin</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-gray-100">

<div class="flex">

    @include('layouts.sidebar')

    <main class="flex-1 p-8">

        {{ $slot }}

    </main>

</div>

</body>

</html>
