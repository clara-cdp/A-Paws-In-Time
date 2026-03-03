<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Create Your Character</h1>

    <form method="POST" action="{{ route('game.store') }}">
        @csrf

        <input type="text" name="character_name" required>

        <button type="submit">
            Start Game
        </button>
    </form>
</x-app-layout>
