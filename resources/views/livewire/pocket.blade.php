<div class="flex flex-col h-full p-4 md:p-8 mx-auto w-full">

    <div class="flex-none">
        <h2 class="font-bold mb-4 text-yellow-200 ">
            {{ $player }}'s pocket
        </h2>
    </div>

    <div class="flex-1 min-h-0 overflow-y-auto pr-2 custom-scrollbar">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 md:gap-4">
            @foreach ($items as $item)
                <div class="aspect-square flex items-center justify-center">
                    <img src="{{ asset($item->image_url) }}" alt="{{ $item->name }}"
                        class="max-w-full max-h-full object-contain">
                </div>
            @endforeach
        </div>
    </div>
</div>
