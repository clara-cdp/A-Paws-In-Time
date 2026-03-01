<div class="flex flex-col h-full p-2 md:p-0 mx-auto w-full ">

    <div class="flex-none">
        <h2 class="hidden sm:block font-bold text-yellow-200 uppercase text-base md:text-lg  md:tracking-widest">
            {{ $player }}'s pocket
        </h2>
    </div>
    <div class="flex-1 min-h-0 overflow-y-auto pr-2 custom-scrollbar">
        <div class="grid grid-cols-[repeat(auto-fill,minmax(120px,1fr))] gap-3">

            @foreach ($items as $item)
                <div class="aspect-square max-w-[120px] max-h-[120px] w-full flex items-center justify-center">
                    <img src="{{ asset($item->image_url) }}" alt="{{ $item->name }}"
                        class="max-w-[80%] max-h-[80%] object-contain drop-shadow-md">
                </div>
            @endforeach

        </div>
    </div>

</div>
