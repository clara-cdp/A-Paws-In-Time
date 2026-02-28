<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class=" bg-red-400 h-full">

    <main class="flex flex-col h-screen w-full">
        <div class="h-[70%] w-full bg-blue-300 flex justify-center text-white text-2xl font-bold">
            <livewire:playroom>
        </div>


        <div class="h-[30%] w-full flex">
            <div class="flex-1 bg-blue-500 border-r flex items-center justify-center text-white font-semibold">
                <livewire:game-menu>
                    {{-- TODO: add "back to menu --}}
            </div>

            <div class="flex-1 bg-black flex ">
                <livewire:pocket>
            </div>

        </div>
    </main>


</body>

</html>
{{-- {{ $slot }} --}}
