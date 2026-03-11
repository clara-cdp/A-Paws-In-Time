<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">A PAWS IN TIME</h1>
    <p>choose your character's name before to start:</p>

    @if (auth()->user()->player)
        <p class="mb-4">Welcome back, <strong>{{ auth()->user()->player->character_name }}</strong>!</p>

        <a href="{{ url('/game') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Continue Adventure
        </a>
    @else
        <form method="POST" action="{{ route('game.store') }}">
            @csrf

            <input type="text" name="character_name" required><br>

            <button type="submit">
                I'm Ready!
            </button>
        </form>
    @endif
    <hr class="my-4">

    <h3>Other Games Available:</h3>
    <li>
        <ul> <a href="https://freeasteroids.org/">ASTEROIDS</a></ul>
        <ul> <a href="https://freeinvaders.org/">SPACE INVADERS</a></ul>
        <ul> <a href="https://freeminesweeper.org/">MINESWEEPER</a></ul>

    </li>

</x-app-layout>
