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

    {{-- ------------------------------- splash screen ------------------------------------------------------------- --}}
    <div x-data="{ showCover: true }" x-init="setTimeout(() => showCover = false, 3000)" x-show="showCover"
        x-transition:leave="transition ease-in duration-500" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-[9999] flex items-center justify-center bg-black">
        <div class="text-center">
            <img src="{{ asset('build/assets/images/dancing_kitty.gif') }}" class="w-20 h-20">
            <p class="mt-4 text-gray-500 font-medium">Loading Experience...</p>
        </div>
    </div>
    {{-- ------------------------------------------- mini menu ------------------------------------------------- --}}

    <main x-data="{
        view: 'menu',
        playing: true,
        audio: new Audio(),
        playlist: [
            '{{ asset('build/assets/audio/track_1.mp3') }}',
            '{{ asset('build/assets/audio/track_2.mp3') }}',
            '{{ asset('build/assets/audio/track_3.mp3') }}',
            '{{ asset('build/assets/audio/track_4.mp3') }}'
        ],
        index: 0,
        playNext() {
            if (!this.playing) return;
            this.audio.src = this.playlist[this.index];
            this.audio.play().catch(() => {});
            this.index = (this.index + 1) % this.playlist.length;
        }
    }" x-init="audio.onended = () => playNext();
    window.addEventListener('click', () => { if (playing && audio.paused) playNext() }, { once: true });" class="flex flex-col h-screen w-full">

        <div class="md:hidden fixed top-6 right-6 z-50 text-right">
            <div class="bg-black/40 backdrop-blur-sm p-4 rounded-xl border border-white/5 shadow-lg">

                <a href="{{ route('game.new') }}" class="block text-yellow-200 text-[12px] mb-4">
                    QUIT
                </a>

                <div class="flex flex-col space-y-1">
                    <span class="text-[8px] uppercase text-gray-500 font-bold tracking-widest">
                        SOUND
                    </span>

                    <button @click="playing = true; playNext()"
                        :class="playing ? 'text-white font-bold' : 'text-gray-500'" class="text-[10px]">
                        ON
                    </button>

                    <button @click="playing = false; audio.pause()"
                        :class="!playing ? 'text-white font-bold' : 'text-gray-500'" class="text-[10px]">
                        OFF
                    </button>
                </div>

            </div>
        </div>

        <div class="h-[75%] md:h-[80%] w-full flex justify-center text-white text-2xl font-bold">
            <livewire:playroom />
        </div>

        <div class="h-[25%] md:h-[20%] w-full flex flex-row bg-[rgb(33,21,1)] overflow-hidden pt-2 p-4">

            <div class="hidden md:block text-white w-200 min-w-[100px]">
                <div class="flex-none">
                    <h2 class="font-bold text-teal-200 uppercase text-lg tracking-widest">MENU</h2>
                </div>

                <a href="{{ route('game.new') }}" class="hover:text-red-400">Quit</a>

                {{-- ---------------------------- --}}

                <div class="mt-4 flex flex-col">

                    <span class="text-gray-400 text-[10px] uppercase tracking-widest">
                        Sound
                    </span>

                    <button @click="playing = true; playNext()"
                        :class="playing ? 'text-white font-bold' : 'text-gray-500'"
                        class="text-left hover:text-white transition-colors text-sm">
                        ON
                    </button>

                    <button @click="playing = false; audio.pause()"
                        :class="!playing ? 'text-white font-bold' : 'text-gray-500'"
                        class="text-left hover:text-white transition-colors text-sm">
                        OFF
                    </button>
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
