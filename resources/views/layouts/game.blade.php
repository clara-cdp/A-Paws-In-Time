<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-black h-full overflow-hidden">

    <main x-data="{ view: 'menu' }" class="flex flex-col h-screen w-full">
        <div class="h-[80%] md:h-[80%] w-full flex justify-center text-white text-2xl font-bold ">
            <livewire:playroom />
        </div>

        <div class="h-[30%] md:h-[20%] w-full flex flex-row bg-black overflow-hidden pt-2 p-4">
            <div class="w-1/4 md:w-1/4 min-w-[100px]">
                <livewire:game-menu />
                {{-- <livewire:game-menu wire:key="game-menu" /> --}}
            </div>

            <div class="flex-1 min-h-0">
                <livewire:pocket />
            </div>
        </div>
    </main>

</body>

</html>

{{-- TODO:
 add "back to menu"
 add "music ON/OFF "
       --}}
