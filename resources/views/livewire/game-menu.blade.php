<div class="flex flex-col h-full pt-2 md:p-0 mx-auto w-full">
    <div class="flex-none">
        <h2 class="hidden sm:block font-bold pb-2 text-yellow-200 uppercase text-base md:text-lg md:tracking-widest">
            Commands
        </h2>
    </div>

    <div class="flex-1 overflow-y-auto custom-scrollbar">
        <div class="flex flex-col justify-between h-full md:grid md:grid-cols-2 md:gap-x-2 md:justify-start ">

            @foreach ($verbs as $verbEnum)
                <button type="button" wire:click.prevent="setActiveVerb('{{ $verbEnum->value }}')"
                    class="flex items-center justify-start font-bold text-sm md:text-[12] md:columns-1 tracking-wide 
                {{ $activeVerb === $verbEnum->value ? 'text-blue-400' : 'text-white hover:text-yellow-200' }}">
                    {{ $verbEnum->value }}
                </button>
            @endforeach

        </div>
    </div>

</div>
