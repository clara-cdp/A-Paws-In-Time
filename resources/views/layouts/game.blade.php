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

        <div class="md:hidden fixed top-6 right-6 z-50 text-right">
            <div class="bg-black/40 backdrop-blur-sm p-4 rounded-xl border border-white/5 shadow-lg"> <a
                    href="{{ route('game.new') }}" class="block text-yellow-200 text-[12px] mb-4">QUIT</a>

                <div class="flex flex-col space-y-1">
                    <span class="text-[8px] uppercase text-gray-500 font-bold tracking-widest">SOUND</span>
                    <button class="text-[10px] text-white text-xs">ON</button>
                    <button class="text-[10px] text-gray-500 text-xs">OFF</button>
                </div>
            </div>
        </div>

        <div class="h-[75%] md:h-[80%] w-full flex justify-center text-white text-2xl font-bold">
            <livewire:playroom />
        </div>

        <div class="h-[25%] md:h-[20%] w-full flex flex-row bg-black overflow-hidden pt-2 p-4">

            <div class="hidden md:block text-white w-200 min-w-[100px]">
                <div class="flex-none">
                    <h2 class="font-bold text-yellow-200 uppercase text-lg tracking-widest">MENU</h2>
                </div>

                <a href="{{ route('game.new') }}" class="hover:text-yellow-200">Quit</a>

                <div class="mt-4 flex flex-col">
                    <span class="text-gray-400 text-[12px]">sound</span>
                    <button class="text-left hover:text-white">ON</button>
                    <button class="text-left hover:text-white">OFF</button>
                </div>
            </div>

            <div class="w-300 md:max-w-[450px] min-w-[130px]">
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
