<div class="flex flex-col h-full p-2 md:p-0 mx-auto w-full">

    <div class="flex-none">
        <h2 class="hidden sm:block font-bold text-teal-200 uppercase text-base md:text-lg md:tracking-widest">
            {{ $playerName }}'s pocket
        </h2>
    </div>

    <div class="flex-1 min-h-0 overflow-y-auto pr-2 custom-scrollbar">
        <div class="grid grid-cols-2 sm:grid-cols-[repeat(auto-fill,minmax(100px,1fr))] gap-2">
            @foreach ($items as $item)
                <button wire:click="selectItem({{ $item->id }})"
                    class="aspect-square w-full flex flex-col items-center justify-center hover:cursor-pointer group">
                    <img src="{{ asset($item->image_url) }}" alt="{{ $item->css_id }}"
                        class="max-w-[80%] max-h-[80%] object-contain transition-transform group-hover:scale-105">
                </button>
            @endforeach
        </div>
    </div>
</div>
