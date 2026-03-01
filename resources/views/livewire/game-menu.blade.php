<div class="flex flex-col h-full p-2 md:p-0 mx-auto w-full ">
    <div class=" flex-none">
        <h2 class="hidden sm:block font-bold pb-4 text-yellow-200 uppercase text-base md:text-lg  md:tracking-widest">
            Commands
        </h2>
    </div>

    <div class="flex-1 min-h-0 overflow-y-auto ">
        <div class="flex flex-col justify-between h-full md:grid md:grid-cols-2 md:gap-x-2 md:justify-start">
            <?php $verbs = ['LOOK AT', 'USE', 'PICK UP', 'GIVE', 'OPEN', 'CLOSE', 'PULL', 'PUSH']; ?>

            @foreach ($verbs as $verb)
                <button type="submit" wire:click.prevent="setActiveVerb('{{ $verb }}')"
                    class="flex items-center justify-start text-white font-bold text-sm md:text-lg md:columns-1 tracking-wide 
                    {{ $activeVerb === $verb ? 'text-blue-400' : 'text-white hover:text-yellow-200' }}">
                    {{ $verb }}
                </button>
            @endforeach

        </div>

    </div>

</div>
