<x-guest-layout>
    <div class="h-auto p-6 flex flex-col items-center justify-center bg-gray-900 text-white">
        <h1 class="text-5xl font-bold mb-8">A Paws in Time</h1>

        <div class="space-y-4">
            <a href="{{ auth()->check() ? route('game.new') : route('register') }}"
                class="block px-8 py-4 bg-green-600 hover:bg-green-700 rounded text-xl text-center">
                New Player
            </a>

            <a href="{{ route('login') }}"
                class="block px-8 py-4 bg-blue-600 hover:bg-blue-700 rounded text-xl text-center">
                log in
            </a>
        </div>
    </div>
</x-guest-layout>
