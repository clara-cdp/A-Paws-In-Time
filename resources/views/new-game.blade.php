<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">A PAWS IN TIME</h1>
    <p>choose your character's name before to start:</p>

    <form method="POST" action="{{ route('game.store') }}">
        @csrf

        <input type="text" name="character_name" required><br>

        <button type="submit">
            I'm Ready!
        </button>
    </form>

    <hr class="my-4">

    <h3>Other Games Available:</h3>
    <li>
        <ul> <a href="https://freeasteroids.org/">ASTEROIDS</a></ul>
        <ul> <a href="https://freeinvaders.org/">SPACE INVADERS</a></ul>
        <ul> <a href="https://freeminesweeper.org/">MINESWEEPER</a></ul>

    </li>

</x-app-layout>
