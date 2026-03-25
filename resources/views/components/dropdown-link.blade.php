<a
    {{ $attributes->merge([
        'class' => 'bg-[rgb(237,212,184)] block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-teal-200
            focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out',
    ]) }}>{{ $slot }}</a>
