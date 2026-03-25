<x-app-layout>
    <div class="h-screen flex flex-col justify-center items-center bg-black"
        style="background-image: url('{{ asset('assets/images/bg_img.png') }}'); background-size: cover; background-position: center; animate-fade-out">

        <div class="pop-window w-[90%] p-6 ">
            <div>
                <img src="{{ asset('assets/images/APIT_logico.png') }}" class="mb-5">

                @if (auth()->user()->player)
                    <p class="mb-6">Welcome back, <strong>{{ auth()->user()->player->character_name }}</strong>!</p>

                    <a href="{{ url('/game') }}" class="go-button active:scale-95 transition-all mb-6">
                        Continue
                    </a>

                    <div>
                        <button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-player-deletion')"
                            class="text-red-500 hover:text-red-700 text-sm underline mt-6">
                            {{ __('Reset Game') }}
                        </button>
                    </div>
                    <x-modal name="confirm-player-deletion">
                        <div class="p-6">
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Are you sure you want to reset?') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Warning: This will delete your character and all progress.
                            </p>

                            <form method="post" action="{{ route('game.destroy') }}" class="mt-6 flex justify-end">
                                @csrf
                                @method('delete')

                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>

                                <x-danger-button class="ms-3">
                                    {{ __('Reset Game') }}
                                </x-danger-button>
                            </form>
                        </div>
                    </x-modal>
                @else
                    <form method="POST" action="{{ route('game.store') }}">
                        @csrf
                        <p>choose your character's name before to start:</p><br>
                        <input type="text" name="character_name" required
                            class="border-gray-300 focus:border-teal-200 focus:ring-blue-500 rounded-md shadow-sm w-full max-w-[500px]'"><br>

                        <button type="submit" class="go-button active:scale-95 transition-all">
                            I'm Ready!
                        </button>
                    </form>
                @endif

            </div>

        </div>
        <div class="pop-window w-[90%] md:w-[80%] mt-12 p-6">
            <div class="">
                <h3>Other Games Available:</h3>
                <hr class="mt-2 mb-6 border-2 border-b-orange-950 ">
                <a class=" text-sm hover:text-teal-500" href="https://freeinvaders.org/"> SPACE INVADERS</><br>
                    <a class=" text-sm hover:text-teal-500" href="https://freeasteroids.org/">ASTEROIDS</a><br>
                    <a class=" text-sm hover:text-teal-500" href="https://freeminesweeper.org/">MINESWEEPER</><br>

            </div>
        </div>

</x-app-layout>
