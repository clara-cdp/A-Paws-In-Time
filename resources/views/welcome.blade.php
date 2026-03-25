<x-guest-layout>

    <div class="pop-window flex flex-col items-center mx-auto ">
        <div>
            <img src="{{ asset('assets/images/APIT_logo_transp.png') }}" class="max-w-full h-auto">
        </div>

        <div class="flex flex-col space-y-4 px-8">
            <a href="{{ auth()->check() ? route('game.new') : route('register') }}"
                class="go-button active:scale-95 transition-all text-center">
                New Player
            </a>

            <a href="{{ route('login') }}" class="go-button active:scale-95 transition-all text-center">
                Log In
            </a>
        </div>
    </div>

</x-guest-layout>
