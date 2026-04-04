<x-app-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-black"
        style="background-image: url('{{ asset('assets/images/bg_img.png') }}'); background-size: cover; background-position: center; background-attachment: fixed;">

        <div class="pop-window w-[90%] p-6 mt-10">
            <div>
                <img src="{{ asset('assets/images/APIT_logico.png') }}" class="mb-5">
                <form method="POST" action="{{ route('game.store') }}">
                    @csrf
                    <p>choose your character's name before to start:</p><br>
                    <input type="text" name="character_name" required
                        class="border-2 border-orange-800 focus:border-teal-200 focus:ring-blue-500 shadow-sm w-full max-w-[500px] text-black"><br>

                    <button type="submit" class="go-button active:scale-95 transition-all mt-2">
                        Start Adventure
                    </button>
                </form>
            </div>
        </div>

        {{-- saved games -------------------------------------------------------------------------------------------------- --}}
        @if (auth()->user()->players->isNotEmpty())
            <div class="pop-window w-[90%] md:w-[80%] mt-12 p-6 mb-20 gap-2">
                <p class="font-bold mb-4 gap-2">Your Saved Games:</p>

                @foreach (auth()->user()->players as $player)
                    <div class="border-4 border-gray-900 p-6 mb-6 shadow-md ">
                        <h3 class="mb-2 uppercase">{{ $player->character_name }}</h3>
                        <div>
                            <div class="flex gap-2 items-center">

                                <a href="{{ url('/game/' . $player->id) }}"
                                    class="go-button active:scale-95 transition-all">
                                    Continue
                                </a>
                            </div>
                            <button x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-delete-{{ $player->id }}')"
                                class="text-red-500 hover:text-red-700 text-sm underline">
                                Delete Game
                            </button>

                        </div>
                    </div>

                    {{-- Modal ------------------------------------------------------------------------------- --}}
                    <x-modal name="confirm-delete-{{ $player->id }}">
                        <div class="p-6">
                            <h2 class="text-lg font-medium text-gray-900">Delete {{ $player->character_name }}?</h2>
                            <form method="post" action="{{ route('game.destroy', $player->id) }}"
                                class="mt-6 flex justify-end">
                                @csrf
                                @method('delete')
                                <x-secondary-button x-on:click="$dispatch('close')">Cancel</x-secondary-button>
                                <x-danger-button class="ms-3">Delete Forever</x-danger-button>
                            </form>
                        </div>
                    </x-modal>
                @endforeach


        @endif


    </div>




    {{-- -------------------------------------------------------------------------------------------------------------------------- --}}




</x-app-layout>
